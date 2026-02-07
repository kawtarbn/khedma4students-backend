#!/bin/bash

echo "Starting Khedma4Students backend..."

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

echo "Database setup complete. No automatic seeding to ensure clean state."

echo "Starting Laravel application..."
php artisan serve --host=0.0.0.0 --port=8080
