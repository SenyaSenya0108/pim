FROM php:8.4-fpm-alpine3.22

# Устанавливаем рабочую директорию
WORKDIR /srv

ENV PHP_IDE_CONFIG 'serverName=pim'

# Установка дополнительных PHP расширений
RUN apk update && apk add \
    libpq-dev \
    libzip-dev \
    autoconf \
    gcc \
    g++ \
    linux-headers \
    make \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install pdo pdo_pgsql opcache zip


COPY ./project .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install

COPY --link=true ./docker/php/dev.ini /usr/local/etc/php/conf.d/project.ini