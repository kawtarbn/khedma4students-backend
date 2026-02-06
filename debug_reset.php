<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== DEBUG PASSWORD RESET ===\n\n";

use App\Http\Controllers\StudentPasswordResetController;
use Illuminate\Http\Request;

// Test the complete flow
$controller = new StudentPasswordResetController();

echo "1. Testing Password Reset Request:\n";

// Simulate a reset request
$request = new Request([
    'email' => 'teststudent@example.com',
    'token' => 'myd8CPmD8mgTuc4VnOl2bbbpk4n0wHv2gqk9wAHf5DqbsUUG7bc61ZUQQGh1',
    'password' => 'newpassword123',
    'password_confirmation' => 'newpassword123'
]);

try {
    $response = $controller->resetPassword($request);
    $data = $response->getData();
    
    echo "   ✅ Response: " . $data->message . "\n";
    
} catch (\Exception $e) {
    echo "   ❌ Error: " . $e->getMessage() . "\n";
}

echo "\n2. Checking Database:\n";

// Check if token exists in database
use Illuminate\Support\Facades\DB;

$resetRecord = DB::table('password_resets')
    ->where('email', 'teststudent@example.com')
    ->where('token', 'myd8CPmD8mgTuc4VnOl2bbbpk4n0wHv2gqk9wAHf5DqbsUUG7bc61ZUQQGh1')
    ->first();

if ($resetRecord) {
    echo "   ✅ Token found in database\n";
    echo "   📅 Created: " . $resetRecord->created_at . "\n";
    
    // Check if token is still valid (60 minutes)
    $createdAt = \Carbon\Carbon::parse($resetRecord->created_at);
    $expiresAt = $createdAt->addMinutes(60);
    $now = \Carbon\Carbon::now();
    
    if ($now->lt($expiresAt)) {
        echo "   ✅ Token is still valid\n";
        echo "   ⏰ Expires in: " . $now->diffInMinutes($expiresAt) . " minutes\n";
    } else {
        echo "   ❌ Token has expired\n";
        echo "   ⏰ Expired: " . $expiresAt . "\n";
    }
} else {
    echo "   ❌ Token not found in database\n";
    echo "   💡 Make sure you're using the correct token\n";
}

echo "\n3. Frontend Debugging:\n";
echo "   📱 Check browser console for errors\n";
echo "   🔗 Verify URL contains correct email and token\n";
echo "   📧 Check email for the exact reset link\n";
echo "   🔄 Try refreshing the reset page\n";

echo "\n4. Quick Fix Solution:\n";
echo "   If token is valid but reset fails, try this:\n";
echo "   1. Clear browser cache\n";
echo "   2. Copy token from email manually\n";
echo "   3. Enter email, token, and new password\n";
echo "   4. Click reset button\n";

echo "\n=== COMMON ISSUES ===\n";
echo "❌ Token expired (60-minute limit)\n";
echo "❌ Wrong token copied\n";
echo "❌ Email doesn't match\n";
echo "❌ Password too short (min 8 chars)\n";
echo "❌ Passwords don't match\n";

echo "\n=== SOLUTION ===\n";
echo "✅ Generate fresh token and try again\n";
echo "✅ Use copy-paste for token (no typing)\n";
echo "✅ Ensure email matches exactly\n";
echo "✅ Use strong password (8+ chars)\n";
?>
