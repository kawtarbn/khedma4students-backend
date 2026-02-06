<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== FULL FLOW DEBUG ===\n\n";

use App\Http\Controllers\StudentPasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

echo "🔍 Step 1: Generate fresh code\n";
$controller = new StudentPasswordResetController();
$request = new Request(['email' => 'kawtarbenabdelmoumene@gmail.com']);
$response = $controller->sendResetLink($request);

// Get the fresh code from database
$record = DB::table('password_resets')
    ->where('email', 'kawtarbenabdelmoumene@gmail.com')
    ->orderBy('created_at', 'desc')
    ->first();

if ($record) {
    echo "✅ Fresh code: " . $record->verification_code . "\n";
    echo "📅 Expires: " . $record->code_expires_at . "\n\n";
    
    echo "🔍 Step 2: Test the exact same logic as resetPassword\n";
    
    // Simulate the exact resetPassword request
    $resetRequest = new Request([
        'email' => 'kawtarbenabdelmoumene@gmail.com',
        'verification_code' => $record->verification_code,
        'password' => 'newpassword123',
        'password_confirmation' => 'newpassword123'
    ]);
    
    echo "📧 Request data:\n";
    echo "  Email: " . $resetRequest->email . "\n";
    echo "  Code: " . $resetRequest->verification_code . "\n";
    echo "  Password: [hidden]\n\n";
    
    // Test the exact database query
    $resetRecord = DB::table('password_resets')
        ->where('email', $resetRequest->email)
        ->where('verification_code', $resetRequest->verification_code)
        ->where('code_expires_at', '>', now())
        ->first();
    
    if ($resetRecord) {
        echo "✅ Database query SUCCESS!\n";
        echo "🔍 Found record with code: " . $resetRecord->verification_code . "\n";
        echo "🔍 Expires at: " . $resetRecord->code_expires_at . "\n";
        echo "🔍 Current time: " . now() . "\n\n";
        
        echo "🚀 The backend logic is WORKING!\n";
        echo "🔍 The issue must be in the FRONTEND!\n\n";
        
        echo "📱 FRONTEND DEBUGGING:\n";
        echo "1. Open browser developer tools (F12)\n";
        echo "2. Go to Network tab\n";
        echo "3. Try to reset password with code: " . $record->verification_code . "\n";
        echo "4. Check what URL is being called\n";
        echo "5. Check the request payload\n";
        echo "6. Check the response from server\n\n";
        
        echo "🔧 COMMON FRONTEND ISSUES:\n";
        echo "- Wrong API URL (calling wrong endpoint)\n";
        echo "- Wrong field names (sending 'code' instead of 'verification_code')\n";
        echo "- CORS issues\n";
        echo "- Network errors\n";
        
    } else {
        echo "❌ Database query FAILED!\n";
        echo "🔍 This should not happen with a fresh code\n";
        
        // Debug why it failed
        $debugRecord = DB::table('password_resets')
            ->where('email', $resetRequest->email)
            ->where('verification_code', $resetRequest->verification_code)
            ->first();
            
        if ($debugRecord) {
            echo "🔍 Record exists but expired check failed\n";
            echo "🔍 Expiration: " . $debugRecord->code_expires_at . "\n";
            echo "🔍 Now: " . now() . "\n";
        } else {
            echo "🔍 Record not found at all!\n";
        }
    }
} else {
    echo "❌ No record found\n";
}

echo "\n🎯 IMMEDIATE TEST:\n";
echo "Use this fresh code in browser: " . ($record->verification_code ?? 'NONE') . "\n";
echo "Check browser Network tab for the actual request being sent!\n";
?>
