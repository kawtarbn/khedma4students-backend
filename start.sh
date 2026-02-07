#!/bin/bash

echo "Starting Khedma4Students backend..."

# Recreate .env file with environment variables from Render
echo "Recreating .env with Render environment variables..."
cat > .env << EOF
APP_NAME=Khedma4Students
APP_ENV=production
APP_KEY=${APP_KEY:-}
APP_DEBUG=false
APP_URL=${APP_URL:-https://khedma4students-backend.onrender.com}
DB_CONNECTION=${DB_CONNECTION:-pgsql}
DB_HOST=${DB_HOST:-}
DB_PORT=${DB_PORT:-5432}
DB_DATABASE=${DB_DATABASE:-}
DB_USERNAME=${DB_USERNAME:-}
DB_PASSWORD=${DB_PASSWORD:-}
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
EOF

echo ".env file created with environment variables"

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

# Check if database is empty and seed it
STUDENT_COUNT=$(php artisan tinker --execute="echo DB::table('students')->count();" 2>/dev/null | tr -d '\r\n')
echo "Current student count: $STUDENT_COUNT"
if [ "$STUDENT_COUNT" -eq 0 ] 2>/dev/null; then
    echo "Database is empty, seeding sample data..."
    php artisan db:seed --class=DatabaseSeeder --force
else
    echo "Database already has students, skipping student seeding"
    echo "Checking for jobs..."
    JOB_COUNT=$(php artisan tinker --execute="echo DB::table('jobs')->count();" 2>/dev/null | tr -d '\r\n')
    echo "Current job count: $JOB_COUNT"
    if [ "$JOB_COUNT" -eq 0 ] 2>/dev/null; then
        echo "No jobs found, running job seeder only..."
        php artisan db:seed --class=JobSeeder --force
    else
        echo "Database already has jobs, skipping seeding"
    fi
fi

echo "Starting Laravel application..."
php artisan serve --host=0.0.0.0 --port=8080
