FROM php:7.4-fpm

RUN apt-get update

RUN apt-get install -y zlib1g-dev libpq-dev libzip-dev git libicu-dev libxml2-dev curl apt-transport-https gnupg \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql pdo_mysql \
    && docker-php-ext-install zip xml

# Install PHP Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN usermod -u 1000 www-data

COPY --chown=www-data:www-data . /var/www/laravel

USER www-data

WORKDIR /var/www/laravel

