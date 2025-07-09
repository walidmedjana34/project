# Use official PHP image with required extensions
FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libpq-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install PHP dependencies (this creates vendor/)
RUN composer install --no-dev --optimize-autoloader

# Set permissions (optional but recommended)
RUN chown -R www-data:www-data /var/www/html

# Laravel-specific: cache config
RUN php artisan config:cache

# Serve Laravel with built-in PHP server
CMD php -S 0.0.0.0:8000 -t public
