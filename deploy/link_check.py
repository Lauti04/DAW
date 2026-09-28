#!/usr/bin/env python3
"""Routing / broken-link checker for the demo hub (standard library only).

Crawls each app from its entry pages and reports anything that would break when the app lives
under a sub-path such as /eventflow/ instead of a domain root:

  * links or assets that return 404/5xx
  * links pointing at localhost / a private address (common leftover from local development)
  * root-absolute references ("/foo") that escape the app's folder
  * redirects that land outside the app's folder
  * files referenced from CSS url(...) and from path-like strings in JavaScript

  python3 deploy/link_check.py http://localhost:8080                 # public pages only
  python3 deploy/link_check.py http://localhost:8080 --auth          # also crawl logged-in pages
  python3 deploy/link_check.py https://lautaro-demos.onrender.com    # against the live site

--auth signs in with the public demo accounts from db/demo.sql (see deploy/DEPLOY.md).
Nothing is ever written: only GET requests are made, and logout URLs are skipped.
"""
import argparse
import http.cookiejar
import json
import re
import sys
import urllib.error
import urllib.parse
import urllib.request
from html.parser import HTMLParser

APPS = {
    "eventflow": {
        "prefix": "/eventflow/",
        "start": ["frontend/home.php", "frontend/login_view.php", "frontend/register_view.php"],
        "auth_start": ["frontend/dashboard.php", "frontend/mail_view.php"],
        "login": ("backend/auth/login.php", {"email": "demo@eventflow.demo", "password": "demo1234"}),
        "api_gets": ["backend/api/eventos.php", "backend/api/categorias.php", "backend/api/recordatorios.php"],
        "protected": ["frontend/dashboard.php", "backend/api/eventos.php"],
    },
    "dulce-encanto": {
        "prefix": "/dulce-encanto/",
        "start": ["templates/home.php", "templates/productos.php", "templates/contacto.php",
                  "templates/producto-individual.php?id=1", "admin/login.php", "admin/registro.php"],
        "auth_start": ["admin/admin.php", "admin/listarRecetas.php", "admin/listarFabricacion.php", "admin/editarUsuario.php?id=1"],
        "login": ("admin/login.php", {"username": "demo", "password": "demo1234"}),
        "api_gets": [],
        "protected": ["admin/admin.php", "admin/listarRecetas.php", "admin/listarFabricacion.php", "admin/editarUsuario.php?id=1"],
    },
    "malaga-supercars": {
        "prefix": "/malaga-supercars/",
        "start": ["MalagaSupercarsHome.php", "MalagaSupercarsAboutUs.html", "MalagaSupercarsContact.html",
                  "MalagaSupercarsForm.html", "MalagaSupercarsForm3.html", "MalagaSupercarsForm4.html"],
        "auth_start": [],
        "login": None,
        "api_gets": [],
    },
    "happy-paws": {
        "prefix": "/happy-paws/",
        "start": ["index.html"],
        "auth_start": [],
        "login": None,
        "api_gets": [],
    },
}

SKIP = re.compile(r"logout|send_notifications", re.I)
LOCAL_HOSTS = re.compile(r"^(localhost|127\.\d+\.\d+\.\d+|0\.0\.0\.0|.*\.local)$", re.I)
ASSET_EXT = re.compile(r"\.(css|js|png|jpe?g|gif|webp|svg|ico|woff2?|ttf|mp4|webm|pdf)(\?|$)", re.I)


