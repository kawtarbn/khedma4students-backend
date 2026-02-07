<?php

// Direct database connection test with hardcoded values
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== DIRECT DATABASE TEST ===\n";

try {
    // Temporarily override config with hardcoded values
    config(['database.default' => 'pgsql']);
    config(['database.connections.pgsql.host' => 'dpg-d63akashg0os73cbmdf0-a.oregon-postgres.render.com']);
    config(['database.connections.pgsql.port' => '5432']);
    config(['database.connections.pgsql.database' => 'hedma4students_db']);
    config(['database.connections.pgsql.username' => 'hedma4students_db_user']);
    config(['database.connections.pgsql.password' => '1x2f71cA90zNhGmUy6owNMud3u4Wtqhf']);
    config(['database.connections.pgsql.sslmode' => 'require']);
    
    // Test database connection
    $pdo = DB::connection()->getPdo();
    echo "✅ Database connection: SUCCESS\n";
    
    // Test if reviews table exists
    $tableExists = Schema::hasTable('reviews');
    echo "Reviews table exists: " . ($tableExists ? 'YES' : 'NO') . "\n";
    
    if ($tableExists) {
        // Test simple query
        $count = DB::table('reviews')->count();
        echo "Reviews count: $count\n";
        
        // Test the exact query from ReviewController
        echo "Testing ReviewController query...\n";
        $reviews = DB::table('reviews')->orderBy('created_at', 'desc')->get();
        echo "Query successful: " . $reviews->count() . " reviews found\n";
    } else {
        echo "❌ Reviews table does not exist\n";
    }
    
} catch (\Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}

echo "\n=== TEST COMPLETE ===\n";
?>
