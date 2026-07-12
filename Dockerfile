FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl gd

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN composer install --optimize-autoloader --no-dev --no-interaction

RUN rm -f /etc/apache2/mods-enabled/mpm_event.conf /etc/apache2/mods-enabled/mpm_event.load
RUN a2enmod mpm_prefork
RUN a2enmod rewrite

EXPOSE 80