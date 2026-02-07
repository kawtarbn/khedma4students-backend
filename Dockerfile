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

# Create PROPER .env file with your REAL values
RUN echo "APP_NAME=Khedma4Students" > .env && \
    echo "APP_ENV=production" >> .env && \
    echo "APP_KEY=base64:qFDIaLTFLBfsx0wLhDT/dQ0NdAccWil/M6/1Ma1h8Aw=" >> .env && \
    echo "APP_DEBUG=false" >> .env && \
    echo "APP_URL=https://khedma4students-backend.onrender.com" >> .env && \
    echo "" >> .env && \
    echo "# APP LOCALE" >> .env && \
    echo "APP_LOCALE=en" >> .env && \
    echo "APP_FALLBACK_LOCALE=en" >> .env && \
    echo "APP_FAKER_LOCALE=en_US" >> .env && \
    echo "" >> .env && \
    echo "# MAINTENANCE" >> .env && \
    echo "APP_MAINTENANCE_DRIVER=file" >> .env && \
    echo "" >> .env && \
    echo "# SECURITY" >> .env && \
    echo "BCRYPT_ROUNDS=12" >> .env && \
    echo "" >> .env && \
    echo "# DATABASE - RENDER POSTGRESQL" >> .env && \
    echo "DB_CONNECTION=pgsql" >> .env && \
    echo "DB_HOST=dpg-d63akashg0os73cbmdf0-a" >> .env && \
    echo "DB_PORT=5432" >> .env && \
    echo "DB_DATABASE=hedma4students_db" >> .env && \
    echo "DB_USERNAME=hedma4students_db_user" >> .env && \
    echo "DB_PASSWORD=REPLACE_WITH_CORRECT_RENDER_PASSWORD" >> .env && \
    echo "" >> .env && \
    echo "# CACHE" >> .env && \
    echo "CACHE_DRIVER=file" >> .env && \
    echo "" >> .env && \
    echo "# QUEUE" >> .env && \
    echo "QUEUE_CONNECTION=sync" >> .env && \
    echo "" >> .env && \
    echo "# SESSION" >> .env && \
    echo "SESSION_DRIVER=file" >> .env && \
    echo "SESSION_LIFETIME=120" >> .env && \
    echo "SESSION_ENCRYPT=false" >> .env && \
    echo "SESSION_PATH=/" >> .env && \
    echo "SESSION_DOMAIN=null" >> .env && \
    echo "" >> .env && \
    echo "# FRONTEND URL" >> .env && \
    echo "FRONTEND_URL=https://khedma4students-frontend.vercel.app" >> .env && \
    echo "" >> .env && \
    echo "# EMAIL CONFIGURATION - YOUR REAL GMAIL" >> .env && \
    echo "MAIL_MAILER=smtp" >> .env && \
    echo "MAIL_HOST=smtp.gmail.com" >> .env && \
    echo "MAIL_PORT=587" >> .env && \
    echo "MAIL_USERNAME=khedma4students@gmail.com" >> .env && \
    echo "MAIL_PASSWORD=vwgguxviwzyhcqck" >> .env && \
    echo "MAIL_ENCRYPTION=tls" >> .env && \
    echo "MAIL_FROM_ADDRESS=\"khedma4students@gmail.com\"" >> .env && \
    echo "MAIL_FROM_NAME=\"Khedma4Students\"" >> .env && \
    echo "" >> .env && \
    echo "# LOGGING" >> .env && \
    echo "LOG_CHANNEL=stack" >> .env && \
    echo "LOG_STACK=single" >> .env && \
    echo "LOG_DEPRECATIONS_CHANNEL=null" >> .env && \
    echo "LOG_LEVEL=error" >> .env && \
    echo "" >> .env && \
    echo "# FILESYSTEM" >> .env && \
    echo "FILESYSTEM_DISK=local" >> .env && \
    echo "" >> .env && \
    echo "# BROADCAST" >> .env && \
    echo "BROADCAST_CONNECTION=log" >> .env && \
    echo "" >> .env && \
    echo "# REDIS" >> .env && \
    echo "REDIS_CLIENT=phpredis" >> .env && \
    echo "REDIS_HOST=127.0.0.1" >> .env && \
    echo "REDIS_PASSWORD=null" >> .env && \
    echo "REDIS_PORT=6379" >> .env && \
    echo "" >> .env && \
    echo "# MEMCACHED" >> .env && \
    echo "MEMCACHED_HOST=127.0.0.1" >> .env && \
    echo "" >> .env && \
    echo "# AWS" >> .env && \
    echo "AWS_ACCESS_KEY_ID=" >> .env && \
    echo "AWS_SECRET_ACCESS_KEY=" >> .env && \
    echo "AWS_DEFAULT_REGION=us-east-1" >> .env && \
    echo "AWS_BUCKET=" >> .env && \
    echo "AWS_USE_PATH_STYLE_ENDPOINT=false" >> .env && \
    echo "" >> .env && \
    echo "# VITE" >> .env && \
    echo "VITE_APP_NAME=\"Khedma4Students\"" >> .env

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
