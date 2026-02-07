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

# Create .env file with hardcoded values that work
RUN echo "APP_ENV=production" > .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_URL=https://khedma4students-backend.onrender.com" >> .env && \
    echo "DB_CONNECTION=pgsql" >> .env && \
    echo "DB_HOST=dpg-d63akashg0os73cbmdf0-a" >> .env && \
    echo "DB_PORT=5432" >> .env && \
    echo "DB_DATABASE=hedma4students_db" >> .env && \
    echo "DB_USERNAME=hedma4students_db_user" >> .env && \
    echo "DB_PASSWORD=1x2f71cA90zNhGmUy6owNMud3u4Wtqhf" >> .env && \
    echo "CACHE_DRIVER=file" >> .env && \
    echo "SESSION_DRIVER=file" >> .env && \
    echo "QUEUE_CONNECTION=sync" >> .env

# Copy composer file
COPY composer.json ./

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Generate app key and run migrations
RUN php artisan key:generate --force && php artisan migrate --force

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port
EXPOSE 8080

# Start command
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]
