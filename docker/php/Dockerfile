FROM php:8.4-apache
WORKDIR /var/www/html

COPY ../../server ./

RUN apt-get update \
    && apt-get install -y libzip-dev zip nano
RUN docker-php-ext-install pdo pdo_mysql mysqli zip

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN a2enmod rewrite

COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN cd /var/www/html && composer install --no-interaction

EXPOSE 80