FROM php:7.2-fpm
RUN apt-get update && \
    apt-get install -y libpq-dev && \
    docker-php-ext-install pdo pdo_pgsql pgsql
RUN pecl install xdebug-2.6.0RC2 && docker-php-ext-enable xdebug && docker-php-ext-install pdo_pgsql

WORKDIR /backend