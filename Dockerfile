# Use official PHP image with Apache
FROM php:8.2-apache

# Install extensions
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip git curl libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy existing application
COPY . .

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

# Change Apache DocumentRoot to public/
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|' /etc/apache2/sites-available/000-default.conf

# Restart Apache to apply changes
CMD ["apache2-foreground"]
