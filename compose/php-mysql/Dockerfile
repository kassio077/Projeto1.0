FROM php:7.4-apache-bullseye

WORKDIR /var/www/html

# RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN chmod -R 777 /var/www/html

RUN chmod -R 777 /usr/local/etc/php

RUN docker-php-ext-install mysqli