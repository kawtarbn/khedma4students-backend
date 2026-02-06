<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== SIMPLE VERIFICATION CODE TEST ===\n\n";

use App\Http\Controllers\StudentPasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

echo "🔍 Let's generate a fresh code and test it immediately:\n\n";

$controller = new StudentPasswordResetController();

// Step 1: Generate fresh code
$request = new Request(['email' => 'kawtarbenabdelmoumene@gmail.com']);
$response = $controller->sendResetLink($request);

// Step 2: Get the code from database
$record = DB::table('password_resets')
    ->where('email', 'kawtarbenabdelmoumene@gmail.com')
    ->orderBy('created_at', 'desc')
    ->first();

if ($record) {
    echo "✅ FRESH VERIFICATION CODE GENERATED!\n\n";
    echo "📧 Email: " . $record->email . "\n";
    echo "🔢 Code: " . $record->verification_code . "\n";
    echo "📅 Created: " . $record->created_at . "\n";
    echo "⏰ Expires: " . $record->code_expires_at . "\n\n";
    
    echo "📱 TEST IMMEDIATELY:\n";
    echo "1. Go to: http://localhost:3000/reset-password\n";
    echo "2. Enter email: kawtarbenabdelmoumene@gmail.com\n";
    echo "3. Enter code: " . $record->verification_code . "\n";
    echo "4. Enter new password (min 8 chars)\n";
    echo "5. Confirm new password\n";
    echo "6. Click 'Reset Password'\n\n";
    
    echo "🎯 This code is FRESH and should work!\n";
    echo "⏰ You have 30 minutes to use it\n\n";
    
    // Step 3: Test the verification logic
    echo "🔧 TESTING VERIFICATION LOGIC:\n";
    $testRecord = DB::table('password_resets')
        ->where('email', 'kawtarbenabdelmoumene@gmail.com')
        ->where('verification_code', $record->verification_code)
        ->where('code_expires_at', '>', now())
        ->first();
    
    if ($testRecord) {
        echo "✅ Backend verification logic says: VALID!\n";
        echo "🚀 If it still fails, the issue is in the frontend\n";
    } else {
        echo "❌ Backend verification logic says: INVALID\n";
        echo "🔍 This should not happen with a fresh code\n";
    }
} else {
    echo "❌ No verification code found in database\n";
}

echo "\n🔧 TROUBLESHOOTING:\n";
echo "If still failing:\n";
echo "1. Refresh the reset page before entering code\n";
echo "2. Type code manually (don't copy-paste)\n";
echo "3. Ensure exactly 6 digits, no spaces\n";
echo "4. Check browser console for errors\n";
echo "5. Make sure frontend is running on port 3000\n";
?>
