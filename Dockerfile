FROM composer:2.7.4

EXPOSE 5000
WORKDIR /usr/src/app

RUN apk update \
    && apk add mariadb mariadb-client \
    && docker-php-ext-install pdo_mysql

RUN mysql_install_db --user=mysql --datadir=/var/lib/mysql

COPY . .

RUN /usr/bin/mariadbd-safe --nowatch \
    && sleep 1 \
    && mariadb -u root -e "CREATE DATABASE IF NOT EXISTS prnt;" \
    && mariadb -u root prnt < prnt.sql

RUN composer install

RUN chmod +x start.sh

ENTRYPOINT ["/usr/src/app/start.sh"]
