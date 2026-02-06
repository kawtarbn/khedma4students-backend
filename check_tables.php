<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== TABLE STRUCTURES ===\n\n";

// Check applications table
echo "APPLICATIONS TABLE:\n";
$columns = Schema::getColumnListing('applications');
foreach ($columns as $column) {
    echo "- $column\n";
}

echo "\nJOBS TABLE:\n";
$columns = Schema::getColumnListing('jobs');
foreach ($columns as $column) {
    echo "- $column\n";
}

echo "\nSERVICES TABLE:\n";
$columns = Schema::getColumnListing('services');
foreach ($columns as $column) {
    echo "- $column\n";
}

echo "\nHIRING_REQUESTS TABLE:\n";
$columns = Schema::getColumnListing('hiring_requests');
foreach ($columns as $column) {
    echo "- $column\n";
}

echo "\n=== DONE ===\n";
?>
