#!/usr/bin/env python3
"""Smoke tests for the four demo apps (standard library only, no installs needed).

  python3 deploy/smoke_test.py                 # against the local Docker setup (ports 8081-8084)
  python3 deploy/smoke_test.py --eventflow https://host/eventflow --dulce https://host/dulce-encanto \
                               --malaga https://host/malaga-supercars --happypaws https://host/happy-paws

Tests that WRITE data (register users, create/delete rows) only run against localhost
unless you pass --write. Note: some free hosts (e.g. InfinityFree) show a browser-check page
to non-browser clients, so scripted checks against them can fail even when the site is fine —
use the manual checklist in deploy/DEPLOY.md for those.
"""
import argparse
import json
import re
import sys
import urllib.error
import urllib.parse
import urllib.request
from http.cookiejar import CookieJar

DEMO_LOGIN = {
    "eventflow": ("demo@eventflow.demo", "demo1234"),
    "dulce": ("demo", "demo1234"),
    "malaga": ("juanperez@example.com", "contraseña123"),
}


class NoRedirect(urllib.request.HTTPRedirectHandler):
    def redirect_request(self, *args, **kwargs):
        return None


class Client:
    """Tiny HTTP client with a cookie jar that does NOT follow redirects (so we can assert on them)."""

    def __init__(self, base):
        self.base = base.rstrip("/")
        self.opener = urllib.request.build_opener(
            urllib.request.HTTPCookieProcessor(CookieJar()), NoRedirect()
        )

    def request(self, path, data=None, json_body=None):
        url = f"{self.base}/{path.lstrip('/')}"
        headers = {"User-Agent": "demo-smoke-test"}
        body = None
        if json_body is not None:
            body = json.dumps(json_body).encode()
            headers["Content-Type"] = "application/json"
        elif data is not None:
            body = urllib.parse.urlencode(data).encode()
        req = urllib.request.Request(url, data=body, headers=headers)
        try:
            with self.opener.open(req, timeout=20) as r:
                return r.status, dict(r.headers), r.read().decode("utf-8", "replace")
        except urllib.error.HTTPError as e:
            return e.code, dict(e.headers), e.read().decode("utf-8", "replace")

    def get(self, path):
        return self.request(path)

    def post(self, path, data=None, json_body=None):
        return self.request(path, data=data or {}, json_body=json_body)

    def get_json(self, path):
        status, _, text = self.get(path)
        try:
            return json.loads(text)
        except ValueError:
            return {"success": False, "raw": text[:80]}

    def post_json(self, path, payload):
        _, _, text = self.post(path, json_body=payload)
        try:
            return json.loads(text)
        except ValueError:
            return {"success": False, "raw": text[:80]}


failures = 0


def check(name, ok, detail=""):
    global failures
    if not ok:
        failures += 1
    print(f"  {'PASS' if ok else 'FAIL'}  {name}" + (f"  ({detail})" if detail and not ok else ""))


def redirect_to(headers, fragment):
    return fragment in headers.get("Location", "")


# --------------------------------------------------------------------------------------------
def test_eventflow(base, write):
    print(f"\nEventFlow  {base}")
    c = Client(base)
    email, password = DEMO_LOGIN["eventflow"]

    status, headers, _ = c.get("/")
    check("root redirects to the app", status in (301, 302) and redirect_to(headers, "frontend/home.php"), status)
    check("home page loads", c.get("frontend/home.php")[0] == 200)
    check("login page loads", c.get("frontend/login_view.php")[0] == 200)
    rejected = c.post("backend/auth/login.php", {"email": email, "password": "wrong"})[2]
    check("wrong password is rejected", '"success":false' in rejected)
    ok = c.post("backend/auth/login.php", {"email": email, "password": password})[2]
    check("demo account can log in", '"success":true' in ok, ok[:60])
    check("dashboard loads when logged in", c.get("frontend/dashboard.php")[0] == 200)

    events = c.get_json("backend/api/eventos.php")
    check("events API returns seeded events", events.get("success") and len(events.get("data", [])) >= 1, events.get("raw", ""))
    cats = c.get_json("backend/api/categorias.php")
    check("categories exist (required to create events)", cats.get("success") and len(cats.get("data", [])) >= 1)
    check("reminders API works", c.get_json("backend/api/recordatorios.php").get("success"))
    check("tasks API works", c.post_json("backend/api/tareas.php", {"action": "listar"}).get("success"))
    check("debug file test_db.php is gone", c.get("backend/test_db.php")[0] in (403, 404))
    check("notification script is not runnable from the web", c.get("backend/send_notifications.php")[0] == 403)

    if write:
        made = c.post_json("backend/api/eventos.php", {"action": "crear", "titulo": "Smoke test", "fecha_inicio": "2030-01-01 10:00:00", "id_categoria": 1})
        check("can create an event", made.get("success"), str(made)[:80])
        if made.get("success"):
            gone = c.post_json("backend/api/eventos.php", {"action": "borrar", "id_evento": made["id_evento"]})
            check("can delete that event", gone.get("success"), str(gone)[:80])


