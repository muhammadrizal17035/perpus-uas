FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    nginx \
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

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

COPY nginx.conf /etc/nginx/sites-available/default

EXPOSE 80

CMD service nginx start && php-fpm