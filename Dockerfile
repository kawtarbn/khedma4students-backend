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

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy application code first
COPY . .

# Copy composer file
COPY composer.json ./

# Create basic .env file for production
RUN echo "APP_ENV=production" > .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_URL=https://khedma4students-backend.onrender.com" >> .env && \
    echo "DB_CONNECTION=pgsql" >> .env && \
    echo "DB_PORT=5432" >> .env && \
    echo "CACHE_DRIVER=file" >> .env && \
    echo "SESSION_DRIVER=file" >> .env && \
    echo "QUEUE_CONNECTION=sync" >> .env

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Generate app key
RUN php artisan key:generate --force

# Cache config and routes
RUN php artisan config:cache
RUN php artisan route:cache

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 8080

# Start command with forced environment variables
CMD ["sh", "-c", "export APP_ENV=production APP_DEBUG=false APP_URL=https://khedma4students-backend.onrender.com DB_CONNECTION=pgsql DB_HOST=${DB_HOST} DB_PORT=5432 DB_DATABASE=${DB_DATABASE} DB_USERNAME=${DB_USERNAME} DB_PASSWORD=${DB_PASSWORD} CACHE_DRIVER=file SESSION_DRIVER=file QUEUE_CONNECTION=sync && php artisan key:generate --force && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080"]
