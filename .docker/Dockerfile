FROM php:8-fpm

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libicu-dev \
        libpq-dev \
        libxpm-dev \
        libvpx-dev && \
    docker-php-ext-install pdo_pgsql

EXPOSE 9000

ENTRYPOINT [ "php artisan serve --host=0.0.0.0" ]