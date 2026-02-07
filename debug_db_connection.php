<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

echo "=== DATABASE CONNECTION DEBUG ===\n\n";

echo "Current Database Configuration:\n";
echo "Driver: " . DB::connection()->getConfig('driver') . "\n";
echo "Host: " . DB::connection()->getConfig('host') . "\n";
echo "Port: " . DB::connection()->getConfig('port') . "\n";
echo "Database: " . DB::connection()->getConfig('database') . "\n";
echo "Username: " . DB::connection()->getConfig('username') . "\n";

echo "\nEnvironment Variables:\n";
echo "DB_CONNECTION: " . env('DB_CONNECTION') . "\n";
echo "DB_HOST: " . env('DB_HOST') . "\n";
echo "DB_PORT: " . env('DB_PORT') . "\n";
echo "DB_DATABASE: " . env('DB_DATABASE') . "\n";
echo "DB_USERNAME: " . env('DB_USERNAME') . "\n";

echo "\nTesting connection...\n";
try {
    $pdo = DB::connection()->getPdo();
    echo "✅ Connection successful!\n";
} catch (Exception $e) {
    echo "❌ Connection failed: " . $e->getMessage() . "\n";
}

echo "\n.env file contents:\n";
if (file_exists('.env')) {
    echo file_get_contents('.env');
} else {
    echo "❌ .env file not found!\n";
}