def test_dulce(base, write):
    print(f"\nDulce Encanto  {base}")
    c = Client(base)
    user, password = DEMO_LOGIN["dulce"]

    status, headers, _ = c.get("/")
    check("root redirects to the app", status in (301, 302) and redirect_to(headers, "templates/home.php"), status)
    for page in ("templates/home.php", "templates/productos.php", "templates/contacto.php"):
        check(f"{page} loads", c.get(page)[0] == 200)
    check("product image loads (relative path fix)", c.get("assets/images/productos/torta-de-chocolate.webp")[0] == 200)

    check("admin without session redirects to login", c.get("admin/admin.php")[0] in (301, 302))
    _, _, bad = c.post("admin/login.php", {"username": user, "password": "definitely-wrong"})
    check("wrong password is rejected (was an auth bypass)", "incorrectos" in bad)
    _, _, unknown = c.post("admin/login.php", {"username": "no-such-user", "password": "x"})
    check("unknown user is rejected", "incorrectos" in unknown)
    status, headers, _ = c.post("admin/login.php", {"username": user, "password": password})
    check("demo admin can log in", status == 302 and redirect_to(headers, "admin.php"), status)
    check("admin page loads when logged in", c.get("admin/admin.php")[0] == 200)
    check("recipes are listed", "Cupcakes de Vainilla" in c.get("admin/listarRecetas.php")[2])

    if write:
        name = "smoketest"
        c2 = Client(base)
        c2.post("admin/registro.php", {"nombre": "Smoke", "apellidos": "Test", "nacimiento": "1999-01-01", "username": name, "password": "secret99"})
        status, headers, _ = c2.post("admin/login.php", {"username": name, "password": "secret99"})
        check("newly registered user can log in", status == 302, status)
        _, _, bad = c2.post("admin/login.php", {"username": name, "password": "nope"})
        check("new user's wrong password is rejected", "incorrectos" in bad)


def count_cars(html):
    return len(re.findall(r'<div class="item">', html))


def test_malaga(base, write):
    print(f"\nMalaga Supercars  {base}")
    c = Client(base)
    email, password = DEMO_LOGIN["malaga"]

    status, headers, _ = c.get("/")
    check("root redirects to the app", status in (301, 302) and redirect_to(headers, "MalagaSupercarsHome.php"), status)
    home = c.get("MalagaSupercarsHome.php")[2]
    check("catalogue lists all 20 cars", count_cars(home) == 20, f"{count_cars(home)} cars")
    check("catalogue shows no PHP errors", not re.search(r"Deprecated|Warning|Fatal|Error:", home))
    check("filter by brand (stored procedure)", count_cars(c.get("MalagaSupercarsHome.php?marca=FERRARI")[2]) == 4)
    check("filter by max price", count_cars(c.get("MalagaSupercarsHome.php?precio_max=100000")[2]) == 4)
    check("filter by year", count_cars(c.get("MalagaSupercarsHome.php?anio=2022")[2]) == 3)
    check("empty search form returns everything", count_cars(c.get("MalagaSupercarsHome.php?marca=&modelo=&precio_max=&anio=")[2]) == 20)
    check("car image loads", c.get("assets/images/cars/coche1.jpg")[0] == 200)
    for page in ("MalagaSupercarsAboutUs.html", "MalagaSupercarsContact.html", "MalagaSupercarsForm.html"):
        check(f"{page} loads", c.get(page)[0] == 200)

    ok = c.post("MalagaSupercarsForm2.php", {"action": "login", "email": email, "password": password})[2]
    check("seeded user can log in", "exitoso" in ok, ok[:60])
    bad = c.post("MalagaSupercarsForm2.php", {"action": "login", "email": email, "password": "wrong"})[2]
    check("wrong password is rejected", "incorrectos" in bad)

    if write:
        new = {"nombre": "Smoke Test", "email": "smoke@test.dev", "password": "abc12345", "telefono": "600000000"}
        check("can register a user", "exitosamente" in c.post("MalagaSupercarsForm.php", {"action": "register", **new})[2])
        check("new user can log in", "exitoso" in c.post("MalagaSupercarsForm2.php", {"action": "login", "email": new["email"], "password": new["password"]})[2])
        check("delete-account rejects a wrong password", "incorrecta" in c.post("MalagaSupercarsForm3.php", {"email": new["email"], "password": "zzz"})[2])
        check("delete-account works with the right password", "eliminado" in c.post("MalagaSupercarsForm3.php", {"email": new["email"], "password": new["password"]})[2])
        car = {"action": "register", "marca": "TEST", "modelo": "Z1", "ano": "2024", "precio": "99000", "descripcion": "x", "imagen": "x"}
        check("can insert a car (procedure)", "insertado" in c.post("MalagaSupercarsForm4.php", car)[2])
        check("trigger blocks a price of 0", "mayor que cero" in c.post("MalagaSupercarsForm4.php", {**car, "modelo": "Z2", "precio": "0"})[2])
        check("can delete that car (procedure)", "eliminado" in c.post("MalagaSupercarsForm4.php", {"action": "delete", "marca": "TEST", "modelo": "Z1"})[2])


