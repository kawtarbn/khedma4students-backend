<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

try {
    echo "=== CHECKING RENDER DATABASE CONNECTION ===\n\n";
    
    // Test connection
    $pdo = DB::connection()->getPdo();
    echo "✅ Database connected!\n";
    echo "Database: " . DB::connection()->getDatabaseName() . "\n";
    echo "Connection: " . DB::connection()->getConfig('driver') . "\n\n";
    
    // Check if tables exist
    $tables = DB::select('SHOW TABLES');
    
    if (empty($tables)) {
        echo "❌ NO TABLES FOUND - Need to run migrations on Render!\n";
        echo "\n=== SOLUTION ===\n";
        echo "1. Your Render database is empty\n";
        echo "2. The startup script should run migrations automatically\n";
        echo "3. Check your Render deployment logs\n";
        echo "4. Make sure the startup script is working\n";
    } else {
        echo "✅ Tables found:\n";
        foreach ($tables as $table) {
            $tableName = array_values((array)$table)[0];
            $count = DB::select("SELECT COUNT(*) as count FROM `$tableName`");
            echo "  - $tableName: {$count[0]->count} rows\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Database Error: " . $e->getMessage() . "\n";
}
