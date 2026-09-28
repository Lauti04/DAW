# Deploying the live demos (free)

The four projects (EventFlow, Dulce Encanto, Malaga Supercars, Happy Paws) run from **one Docker
container** (Apache + PHP + MariaDB). Everything lives under one URL:

```
https://<your-service>.onrender.com/                     landing page with all four demos
https://<your-service>.onrender.com/eventflow/
https://<your-service>.onrender.com/dulce-encanto/
https://<your-service>.onrender.com/malaga-supercars/
https://<your-service>.onrender.com/happy-paws/
```

## 1. Try it on your machine first

Needs Docker Desktop.

```bash
docker build -f deploy/Dockerfile -t daw-demo-hub .
docker run --rm -p 8080:8080 daw-demo-hub          # http://localhost:8080
python3 deploy/smoke_test.py --eventflow http://localhost:8080/eventflow \
  --dulce http://localhost:8080/dulce-encanto --malaga http://localhost:8080/malaga-supercars \
  --happypaws http://localhost:8080/happy-paws      # 57 checks, all should PASS
python3 deploy/link_check.py http://localhost:8080 --auth --external   # routing / broken-link crawl
```

Per-app containers that mirror a normal shared host (handy while developing):
`cd deploy && docker compose up --build` -> ports 8081-8084, then `python3 deploy/smoke_test.py`.

## 2. Deploy for free on Render

Only you can do the account steps (they need your login):

1. Push this branch to GitHub.
2. Create a free account at <https://render.com> (sign in with GitHub).
3. **New -> Blueprint**, choose the `DAW` repo and the branch with `render.yaml`, click **Apply**.
   - If the name `lautaro-demos` is taken, change `name:` in `render.yaml` first.
   - Render builds the Docker image (about 3-5 minutes) and gives you the URL.
4. Open the URL, click through the four demos, and run the smoke test against it (see section 4).

> Render may ask for a payment card only to verify your account. If it insists on a card you
> don't want to use, see "Alternatives" below.

## 3. Things to know about the free tier

- **Sleeps after 15 minutes without visitors** and takes about a minute to wake up. Optional fix:
  a free uptime monitor (e.g. UptimeRobot, HTTP check every 5 minutes on your URL) keeps it awake.
  One always-on service uses about 744 of the 750 free hours per month, which is why all four demos
  share a single service.
- **The disk is temporary.** Data is reloaded from `db/demo.sql` on every start and every
  `RESET_EVERY_HOURS` (6) hours, so visitors can't leave the demos broken, and EventFlow's sample
  dates always look current. Anything a visitor creates disappears at the next reset - that's intended.
- **Demo accounts** (also shown on the landing page):
  - EventFlow: `demo@eventflow.demo` / `demo1234`
  - Dulce Encanto admin (`/dulce-encanto/admin/login.php`): `demo` / `demo1234`
  - Malaga Supercars: `juanperez@example.com` / `contraseña123`

## 4. Check the live site

```bash
python3 deploy/smoke_test.py --eventflow https://<name>.onrender.com/eventflow \
  --dulce https://<name>.onrender.com/dulce-encanto --malaga https://<name>.onrender.com/malaga-supercars \
  --happypaws https://<name>.onrender.com/happy-paws
```
Tests that write data are skipped on non-local URLs unless you add `--write`. The first request can
take a minute (cold start).

Check every link, image, stylesheet and redirect in all four apps (public pages only, no logins, nothing
is written):

```bash
python3 deploy/link_check.py https://<name>.onrender.com
```

Add `--auth` to also sign in with the demo accounts and crawl the logged-in pages, and `--external` to
verify the CDN files and hotlinked images. It reports links that 404, links pointing at `localhost`,
paths that escape an app's folder, and protected pages that send logged-out visitors somewhere broken.

## Apps share one domain, not one login

All four apps live on the same domain and use the same session key, so the Apache config gives each
its own session cookie (`EVENTFLOWSESS`, `DULCEENCANTOSESS`, `MALAGASESS`, each limited to its own
folder). Without that, signing in to one app would silently sign you in to another.
Paths inside the apps must stay **relative** (`../backend/...`, `MalagaSupercarsHome.php`): an app
can't assume it sits at `/` or has a particular folder name.

## How credentials are handled

No password is committed. Each app reads its database settings from, in order: environment
variables (`DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER`, `DB_PASS`), then a git-ignored
`config.local.php` (copy `config.example.php`), then local-development defaults. In the container
the start-up script generates a random database password on every boot and writes it into each app's
`config.local.php`; the database only listens on `127.0.0.1` inside the container.

The old plaintext password file and the hardcoded Hostinger logins were removed from the working tree
but **still exist in older commits of this public repo**. That Hostinger account no longer exists, so
nothing is exposed - but if you ever reused that password anywhere, change it there.

## Alternatives (why not these?)

| Option | Verdict |
|---|---|
| **InfinityFree** (free PHP + MySQL, no sleep) | Blocks stored procedures on free plans, so Malaga Supercars can't run there. EventFlow, Dulce Encanto and Happy Paws would work. Also shows a "browser check" page to non-browser clients. |
| **Oracle Cloud Always Free VM** | Most powerful and always on, but needs card verification and you administer a Linux server yourself. |
| **Koyeb / Fly.io / Railway** | Free allowances are tiny or gone; Fly and Railway need a card / paid plan. |
| **Render + external MySQL (Aiven)** | Aiven's free MySQL powers itself off when idle and needs restarting by hand - bad for demos. |
