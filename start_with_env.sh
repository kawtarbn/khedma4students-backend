#!/bin/bash

echo "Starting Khedma4Students backend..."

# Create .env file with environment variables from Render
echo "Creating .env file with environment variables..."
cat > .env << EOF
APP_NAME=Khedma4Students
APP_ENV=production
APP_KEY=${APP_KEY:-}
APP_DEBUG=false
APP_URL=${APP_URL:-https://khedma4students-backend.onrender.com}
DB_CONNECTION=${DB_CONNECTION:-pgsql}
DB_HOST=${DB_HOST:-dpg-d63akashg0os73cbmdf0-a.oregon-postgres.render.com}
DB_PORT=${DB_PORT:-5432}
DB_DATABASE=${DB_DATABASE:-hedma4students_db}
DB_USERNAME=${DB_USERNAME:-hedma4students_db_user}
DB_PASSWORD=${DB_PASSWORD:-1x2f71cA90zNhGmUy6owNMud3u4Wtqhf}
DB_SSLMODE=${DB_SSLMODE:-require}
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
MAIL_MAILER=${MAIL_MAILER:-smtp}
MAIL_HOST=${MAIL_HOST:-smtp.gmail.com}
MAIL_PORT=${MAIL_PORT:-587}
MAIL_USERNAME=${MAIL_USERNAME:-khedma4students@gmail.com}
MAIL_PASSWORD=${MAIL_PASSWORD:-vwgguxviwzyhcqck}
MAIL_ENCRYPTION=${MAIL_ENCRYPTION:-tls}
MAIL_FROM_ADDRESS=${MAIL_FROM_ADDRESS:-khedma4students@gmail.com}
MAIL_FROM_NAME=${MAIL_FROM_NAME:-Khedma4Students}
EOF

echo ".env file created with environment variables"
echo "Environment variables loaded:"
echo "  MAIL_MAILER: ${MAIL_MAILER}"
echo "  MAIL_HOST: ${MAIL_HOST}"
echo "  MAIL_USERNAME: ${MAIL_USERNAME}"
echo "  MAIL_FROM_ADDRESS: ${MAIL_FROM_ADDRESS}"

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
