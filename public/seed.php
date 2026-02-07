<?php

// Simple health check and database seeding endpoint
header('Content-Type: application/json');

try {
    require_once __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    // Check if this is a seeding request
    if (isset($_GET['action']) && $_GET['action'] === 'seed') {
        // Include the seeding logic
        include __DIR__ . '/simple_seed.php';
        exit;
    }
    
    // Health check response
    echo json_encode([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
        'database' => [
            'driver' => DB::connection()->getConfig('driver'),
            'host' => DB::connection()->getConfig('host'),
            'database' => DB::connection()->getConfig('database')
        ],
        'tables' => [
            'students' => DB::table('students')->count(),
            'employers' => DB::table('employers')->count(),
            'jobs' => DB::table('jobs')->count(),
            'services' => DB::table('services')->count()
        ]
    ]);
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'database_config' => [
            'DB_CONNECTION' => env('DB_CONNECTION'),
            'DB_HOST' => env('DB_HOST'),
            'DB_DATABASE' => env('DB_DATABASE')
        ]
    ]);
}
