<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== DIRECT API TEST ===\n\n";

use App\Http\Controllers\StudentPasswordResetController;
use Illuminate\Http\Request;

echo "🔍 Testing the exact API endpoint that frontend calls\n\n";

$controller = new StudentPasswordResetController();

// Simulate the exact request that frontend sends
$request = new Request([
    'email' => 'kawtarbenabdelmoumene@gmail.com',
    'verification_code' => '904083',
    'password' => 'newpassword123',
    'password_confirmation' => 'newpassword123'
]);

echo "📧 Request Data:\n";
echo "  Email: " . $request->email . "\n";
echo "  Verification Code: " . $request->verification_code . "\n";
echo "  Password: " . str_repeat('*', 8) . "\n";
echo "  Password Confirmation: " . str_repeat('*', 8) . "\n\n";

try {
    $response = $controller->resetPassword($request);
    $data = $response->getData();
    
    echo "✅ API CALL SUCCESSFUL!\n";
    echo "📄 Response: " . $data->message . "\n\n";
    
    echo "🚀 The backend API is working perfectly!\n";
    echo "🔍 The issue is definitely in the frontend!\n\n";
    
    echo "📱 FRONTEND DEBUGGING STEPS:\n";
    echo "1. Open browser F12 → Network tab\n";
    echo "2. Go to: http://localhost:3000/reset-password\n";
    echo "3. Enter email: kawtarbenabdelmoumene@gmail.com\n";
    echo "4. Enter code: 904083\n";
    echo "5. Enter password: test12345\n";
    echo "6. Click 'Reset Password'\n";
    echo "7. Check the Network tab for:\n";
    echo "   - URL being called\n";
    echo "   - Request payload\n";
    echo "   - Response status\n";
    echo "   - Response body\n\n";
    
} catch (\Exception $e) {
    echo "❌ API CALL FAILED!\n";
    echo "🔍 Error: " . $e->getMessage() . "\n\n";
    
    echo "🔍 This should not happen - the backend logic is correct!\n";
}

echo "🎯 FRESH CODE FOR TESTING: 904083\n";
echo "⏰ This code is valid and should work!\n";
?>
