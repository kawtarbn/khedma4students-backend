<?php

// Complete database reset script
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: application/json');

try {
    echo "=== COMPLETE DATABASE RESET ===\n\n";
    
    // Get all table names
    $tables = [
        'applications',
        'hiring_requests', 
        'services',
        'jobs',
        'notifications',
        'contact_messages',
        'reviews',
        'success_stories',
        'password_resets',
        'students',
        'employers'
    ];
    
    echo "Clearing all tables...\n";
    
    // Disable foreign key checks
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    
    foreach ($tables as $table) {
        try {
            $count = DB::table($table)->count();
            DB::table($table)->truncate();
            echo "✓ Cleared $table (removed $count records)\n";
        } catch (Exception $e) {
            echo "⚠ Could not clear $table: " . $e->getMessage() . "\n";
        }
    }
    
    // Re-enable foreign key checks
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    
    echo "\n✅ Database completely reset!\n";
    
    // Verify all tables are empty
    echo "\nVerifying empty tables:\n";
    foreach ($tables as $table) {
        try {
            $count = DB::table($table)->count();
            echo "$table: $count records\n";
        } catch (Exception $e) {
            echo "$table: ERROR - " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n🎯 Database is now empty and ready for fresh data!\n";
    
    echo json_encode([
        'success' => true,
        'message' => 'Database completely reset',
        'tables_cleared' => $tables,
        'status' => 'empty_and_ready'
    ]);
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
