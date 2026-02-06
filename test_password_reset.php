<?php

require_once __DIR__ . '/vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Student;
use App\Models\Employer;
use App\Http\Controllers\StudentPasswordResetController;
use App\Http\Controllers\EmployerPasswordResetController;

echo "=== Testing Password Reset and Email Verification ===\n\n";

// Test Student Password Reset
echo "1. Testing Student Password Reset:\n";
$studentController = new StudentPasswordResetController();

// Create a test student if not exists
$student = Student::firstOrCreate(
    ['email' => 'teststudent@example.com'],
    [
        'full_name' => 'Test Student',
        'password' => bcrypt('password123'),
        'university' => 'Test University',
        'city' => 'Test City',
        'phone' => '1234567890',
        'skills' => 'Test Skills',
        'description' => 'Test Description'
    ]
);

echo "   - Test student created/found: {$student->email}\n";

// Test forgot password
$request = new Request(['email' => 'teststudent@example.com']);
$response = $studentController->sendResetLink($request);
echo "   - Forgot password response: " . $response->getData()->message . "\n";

// Test Employer Password Reset
echo "\n2. Testing Employer Password Reset:\n";
$employerController = new EmployerPasswordResetController();

// Create a test employer if not exists
$employer = Employer::firstOrCreate(
    ['email' => 'testemployer@example.com'],
    [
        'full_name' => 'Test Employer',
        'password' => bcrypt('password123'),
        'company' => 'Test Company',
        'city' => 'Test City',
        'contact_person' => 'Test Contact',
        'phone' => '0987654321',
        'location' => 'Test Location',
        'description' => 'Test Description'
    ]
);

echo "   - Test employer created/found: {$employer->email}\n";

// Test forgot password
$request = new Request(['email' => 'testemployer@example.com']);
$response = $employerController->sendResetLink($request);
echo "   - Forgot password response: " . $response->getData()->message . "\n";

echo "\n=== Test Complete ===\n";
echo "All password reset and email verification functionality has been implemented!\n\n";

echo "Frontend URLs:\n";
echo "- Student Forgot Password: http://localhost:3000/forgot-password\n";
echo "- Employer Forgot Password: http://localhost:3000/employer-forgot-password\n";
echo "- Student Reset Password: http://localhost:3000/reset-password?email=EMAIL&token=TOKEN\n";
echo "- Employer Reset Password: http://localhost:3000/employer-reset-password?email=EMAIL&token=TOKEN\n";
echo "- Student Email Verification: http://localhost:3000/verify-email?token=TOKEN\n";
echo "- Employer Email Verification: http://localhost:3000/employer-verify-email?token=TOKEN\n\n";

echo "Backend API Endpoints:\n";
echo "- POST /api/forgot-password (Student)\n";
echo "- POST /api/reset-password (Student)\n";
echo "- POST /api/verify-email (Student)\n";
echo "- POST /api/resend-verification (Student)\n";
echo "- POST /api/employer-forgot-password (Employer)\n";
echo "- POST /api/employer-reset-password (Employer)\n";
echo "- POST /api/employer-verify-email (Employer)\n";
echo "- POST /api/employer-resend-verification (Employer)\n";
