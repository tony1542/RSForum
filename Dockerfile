# Get PHP/Apache 8.1 image
FROM php:8.1-apache
WORKDIR /var/www/html

# Copy files over and expose port
COPY server/ server
COPY server/composer.json ./

# TODO somehow to init the db said against our db container?

# Install git, PDO, mysqli and enable apache rewriting
RUN apt-get update \
    && apt-get install -y git \
    libzip-dev \
    zip
RUN docker-php-ext-install pdo pdo_mysql mysqli zip
RUN a2enmod rewrite

# Install utils
RUN apt-get install -y nano

# Install Composer & run the install for project dependencies
#RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
#RUN php composer-setup.php --install-dir=. --filename=composer
#RUN mv composer /usr/local/bin/
#RUN composer install
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN composer install

# Expose the port to use
EXPOSE 80