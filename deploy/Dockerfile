# One container serving all four demos (Apache + PHP + MariaDB), built from the repo root:
#   docker build -f deploy/Dockerfile -t daw-demo-hub .
#   docker run --rm -p 8080:8080 daw-demo-hub        ->  http://localhost:8080
FROM php:8.3-apache

ENV TZ=Europe/Madrid \
    DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
 && apt-get install -y --no-install-recommends mariadb-server tzdata \
 && rm -rf /var/lib/apt/lists/* \
 && docker-php-ext-install mysqli pdo_mysql \
 && cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
 && echo "ServerName localhost" > /etc/apache2/conf-available/servername.conf \
 && a2enconf servername

COPY deploy/hub/php-hub.ini     /usr/local/etc/php/conf.d/zz-hub.ini
COPY deploy/hub/apache-hub.conf /etc/apache2/conf-available/hub.conf
COPY deploy/hub/mariadb-hub.cnf /etc/mysql/mariadb.conf.d/99-hub.cnf
RUN a2enconf hub

COPY deploy/hub/index.html /var/www/html/index.html
COPY Projects/EventFlow/          /var/www/html/eventflow/
COPY Projects/ProyectoPasteleria/ /var/www/html/dulce-encanto/
COPY ["Projects/Examen 3º evaluación/", "/var/www/html/malaga-supercars/"]
COPY Projects/HappyPaws/          /var/www/html/happy-paws/

# Keep the SQL out of the web root: it is loaded at start-up, never served over HTTP.
RUN mkdir -p /opt/demo-sql \
 && cp /var/www/html/eventflow/db/demo.sql          /opt/demo-sql/eventflow.sql \
 && cp /var/www/html/dulce-encanto/db/demo.sql      /opt/demo-sql/dulce-encanto.sql \
 && cp /var/www/html/malaga-supercars/db/demo.sql   /opt/demo-sql/malaga-supercars.sql \
 && rm -rf /var/www/html/*/db /var/www/html/*/node_modules /var/www/html/*/.vscode \
 && find /var/www/html -type f \( -name '*.sql' -o -name '*.md' -o -name 'package*.json' -o -name '.DS_Store' -o -name 'config.example.php' \) -delete

COPY deploy/hub/entrypoint.sh /usr/local/bin/hub-entrypoint
RUN chmod +x /usr/local/bin/hub-entrypoint

ENV PORT=8080 \
    RESET_EVERY_HOURS=6
EXPOSE 8080
ENTRYPOINT ["hub-entrypoint"]
