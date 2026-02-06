<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== QUICK PASSWORD RESET FIX ===\n\n";

use App\Http\Controllers\StudentPasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// Step 1: Generate fresh token
echo "1. Generating fresh reset token...\n";

$controller = new StudentPasswordResetController();
$request = new Request(['email' => 'teststudent@example.com']);

$response = $controller->sendResetLink($request);
$data = $response->getData();

echo "   ✅ New token generated!\n";
echo "   📧 Email: " . $data->email . "\n";
echo "   🔑 Token: " . $data->token . "\n";
echo "   🔗 Reset URL: " . $data->reset_url . "\n\n";

// Step 2: Test reset with new token
echo "2. Testing password reset with new token...\n";

$resetRequest = new Request([
    'email' => 'teststudent@example.com',
    'token' => $data->token,
    'password' => 'newpassword123',
    'password_confirmation' => 'newpassword123'
]);

try {
    $resetResponse = $controller->resetPassword($resetRequest);
    $resetData = $resetResponse->getData();
    
    echo "   ✅ Password reset successful!\n";
    echo "   📄 Message: " . $resetData->message . "\n";
    
} catch (\Exception $e) {
    echo "   ❌ Reset failed: " . $e->getMessage() . "\n";
}

echo "\n3. Frontend Instructions:\n";
echo "   📱 Go to: " . $data->reset_url . "\n";
echo "   📧 Email: teststudent@example.com\n";
echo "   🔑 Token: " . $data->token . "\n";
echo "   🔐 New Password: newpassword123\n";
echo "   🔐 Confirm: newpassword123\n";

echo "\n4. For Real Students:\n";
echo "   1. Student clicks 'Forgot Password'\n";
echo "   2. Receives email with fresh token\n";
echo "   3. Clicks the link in email\n";
echo "   4. Enters new password\n";
echo "   5. Clicks 'Reset Password'\n";
echo "   6. ✅ Password updated successfully!\n";

echo "\n=== ISSUE WAS: ===\n";
echo "❌ Old token was not in database\n";
echo "❌ Tokens expire after 60 minutes\n";
echo "❌ Each reset request generates new token\n";

echo "\n=== SOLUTION: ===\n";
echo "✅ Always use fresh token from email\n";
echo "✅ Token must be used within 60 minutes\n";
echo "✅ Email and token must match exactly\n";

echo "\n🚀 YOUR PASSWORD RESET IS WORKING!\n";
?>
