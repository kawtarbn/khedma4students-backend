<?php

// Check table structure and fix seeding
header('Content-Type: text/plain');

try {
    require_once __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "=== TABLE STRUCTURE CHECK ===\n\n";
    
    // Check employers table structure
    echo "EMPLOYERS TABLE STRUCTURE:\n";
    $employerColumns = DB::select("SELECT column_name, data_type FROM information_schema.columns WHERE table_name = 'employers' ORDER BY ordinal_position");
    foreach ($employerColumns as $column) {
        echo "- {$column->column_name} ({$column->data_type})\n";
    }
    
    echo "\nSTUDENTS TABLE STRUCTURE:\n";
    $studentColumns = DB::select("SELECT column_name, data_type FROM information_schema.columns WHERE table_name = 'students' ORDER BY ordinal_position");
    foreach ($studentColumns as $column) {
        echo "- {$column->column_name} ({$column->data_type})\n";
    }
    
    echo "\nJOBS TABLE STRUCTURE:\n";
    $jobColumns = DB::select("SELECT column_name, data_type FROM information_schema.columns WHERE table_name = 'jobs' ORDER BY ordinal_position");
    foreach ($jobColumns as $column) {
        echo "- {$column->column_name} ({$column->data_type})\n";
    }
    
    echo "\nSERVICES TABLE STRUCTURE:\n";
    $serviceColumns = DB::select("SELECT column_name, data_type FROM information_schema.columns WHERE table_name = 'services' ORDER BY ordinal_position");
    foreach ($serviceColumns as $column) {
        echo "- {$column->column_name} ({$column->data_type})\n";
    }
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
}
