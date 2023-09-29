# composer で関連ライブラリインストール用イメージ
FROM php:7.1-fpm-buster AS composer

ENV COMPOSER_ALLOW_SUPERUSER 1

# CakePHP が依存している拡張機能
RUN apt update
RUN apt -y install libzip-dev
RUN docker-php-ext-install zip

RUN mkdir /app
WORKDIR /app

COPY composer.phar /app/composer.phar
COPY composer.json /app/composer.json
COPY composer.lock /app/composer.lock

RUN php composer.phar install

# アプリ用イメージ
FROM php:7.1-fpm-buster

# CakePHP が依存している拡張機能
RUN apt update
RUN apt -y install libzip-dev
RUN docker-php-ext-install zip

# MySQL へ DB 保存する拡張機能
RUN docker-php-ext-install pdo_mysql

# デバッグ実行に必要な拡張機能
RUN pecl install xdebug-2.9.8
RUN docker-php-ext-enable xdebug

WORKDIR /var/www/html

COPY ./docker/local/php-fpm/php.ini /usr/local/etc/php/php.ini
COPY . /var/www/html
COPY --from=composer /app/Vendor /var/www/html/Vendor
COPY --from=composer /app/Plugin /var/www/html/Plugin

# PHPCodeSniffer に CakePHP をセットする
RUN Vendor/bin/phpcs --config-set installed_paths Vendor/cakephp/cakephp-codesniffer
