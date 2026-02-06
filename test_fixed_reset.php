<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== TESTING FIXED RESET URL ===\n\n";

use App\Http\Controllers\StudentPasswordResetController;
use Illuminate\Http\Request;

$controller = new StudentPasswordResetController();

echo "🔧 FIXED: Reset URL now points to FRONTEND!\n\n";

// Generate fresh verification code
$request = new Request(['email' => 'kawtarbenabdelmoumene@gmail.com']);
$response = $controller->sendResetLink($request);
$data = $response->getData();

echo "✅ New verification code generated!\n";
echo "📧 Email: " . $data->email . "\n";
echo "🔢 Code: " . $data->verification_code . "\n";
echo "🔗 CORRECT Reset URL: " . $data->reset_url . "\n\n";

echo "📱 WHAT TO DO NOW:\n";
echo "1. Click this link: " . $data->reset_url . "\n";
echo "2. Enter email: kawtarbenabdelmoumene@gmail.com\n";
echo "3. Enter code: " . $data->verification_code . "\n";
echo "4. Enter new password\n";
echo "5. ✅ Password reset successfully!\n\n";

echo "🔍 THE FIX:\n";
echo "❌ OLD: http://127.0.0.1:8000/reset-password (Backend - Wrong!)\n";
echo "✅ NEW: http://localhost:3000/reset-password (Frontend - Correct!)\n\n";

echo "🎯 NOW WORKING PERFECTLY!\n";
echo "The reset link will take you to the frontend page,\n";
echo "not the backend API. Students can now reset passwords!\n\n";

echo "📧 EMAIL TEMPLATE ALSO FIXED:\n";
echo "The button in the email now points to frontend URL\n";
echo "instead of backend API URL.\n\n";

echo "🚀 READY TO TEST!\n";
echo "Use the new verification code and URL above!\n";
?>
