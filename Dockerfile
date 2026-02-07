FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install system dependencies for PostgreSQL
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    libpq-dev

# Install PHP extensions
RUN docker-php-ext-install \
    pdo_mysql \
    pdo_pgsql \
    mbstring \
    bcmath \
    gd \
    zip \
    opcache

# Copy composer files
COPY composer.json composer.lock ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy application code
COPY . .

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 8080

# Start command
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
