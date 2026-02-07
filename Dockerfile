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

# Install dependencies
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Create basic .env file (Render will override with environment variables)
RUN echo "APP_ENV=production" > .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_URL=https://khedma4students-backend.onrender.com" >> .env && \
    echo "DB_CONNECTION=pgsql" >> .env && \
    echo "DB_PORT=5432" >> .env

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

# Start command with database setup and migrations
CMD ["sh", "-c", "echo 'DB_HOST=${DB_HOST}' >> .env && echo 'DB_DATABASE=${DB_DATABASE}' >> .env && echo 'DB_USERNAME=${DB_USERNAME}' >> .env && echo 'DB_PASSWORD=${DB_PASSWORD}' >> .env && php artisan config:clear && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=8080"]
