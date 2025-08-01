FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    git \
    bash \
    icu-dev \
    libxml2-dev \
    oniguruma-dev \
    && docker-php-ext-install intl pdo pdo_mysql opcache

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
USER www-data
