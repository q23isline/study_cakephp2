# composer で関連ライブラリインストール用イメージ
FROM php:7.1-fpm-buster

ENV COMPOSER_ALLOW_SUPERUSER 1

COPY ./docker/prod/php-fpm/php.ini /usr/local/etc/php/php.ini

RUN apt update \
    && apt -y install libzip-dev \
    && docker-php-ext-install zip pdo_mysql

WORKDIR /var/www/html

COPY composer.phar composer.phar
COPY composer.json composer.json
COPY composer.lock composer.lock

RUN php composer.phar install --no-dev

COPY . /var/www/html
