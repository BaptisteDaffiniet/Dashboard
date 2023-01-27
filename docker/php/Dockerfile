FROM composer:2.0 as composer

FROM php:7.4.1-fpm

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu

RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    unzip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install zip

RUN docker-php-ext-enable apcu

WORKDIR /usr/src/app

COPY --chown=1000:1000 dashboard /usr/src/app

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin

RUN composer install