class Fetcher:
    """GET with a cookie jar; follows redirects by hand so we can inspect where they lead."""

    class _NoRedirect(urllib.request.HTTPRedirectHandler):
        def redirect_request(self, *args, **kwargs):
            return None

    def __init__(self):
        self.opener = urllib.request.build_opener(
            urllib.request.HTTPCookieProcessor(http.cookiejar.CookieJar()), self._NoRedirect()
        )
        self.cache = {}

    def _once(self, url, data=None):
        body = urllib.parse.urlencode(data).encode() if data else None
        url = urllib.parse.quote(url, safe=":/?&=%#+@,;~!*'()[]$")  # non-ASCII names, like a browser
        req = urllib.request.Request(url, data=body, headers={"User-Agent": "link-check"})
        try:
            with self.opener.open(req, timeout=30) as r:
                return r.status, dict(r.headers), r.read()
        except urllib.error.HTTPError as e:
            return e.code, dict(e.headers), e.read()
        except Exception as e:  # DNS, TLS, timeout
            return f"ERR {type(e).__name__}", {}, b""

    def get(self, url):
        """Returns (status, final_url, headers, body, redirect_chain)."""
        key = url.split("#")[0]
        if key in self.cache:
            return self.cache[key]
        chain, cur = [], key
        for _ in range(6):
            status, headers, body = self._once(cur)
            loc = headers.get("Location") or headers.get("location")
            if isinstance(status, int) and status in (301, 302, 303, 307, 308) and loc:
                cur = urllib.parse.urljoin(cur, loc)
                chain.append(cur)
                continue
            self.cache[key] = (status, cur, headers, body, chain)
            return self.cache[key]
        self.cache[key] = ("redirect loop", cur, {}, b"", chain)
        return self.cache[key]

    def post(self, url, data):
        return self._once(url, data)


class RefParser(HTMLParser):
    ATTRS = {"a": "href", "link": "href", "img": "src", "script": "src", "iframe": "src",
             "source": "src", "video": "src", "audio": "src", "form": "action", "area": "href"}

    def __init__(self):
        super().__init__(convert_charrefs=True)
        self.refs = []          # (tag, url)
        self.inline_css = []    # text of <style> blocks and style="" attributes

    def handle_starttag(self, tag, attrs):
        a = dict(attrs)
        attr = self.ATTRS.get(tag)
        rel = (a.get("rel") or "").lower()
        if tag == "link" and any(w in rel for w in ("preconnect", "dns-prefetch")):
            attr = None  # a connection hint, not a file
        if attr and a.get(attr):
            self.refs.append((tag, a[attr].strip()))
        if a.get("style"):
            self.inline_css.append(a["style"])
        if tag == "meta" and (a.get("http-equiv") or "").lower() == "refresh" and "url=" in (a.get("content") or "").lower():
            self.refs.append(("meta-refresh", a["content"].split("=", 1)[1].strip()))

    def handle_data(self, data):
        if self.get_starttag_text() and self.get_starttag_text().lower().startswith("<style"):
            self.inline_css.append(data)


def css_urls(text):
    return [u.strip("'\" ") for u in re.findall(r"url\(\s*([^)]+?)\s*\)", text)]


def js_paths(text):
    """Path-like string literals (no template placeholders) that look like local pages/endpoints."""
    found = set()
    for m in re.finditer(r"""(['"`])((?:\.{1,2}/)[^'"`\s${}]+|[A-Za-z0-9_][A-Za-z0-9_./-]*\.(?:php|html|json))(\?[^'"`\s${}]*)?\1""", text):
        found.add(m.group(2) + (m.group(3) or ""))
    return found


def is_navigable(url):
    return not (url.startswith(("#", "mailto:", "tel:", "javascript:", "data:", "blob:", "sms:", "whatsapp:")) or url == "")


