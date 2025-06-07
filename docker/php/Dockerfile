FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    sqlite3 libsqlite3-dev unzip && \
    docker-php-ext-install pdo pdo_sqlite

RUN a2enmod rewrite

COPY ./docker/php/apache.conf /etc/apache2/sites-available/000-default.conf

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
