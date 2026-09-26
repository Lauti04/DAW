FROM php:8.3-apache

# Same extensions the apps use on a normal shared host.
RUN docker-php-ext-install mysqli pdo_mysql \
 && cp "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
