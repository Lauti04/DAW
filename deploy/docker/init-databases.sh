#!/bin/sh
# Runs once when the MariaDB container is first created: one database per app,
# each loaded from that app's db/demo.sql (the exact file you import on the real host).
set -e
for pair in eventflow:/sql/eventflow.sql dulceencanto:/sql/dulce-encanto.sql malagasupercars:/sql/malaga-supercars.sql; do
  db="${pair%%:*}"
  file="${pair#*:}"
  mariadb -uroot -p"$MARIADB_ROOT_PASSWORD" -e "CREATE DATABASE \`$db\` CHARACTER SET utf8mb4; GRANT ALL ON \`$db\`.* TO '$MARIADB_USER'@'%';"
  mariadb -uroot -p"$MARIADB_ROOT_PASSWORD" "$db" < "$file"
done