def test_happypaws(base, write):
    print(f"\nHappy Paws  {base}")
    c = Client(base)
    status, _, html = c.get("/")
    check("home page loads", status == 200 and "<html" in html.lower(), status)
    for asset in re.findall(r'(?:src|href)="([^"#:]+\.(?:css|js|webp|jpg|png))"', html)[:6]:
        check(f"asset loads: {asset}", c.get(asset)[0] == 200)


def test_isolation(eventflow, dulce):
    print(f"\nLogin isolation between apps")
    ef_email, ef_pw = DEMO_LOGIN["eventflow"]
    du_user, du_pw = DEMO_LOGIN["dulce"]

    only_dulce = Client(dulce)
    only_dulce.post("admin/login.php", {"username": du_user, "password": du_pw})
    other = Client(eventflow)
    other.opener = only_dulce.opener  # same "browser", different app
    status = other.get("backend/api/eventos.php")[0]
    check("signing in to Dulce Encanto does not sign you in to EventFlow", status != 200, f"HTTP {status}")

    only_ef = Client(eventflow)
    only_ef.post("backend/auth/login.php", {"email": ef_email, "password": ef_pw})
    other = Client(dulce)
    other.opener = only_ef.opener
    status = other.get("admin/admin.php")[0]
    check("signing in to EventFlow does not open the Dulce Encanto admin", status in (301, 302), f"HTTP {status}")


# --------------------------------------------------------------------------------------------
def main():
    p = argparse.ArgumentParser(description=__doc__, formatter_class=argparse.RawDescriptionHelpFormatter)
    p.add_argument("--eventflow", default="http://localhost:8081")
    p.add_argument("--dulce", default="http://localhost:8082")
    p.add_argument("--malaga", default="http://localhost:8083")
    p.add_argument("--happypaws", default="http://localhost:8084")
    p.add_argument("--write", action="store_true", help="also run tests that write data, even on a non-local host")
    p.add_argument("--only", choices=["eventflow", "dulce", "malaga", "happypaws"])
    a = p.parse_args()

    apps = [("eventflow", a.eventflow, test_eventflow), ("dulce", a.dulce, test_dulce),
            ("malaga", a.malaga, test_malaga), ("happypaws", a.happypaws, test_happypaws)]
    for key, base, fn in apps:
        if a.only and a.only != key:
            continue
        local = "localhost" in base or "127.0.0.1" in base
        try:
            fn(base, write=local or a.write)
        except Exception as e:  # network down, etc.
            global failures
            failures += 1
            print(f"  FAIL  could not run tests for {key}: {e}")

    if not a.only and urllib.parse.urlparse(a.eventflow).netloc == urllib.parse.urlparse(a.dulce).netloc:
        test_isolation(a.eventflow, a.dulce)  # only meaningful when the apps share one host, like the hub

    print(f"\n{'ALL CHECKS PASSED' if not failures else f'{failures} CHECK(S) FAILED'}")
    sys.exit(1 if failures else 0)


if __name__ == "__main__":
    main()
