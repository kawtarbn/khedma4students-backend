<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

try {
    echo "Testing database connection...\n";
    
    // Test connection
    $pdo = DB::connection()->getPdo();
    echo "✅ Database connected successfully!\n";
    echo "Database: " . DB::connection()->getDatabaseName() . "\n\n";
    
    // Check if migrations table exists
    $migrationsExist = DB::select("SELECT EXISTS (
        SELECT FROM information_schema.tables 
        WHERE table_schema = 'public' 
        AND table_name = 'migrations'
    )");
    
    if ($migrationsExist[0]->exists) {
        echo "✅ Migrations table exists\n";
        
        // Show migration status
        $migrations = DB::select("SELECT migration, batch FROM migrations ORDER BY batch, migration");
        echo "\n=== MIGRATIONS ===\n";
        foreach ($migrations as $migration) {
            echo "- Batch {$migration->batch}: {$migration->migration}\n";
        }
    } else {
        echo "❌ No migrations table found - need to run migrations\n";
    }
    
    // List all tables
    $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' ORDER BY table_name");
    
    echo "\n=== ALL TABLES ===\n";
    if (empty($tables)) {
        echo "No tables found in database\n";
    } else {
        foreach ($tables as $table) {
            echo "- " . $table->table_name . "\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Database Error: " . $e->getMessage() . "\n";
    echo "Error details: " . $e->getTraceAsString() . "\n";
}
