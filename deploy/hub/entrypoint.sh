#!/bin/bash
# Start-up for the demo hub: MariaDB (local only) -> load demo data -> Apache in the foreground.
set -euo pipefail

WEB=/var/www/html
SQL=/opt/demo-sql
DB_USER=demo
DB_PASS="$(head -c 48 /dev/urandom | base64 | tr -dc 'A-Za-z0-9' | head -c 24)"

log() { echo "[hub] $*"; }

# 1) Bind Apache to the port the platform assigns (Render sets PORT).
sed -i "s/^Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:[0-9]*>/<VirtualHost *:${PORT}>/" /etc/apache2/sites-available/000-default.conf

# 2) Start MariaDB (fresh data directory: everything here is disposable demo data).
mkdir -p /run/mysqld && chown mysql:mysql /run/mysqld
if [ ! -d /var/lib/mysql/mysql ]; then
  mariadb-install-db --user=mysql --datadir=/var/lib/mysql --skip-test-db >/dev/null
fi
mariadbd-safe --user=mysql >/var/log/mariadb-hub.log 2>&1 &
for _ in $(seq 1 60); do
  mariadb-admin ping --silent >/dev/null 2>&1 && break
  sleep 1
done
mariadb-admin ping --silent >/dev/null 2>&1 || { log "MariaDB did not start"; cat /var/log/mariadb-hub.log; exit 1; }

# 3) One database per app, all owned by a single app user with a random password.
declare -A DBS=( [eventflow]=eventflow [dulce-encanto]=dulceencanto [malaga-supercars]=malagasupercars )
# TCP connections to 127.0.0.1 and socket connections to localhost are different hosts to MariaDB.
for host in localhost 127.0.0.1; do
  mariadb -e "CREATE USER IF NOT EXISTS '${DB_USER}'@'${host}' IDENTIFIED BY '${DB_PASS}';
              ALTER USER '${DB_USER}'@'${host}' IDENTIFIED BY '${DB_PASS}';"
done
for app in "${!DBS[@]}"; do
  db="${DBS[$app]}"
  mariadb -e "CREATE DATABASE IF NOT EXISTS \`${db}\` CHARACTER SET utf8mb4;
              GRANT ALL ON \`${db}\`.* TO '${DB_USER}'@'localhost';
              GRANT ALL ON \`${db}\`.* TO '${DB_USER}'@'127.0.0.1';"
done

# 4) Give each app the same kind of config.local.php it would use on shared hosting.
write_config() { # <config dir> <database>
  cat > "$1/config.local.php" <<PHP
<?php
return ['DB_HOST' => '127.0.0.1', 'DB_PORT' => '3306', 'DB_NAME' => '$2', 'DB_USER' => '${DB_USER}', 'DB_PASS' => '${DB_PASS}'];
PHP
  chown root:www-data "$1/config.local.php" && chmod 640 "$1/config.local.php"
}
write_config "$WEB/eventflow/backend"        eventflow
write_config "$WEB/dulce-encanto/includes"   dulceencanto
write_config "$WEB/malaga-supercars"         malagasupercars

# 5) Load (and later re-load) the demo data. The SQL files drop and recreate their tables.
load_demos() {
  for app in "${!DBS[@]}"; do
    mariadb "${DBS[$app]}" < "$SQL/${app}.sql"
  done
  log "demo data loaded"
}
load_demos

# 6) Periodically reset the demos so visitors can't leave them broken, and dates stay current.
if [ "${RESET_EVERY_HOURS:-0}" -gt 0 ]; then
  (
    while true; do
      sleep "$(( RESET_EVERY_HOURS * 3600 ))"
      load_demos || log "reset failed"
    done
  ) &
fi

log "starting Apache on port ${PORT}"
exec apache2-foreground
