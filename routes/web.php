<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// Debug route (no /api prefix). Helps confirm the backend instance.
Route::get('/ping', function () {
    return response()->json([
        'ok' => true,
        'base_path' => base_path(),
        'student_file' => app_path('Models/Student.php'),
        'student_file_exists' => file_exists(app_path('Models/Student.php')),
        'student_class_autoloads' => class_exists(\App\Models\Student::class),
    ]);
});

// Database connection test
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return response()->json([
            'status' => 'database_connected',
            'connection' => config('database.default'),
            'timestamp' => now()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'database_error',
            'error' => $e->getMessage(),
            'connection' => config('database.default'),
            'timestamp' => now()
        ], 500);
    }
});

// Email preview route for development
Route::get('/preview-emails', function () {
    $logFile = storage_path('logs/laravel.log');
    $content = file_exists($logFile) ? file_get_contents($logFile) : 'No logs found';
    
    // Extract password reset entries
    $lines = explode("\n", $content);
    $emailEntries = [];
    
    foreach ($lines as $line) {
        if (strpos($line, 'Password reset email sent') !== false) {
            $emailEntries[] = $line;
        }
    }
    
    return response()->json([
        'total_entries' => count($emailEntries),
        'recent_entries' => array_slice($emailEntries, -5),
        'log_file' => $logFile,
        'note' => 'This shows recent password reset requests from the logs'
    ]);
});

// Simple email test page
Route::get('/email-test', function () {
    return view('emails.simple-password-reset', [
        'user' => (object) [
            'full_name' => 'Test User',
            'email' => 'test@example.com'
        ],
        'token' => 'test-token-12345',
        'resetUrl' => 'http://localhost:3000/reset-password?token=test-token-12345&email=test@example.com',
        'userType' => 'student'
    ]);
});