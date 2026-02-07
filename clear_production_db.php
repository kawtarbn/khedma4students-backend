<?php

// Clear production database completely
require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== CLEARING PRODUCTION DATABASE ===\n\n";

try {
    // Get all tables and truncate them
    $tables = [
        'password_resets',
        'success_stories', 
        'reviews',
        'contact_messages',
        'notifications',
        'hiring_requests',
        'applications',
        'services',
        'jobs',
        'employers',
        'students'
    ];
    
    foreach ($tables as $table) {
        try {
            DB::table($table)->truncate();
            echo "✓ Truncated table: $table\n";
        } catch (\Exception $e) {
            echo "⚠ Could not truncate $table: " . $e->getMessage() . "\n";
        }
    }
    
    // Reset all sequences
    $sequences = [
        'students_id_seq',
        'employers_id_seq',
        'jobs_id_seq',
        'services_id_seq',
        'applications_id_seq',
        'hiring_requests_id_seq',
        'notifications_id_seq',
        'contact_messages_id_seq',
        'reviews_id_seq',
        'success_stories_id_seq',
        'password_resets_id_seq'
    ];
    
    foreach ($sequences as $sequence) {
        try {
            DB::statement("ALTER SEQUENCE $sequence RESTART WITH 1");
            echo "✓ Reset sequence: $sequence\n";
        } catch (\Exception $e) {
            echo "⚠ Could not reset $sequence: " . $e->getMessage() . "\n";
        }
    }
    
    // Verify all tables are empty
    echo "\n=== VERIFYING TABLES ARE EMPTY ===\n";
    $allEmpty = true;
    
    foreach ($tables as $table) {
        try {
            $count = DB::table($table)->count();
            echo "   $table: $count records\n";
            if ($count > 0) {
                $allEmpty = false;
            }
        } catch (\Exception $e) {
            echo "   $table: ERROR - " . $e->getMessage() . "\n";
            $allEmpty = false;
        }
    }
    
    echo "\n" . ($allEmpty ? "✅ SUCCESS: Production database is completely empty!" : "❌ WARNING: Some tables still have data") . "\n";
    
    echo "\n🎯 Ready for fresh registration!\n";
    echo "🚀 Visit your website and register new users!\n";
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}
?>
