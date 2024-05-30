FROM composer:2.7.4 as build-stage

WORKDIR /usr/src/app
COPY . .

RUN composer install \
    && rm ./composer.json \
    && rm ./composer.lock \
    && sed -i "s/root/appuser/g" ./db.php

FROM php:7.4-alpine

EXPOSE 5000

WORKDIR /usr/src/app
COPY --from=build-stage /usr/src/app .

RUN apk update \
    && adduser -S appuser \
    && apk add mariadb mariadb-client \
    && docker-php-ext-install pdo_mysql \
    && mysql_install_db --user=appuser --datadir=/var/lib/mysql \
    && /usr/bin/mariadbd-safe --nowatch --user=appuser\
    && sleep 1 \
    && mariadb -u root -e "CREATE DATABASE IF NOT EXISTS prnt;" \
    && mariadb -u root prnt < prnt.sql \
    && chown -R appuser . \
    && chmod +x start.sh

USER appuser

ENTRYPOINT ["/usr/src/app/start.sh"]
