FROM php:8.4-fpm-alpine3.22

# Устанавливаем рабочую директорию
WORKDIR /srv

# Установка дополнительных PHP расширений
RUN apk update && apk add \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql opcache zip

COPY ./project .

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN composer install