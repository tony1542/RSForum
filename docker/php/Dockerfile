# Get PHP/Apache 8.1 image
FROM php:8.1-apache
WORKDIR /var/www/html

# Copy files over and expose port
COPY ../../server ./

# Install PDO & mysqli
RUN apt-get update \
    && apt-get install -y libzip-dev zip
RUN docker-php-ext-install pdo pdo_mysql mysqli zip

# Debug install & enable
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN a2enmod rewrite

# Install utils
RUN apt-get install -y nano

# Install Composer & run the install for project dependencies
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer install

# Expose the port to use
EXPOSE 80