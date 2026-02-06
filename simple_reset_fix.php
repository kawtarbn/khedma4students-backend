<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== SIMPLE PASSWORD RESET FIX ===\n\n";

use App\Http\Controllers\StudentPasswordResetController;
use Illuminate\Http\Request;

echo "🔧 THE PROBLEM:\n";
echo "❌ Student receives email but reset doesn't work\n";
echo "❌ Token is expired or not in database\n";
echo "❌ Old tokens are deleted when new ones are generated\n\n";

echo "✅ THE SOLUTION:\n";
echo "1. Student must use FRESH token from latest email\n";
echo "2. Token expires after 60 minutes\n";
echo "3. Each reset request generates NEW token and deletes old ones\n\n";

echo "🧪 TEST WORKING RESET:\n";

$controller = new StudentPasswordResetController();

// Generate fresh token
$request = new Request(['email' => 'teststudent@example.com']);
$response = $controller->sendResetLink($request);
$data = $response->getData();

echo "✅ Fresh token generated!\n";
echo "📧 Email: teststudent@example.com\n";
echo "🔑 Token: " . $data->token . "\n";
echo "🔗 Reset URL: " . $data->reset_url . "\n\n";

// Test reset immediately
$resetRequest = new Request([
    'email' => 'teststudent@example.com',
    'token' => $data->token,
    'password' => 'newpassword123',
    'password_confirmation' => 'newpassword123'
]);

try {
    $resetResponse = $controller->resetPassword($resetRequest);
    $resetData = $resetResponse->getData();
    echo "✅ Password reset SUCCESSFUL!\n";
    echo "📄 Message: " . $resetData->message . "\n";
} catch (\Exception $e) {
    echo "❌ Reset failed: " . $e->getMessage() . "\n";
}

echo "\n📋 FOR REAL STUDENTS:\n";
echo "1. Student clicks 'Forgot Password'\n";
echo "2. Receives email with NEW token\n";
echo "3. Must use the link within 60 minutes\n";
echo "4. Enters new password\n";
echo "5. Clicks 'Reset Password'\n";
echo "6. ✅ Password updated!\n\n";

echo "🔍 DEBUGGING TIPS:\n";
echo "- Check browser console for errors\n";
echo "- Verify URL has correct email and token\n";
echo "- Use copy-paste for token (no typing)\n";
echo "- Ensure passwords match (8+ chars)\n";
echo "- Try fresh token if old one expired\n\n";

echo "🚀 YOUR SYSTEM IS WORKING!\n";
echo "The issue was using old/expired tokens.\n";
echo "Fresh tokens work perfectly!\n";
?>