def run(base, auth, check_external, max_pages):
    base = base.rstrip("/")
    host = urllib.parse.urlparse(base).netloc
    problems, checked = [], 0

    def problem(app, page, ref, msg):
        problems.append((app, page, ref, msg))

    for app, cfg in APPS.items():
        prefix, fetcher, seen_pages, queue = cfg["prefix"], Fetcher(), set(), []
        checked_urls = set()
        print(f"\n{app}  {base}{prefix}")

        # Logged-out visitors to protected pages must be sent somewhere that works, inside this app.
        for path in cfg.get("protected", []):
            st, final, _, _, chain = Fetcher().get(base + prefix + path)
            checked += 1
            final_path = urllib.parse.urlparse(final).path
            if path.startswith("backend/") and st in (200, 401, 403) and not chain:
                continue  # an API answering "not authorised" directly is fine
            if st != 200 or not final_path.startswith(prefix):
                problem(app, "(logged out) " + path, final_path, f"protected page sends visitors to a broken/foreign page: HTTP {st}")

        if auth and cfg["login"]:
            path, creds = cfg["login"]
            status, headers, _ = fetcher.post(f"{base}{prefix}{path}", creds)
            print(f"  signed in as demo user (HTTP {status})")

        starts = list(cfg["start"]) + (list(cfg["auth_start"]) if auth else [])
        queue = [(base + prefix + s, None) for s in starts]
        api_gets = [base + prefix + p for p in (cfg["api_gets"] if auth else [])]
        js_seen = {}     # js url -> list of pages that load it
        page_count = 0

        while queue and page_count < max_pages:
            url, via = queue.pop(0)
            key = url.split("#")[0]
            if key in seen_pages or SKIP.search(key):
                continue
            seen_pages.add(key)
            status, final, headers, body, chain = fetcher.get(key)
            page_count += 1
            checked += 1
            label = key.replace(base, "")
            if status != 200:
                # A redirect to the login page for a protected page is fine; anything else is not.
                problem(app, via or "(entry page)", label, f"HTTP {status}")
                continue
            final_path = urllib.parse.urlparse(final).path
            if chain and not final_path.startswith(prefix):
                problem(app, via or "(entry page)", label, f"redirects OUTSIDE the app -> {final_path}")
            ctype = headers.get("Content-Type", "")
            if "html" not in ctype:
                continue
            parser = RefParser()
            parser.feed(body.decode("utf-8", "replace"))
            page_url = final

            for tag, raw in parser.refs:
                if not is_navigable(raw):
                    continue
                parsed = urllib.parse.urlparse(raw)
                # 1) absolute URLs
                if parsed.scheme in ("http", "https"):
                    h = parsed.hostname or ""
                    if LOCAL_HOSTS.match(h):
                        problem(app, label, raw, f"<{tag}> points at {h} (works only on the developer's machine)")
                        continue
                    if parsed.netloc != host:
                        if check_external and tag in ("script", "link", "img", "source"):
                            st = fetcher.get(raw)[0]
                            if st != 200 and raw not in checked_urls:
                                problem(app, label, raw, f"external {tag} returns HTTP {st}")
                            checked_urls.add(raw)
                        continue
                # 2) root-absolute
                if raw.startswith("/") and not raw.startswith("//") and not raw.startswith(prefix):
                    problem(app, label, raw, f"<{tag}> root-absolute path escapes {prefix}")
                    continue
                target = urllib.parse.urljoin(page_url, raw).split("#")[0]
                if not urllib.parse.urlparse(target).path.startswith(prefix) and urllib.parse.urlparse(target).netloc == host:
                    problem(app, label, raw, f"<{tag}> resolves outside the app -> {urllib.parse.urlparse(target).path}")
                    continue
                if urllib.parse.urlparse(target).netloc != host:
                    continue
                if tag == "script" and target.endswith(".js"):
                    js_seen.setdefault(target, []).append(page_url)
                if tag == "form":
                    # Never submit: just make sure the endpoint exists (POST-only endpoints answer 200/400/405, not 404).
                    st = fetcher.get(target)[0]
                    checked += 1
                    if st in (404,) or (isinstance(st, str)):
                        problem(app, label, raw, f"<form> action returns HTTP {st}")
                    continue
                is_page = tag == "a" and not ASSET_EXT.search(target)
                if is_page:
                    if target not in seen_pages and not SKIP.search(target):
                        queue.append((target, label))
                else:
                    if target in checked_urls:
                        continue
                    checked_urls.add(target)
                    st, fin, hdrs, bod, _ = fetcher.get(target)
                    checked += 1
                    if st != 200:
                        problem(app, label, raw, f"<{tag}> returns HTTP {st}")
                    elif target.endswith(".css"):
                        for u in css_urls(bod.decode("utf-8", "replace")):
                            if not is_navigable(u) or u.startswith(("http:", "https:", "//")):
                                if u.startswith(("http:", "https:")) and LOCAL_HOSTS.match(urllib.parse.urlparse(u).hostname or ""):
                                    problem(app, target.replace(base, ""), u, "CSS url() points at localhost")
                                continue
                            t2 = urllib.parse.urljoin(fin, u).split("#")[0].split("?")[0]
                            if t2 in checked_urls:
                                continue
                            checked_urls.add(t2)
                            checked += 1
                            s2 = fetcher.get(t2)[0]
                            if s2 != 200:
                                problem(app, target.replace(base, ""), u, f"CSS url() returns HTTP {s2}")

            for css in parser.inline_css:
                for u in css_urls(css):
                    if is_navigable(u) and not u.startswith(("http:", "https:", "//")):
                        t2 = urllib.parse.urljoin(page_url, u).split("#")[0]
                        if t2 not in checked_urls:
                            checked_urls.add(t2)
                            checked += 1
                            s2 = fetcher.get(t2)[0]
                            if s2 != 200:
                                problem(app, label, u, f"inline CSS url() returns HTTP {s2}")

        # Paths mentioned in this app's own JavaScript (fetch targets, redirects, image templates).
        for js_url, pages in js_seen.items():
            if ".min." in js_url:
                continue
            st, _, _, body, _ = fetcher.get(js_url)
            if st != 200:
                continue
            for p in sorted(js_paths(body.decode("utf-8", "replace"))):
                if SKIP.search(p) or p.startswith(("http", "//", "/")):
                    continue
                # relative paths in JS resolve against the page that runs the script
                results = []
                for pg in sorted(set(pages)):
                    t = urllib.parse.urljoin(pg, p).split("#")[0]
                    if t in checked_urls and t in fetcher.cache:
                        results.append(fetcher.cache[t][0])
                    else:
                        checked_urls.add(t)
                        results.append(fetcher.get(t)[0])
                        checked += 1
                if results and all(r == 404 for r in results):
                    problem(app, js_url.replace(base, ""), p, "JavaScript refers to a path that is 404 from every page loading it")
        for api in api_gets:
            st = fetcher.get(api)[0]
            checked += 1
            if st != 200:
                problem(app, "(api)", api.replace(base, ""), f"HTTP {st}")

    return problems, checked


def main():
    ap = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    ap.add_argument("base", help="hub root, e.g. http://localhost:8080 or https://lautaro-demos.onrender.com")
    ap.add_argument("--auth", action="store_true", help="also sign in with the demo accounts and crawl logged-in pages")
    ap.add_argument("--external", action="store_true", help="also verify external scripts/styles/images (CDNs, hotlinked images)")
    ap.add_argument("--max-pages", type=int, default=40, help="page limit per app (default 40)")
    a = ap.parse_args()
    problems, checked = run(a.base, a.auth, a.external, a.max_pages)
    print(f"\nChecked {checked} URLs.")
    if problems:
        grouped = {}
        for app, page, ref, msg in problems:
            grouped.setdefault((app, ref, msg), []).append(page)
        print(f"\n{len(grouped)} PROBLEM(S):")
        for (app, ref, msg), pages in grouped.items():
            uniq = sorted(set(pages))
            where = uniq[0] if len(uniq) == 1 else f"{len(uniq)} pages, e.g. {uniq[0]}"
            print(f"  [{app}] {ref}\n      -> {msg}\n      found on: {where}")
        sys.exit(1)
    print("No routing problems found.")


if __name__ == "__main__":
    main()
