<?php

use Illuminate\Support\Facades\Route;

// Simple debug route that doesn't require database
Route::get('/debug-simple', function () {
    return response()->json([
        'status' => 'working',
        'message' => 'Simple debug endpoint',
        'timestamp' => now(),
        'environment' => app()->environment(),
        'laravel_version' => app()->version(),
        'php_version' => PHP_VERSION,
    ]);
});

// Database connection test without complex queries
Route::get('/debug-db', function () {
    try {
        $connection = config('database.default');
        $host = config("database.connections.{$connection}.host");
        $database = config("database.connections.{$connection}.database");
        
        return response()->json([
            'status' => 'config_loaded',
            'connection' => $connection,
            'host' => $host,
            'database' => $database,
            'timestamp' => now()
        ]);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'config_error',
            'error' => $e->getMessage(),
            'timestamp' => now()
        ]);
    }
});
