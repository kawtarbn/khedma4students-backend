#!/bin/bash

echo "Starting Khedma4Students backend..."

# Check if .env exists, if not create from example or create basic one
if [ ! -f .env ]; then
    if [ -f .env.example ]; then
        echo "Creating .env from .env.example..."
        cp .env.example .env
    else
        echo "Creating basic .env file..."
        echo "APP_ENV=production" > .env
        echo "APP_DEBUG=false" >> .env
        echo "APP_URL=https://khedma4students-backend.onrender.com" >> .env
    fi
fi

# Wait for database to be ready
echo "Waiting for database connection..."
max_attempts=30
attempt=1

while [ $attempt -le $max_attempts ]; do
    if php artisan tinker --execute="try { DB::connection()->getPdo(); echo 'OK'; } catch(Exception \$e) { echo 'FAIL'; }" 2>/dev/null | grep -q "OK"; then
        echo "Database connected successfully!"
        break
    fi
    
    echo "Attempt $attempt/$max_attempts: Database not ready, waiting 5 seconds..."
    sleep 5
    attempt=$((attempt + 1))
done

if [ $attempt -gt $max_attempts ]; then
    echo "ERROR: Could not connect to database after $max_attempts attempts"
    exit 1
fi

echo "Running database migrations..."
php artisan migrate --force

echo "Starting Laravel application..."
php artisan serve --host=0.0.0.0 --port=8080
