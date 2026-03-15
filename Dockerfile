FROM php:8.2-cli

# Basic dependencies
RUN apt-get update && apt-get install -y git zip unzip

# PHP extensions commonly used by Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json composer.lock ./
RUN composer install --no-interaction --prefer-dist --optimize-autoloads

COPY . .

EXPOSE 8000
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port", "8000"]
