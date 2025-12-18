FROM php:8.3-fpm-alpine3.22

ENV PHP_IDE_CONFIG 'serverName=pim'

# Установка дополнительных PHP расширений
RUN apk update && apk add \
    icu-dev \
    icu-data-full \
    libpq-dev \
    libzip-dev \
    autoconf \
    gcc \
    g++ \
    linux-headers \
    make \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && docker-php-ext-install intl pdo pdo_pgsql opcache zip

# Создаем пользователя
ARG UID
ARG GID
RUN addgroup -g $GID develop && adduser -u $UID -G develop -s /bin/sh -D develop

# Устанавливаем рабочую директорию
WORKDIR /srv

RUN chown -R develop:develop /srv

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
COPY --chown=develop:develop ./project .
COPY --link=true ./docker/php/dev.ini /usr/local/etc/php/conf.d/project.ini

USER develop

#RUN composer install --optimize-autoloader