<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// Root route test
Route::get('/', function () {
    return response()->json([
        'message' => 'Backend is running!',
        'status' => 'success',
        'timestamp' => now(),
        'routes_loaded' => true
    ]);
});

// Most basic test route
Route::get('/basic', function () {
    return 'Backend is working!';
});

// Simple JSON test route (no database)
Route::get('/simple-test', function () {
    return response()->json([
        'status' => 'working',
        'message' => 'Backend is running without database',
        'timestamp' => now(),
        'version' => '1.0.0'
    ]);
});

// Debug route (no /api prefix). Helps confirm the backend instance.
Route::get('/ping', function () {
    return response()->json([
        'ok' => true,
        'base_path' => base_path(),
        'student_file' => app_path('Models/Student.php'),
        'student_file_exists' => file_exists(app_path('Models/Student.php')),
        'student_class_autoloads' => class_exists(\App\Models\Student::class),
        'env' => app()->environment(),
        'db_connection' => config('database.default'),
        'db_host' => config('database.connections.pgsql.host'),
    ]);
});

// Manual migration route
Route::get('/run-migrations', function () {
    try {
        \Artisan::call('migrate', ['--force' => true]);
        return response()->json([
            'success' => true,
            'message' => 'Migrations completed successfully',
            'output' => \Artisan::output()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Migration failed',
            'error' => $e->getMessage()
        ], 500);
    }
});

// Manual seeder route
Route::get('/run-seeders', function () {
    try {
        // Set timeout to prevent hanging
        set_time_limit(30);
        
        \Artisan::call('db:seed', ['--force' => true]);
        return response()->json([
            'success' => true,
            'message' => 'Seeders completed successfully',
            'output' => \Artisan::output()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Seeders failed',
            'error' => $e->getMessage()
        ], 500);
    }
});

// Simple seeder route (basic data only)
Route::get('/run-simple-seeders', function () {
    try {
        set_time_limit(10);
        
        // Create basic test student
        \DB::table('students')->insert([
            'full_name' => 'Test Student',
            'email' => 'test@example.com',
            'password' => \Hash::make('password123'),
            'university' => 'Test University',
            'city' => 'Test City',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Create basic test employer
        \DB::table('employers')->insert([
            'full_name' => 'Test Company',
            'email' => 'company@example.com',
            'password' => \Hash::make('password123'),
            'company' => 'Test Company Inc',
            'city' => 'Test City',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Simple seeders completed successfully',
            'data' => 'Created 1 student and 1 employer'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Simple seeders failed',
            'error' => $e->getMessage()
        ], 500);
    }
});

// Simple working registration for everyone
Route::post('/quick-register', function (\Illuminate\Http\Request $request) {
    try {
        // Create student immediately without complex validation
        $student = \DB::table('students')->insert([
            'full_name' => $request->full_name ?? 'Test User',
            'email' => $request->email ?? 'test' . time() . '@example.com',
            'password' => \Hash::make($request->password ?? 'password123'),
            'university' => $request->university ?? 'Test University',
            'city' => $request->city ?? 'Test City',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Account created successfully! You can now login.',
            'email' => $request->email ?? 'test' . time() . '@example.com',
            'password' => $request->password ?? 'password123'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Registration failed: ' . $e->getMessage()
        ], 500);
    }
});

// Simple working employer registration for everyone
Route::post('/quick-register-employer', function (\Illuminate\Http\Request $request) {
    try {
        // Create employer immediately without complex validation
        $employer = \DB::table('employers')->insert([
            'full_name' => $request->full_name ?? 'Test Company',
            'email' => $request->email ?? 'company' . time() . '@example.com',
            'password' => \Hash::make($request->password ?? 'password123'),
            'company' => $request->company ?? 'Test Company Inc',
            'city' => $request->city ?? 'Test City',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Employer account created successfully! You can now login.',
            'email' => $request->email ?? 'company' . time() . '@example.com',
            'password' => $request->password ?? 'password123'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Employer registration failed: ' . $e->getMessage()
        ], 500);
    }
});
Route::get('/error-log', function () {
    $logFile = storage_path('logs/laravel.log');
    if (file_exists($logFile)) {
        $content = file_get_contents($logFile);
        $lines = explode("\n", $content);
        $recentErrors = array_slice($lines, -20); // Last 20 lines
        return response()->json([
            'log_file' => $logFile,
            'recent_errors' => $recentErrors,
            'total_lines' => count($lines)
        ]);
    }
    return response()->json(['message' => 'No log file found']);
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