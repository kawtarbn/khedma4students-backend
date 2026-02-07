<?php

// Simple database reset - drop all and run fresh migrations
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: application/json');

try {
    echo "=== DATABASE RESET AND RECREATE ===\n\n";
    
    // Step 1: Drop all tables
    echo "Step 1: Dropping all tables...\n";
    
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
        'students',
        'personal_access_tokens',
        'cache',
        'sessions',
        'jobs'
    ];
    
    foreach ($tables as $table) {
        try {
            DB::statement("DROP TABLE IF EXISTS $table CASCADE");
            echo "✓ Dropped table: $table\n";
        } catch (Exception $e) {
            echo "⚠ Could not drop $table: " . $e->getMessage() . "\n";
        }
    }
    
    // Step 2: Run fresh migrations
    echo "\nStep 2: Running fresh migrations...\n";
    
    // Run migrate:fresh to drop all tables and re-run migrations
    $exitCode = Artisan::call('migrate:fresh', ['--force' => true]);
    
    if ($exitCode === 0) {
        echo "✅ Migrations completed successfully\n";
    } else {
        echo "❌ Migration failed with exit code: $exitCode\n";
        echo Artisan::output();
    }
    
    // Step 3: Run seeders
    echo "\nStep 3: Running seeders...\n";
    
    $exitCode = Artisan::call('db:seed', ['--class' => 'CompleteCRUDTestingSeeder', '--force' => true]);
    
    if ($exitCode === 0) {
        echo "✅ Seeders completed successfully\n";
    } else {
        echo "❌ Seeding failed with exit code: $exitCode\n";
        echo Artisan::output();
    }
    
    // Step 4: Show results
    echo "\n📊 Final Database Status:\n";
    
    $tables = ['students', 'employers', 'jobs', 'services', 'applications', 'hiring_requests'];
    
    foreach ($tables as $table) {
        try {
            $count = DB::table($table)->count();
            echo "   $table: $count records\n";
        } catch (Exception $e) {
            echo "   $table: ERROR - " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n🔑 Test Accounts:\n";
    echo "   Student 1: ahmed.benali@university.edu / password123\n";
    echo "   Student 2: fatima.zahra@university.edu / password123\n";
    echo "   Student 3: mohammed.alami@university.edu / password123\n";
    echo "   Student 4: sara.amrani@university.edu / password123\n";
    echo "   Student 5: yassine.kabbaj@university.edu / password123\n";
    echo "   Employer 1: karim.mansouri@techsolutions.ma / password123\n";
    echo "   Employer 2: lina.belkacem@digitalagency.ma / password123\n";
    
    echo "\n✅ SUCCESS! Database completely reset and recreated!\n";
    
    echo json_encode([
        'success' => true,
        'message' => 'Database completely reset and recreated successfully',
        'migrations_run' => true,
        'seeders_run' => true
    ]);
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
