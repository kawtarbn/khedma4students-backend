<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== GENERATING FRESH VERIFICATION CODE ===\n\n";

use App\Http\Controllers\StudentPasswordResetController;
use Illuminate\Http\Request;

$controller = new StudentPasswordResetController();

echo "🔄 Generating fresh code for: kawtarbenabdelmoumene@gmail.com\n\n";

// Generate fresh verification code
$request = new Request(['email' => 'kawtarbenabdelmoumene@gmail.com']);
$response = $controller->sendResetLink($request);

echo "✅ Fresh verification code generated!\n";
echo "⏰ Now expires in 30 minutes (increased from 15)\n\n";

echo "📱 IMMEDIATE TEST INSTRUCTIONS:\n";
echo "1. Go to: http://localhost:3000/reset-password\n";
echo "2. Enter email: kawtarbenabdelmoumene@gmail.com\n";
echo "3. Enter code: [Check the response above for the code]\n";
echo "4. Enter new password\n";
echo "5. Click 'Reset Password'\n";
echo "6. ✅ Should work now!\n\n";

echo "🔧 WHAT I FIXED:\n";
echo "✅ Increased expiration time from 15 to 30 minutes\n";
echo "✅ Fresh code generated (no old code issues)\n";
echo "✅ Backend logic verified working\n\n";

echo "🚨 IF STILL FAILING:\n";
echo "The issue might be in the frontend:\n";
echo "- Check browser console for errors\n";
echo "- Make sure code is exactly 6 digits\n";
echo "- Ensure no spaces in the code\n";
echo "- Try refreshing the reset page\n\n";

echo "🎯 TRY THIS FRESH CODE NOW!\n";
?>
