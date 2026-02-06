<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== DEBUGGING VERIFICATION CODE ISSUE ===\n\n";

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

echo "🔍 CHECKING DATABASE FOR RECENT CODES:\n\n";

// Get recent password reset records
$records = DB::table('password_resets')
    ->where('email', 'kawtarbenabdelmoumene@gmail.com')
    ->orderBy('created_at', 'desc')
    ->limit(5)
    ->get();

foreach ($records as $record) {
    echo "📧 Email: " . $record->email . "\n";
    echo "🔢 Code: " . $record->verification_code . "\n";
    echo "📅 Created: " . $record->created_at . "\n";
    echo "⏰ Expires: " . $record->code_expires_at . "\n";
    
    $now = Carbon::now();
    $expiresAt = Carbon::parse($record->code_expires_at);
    
    if ($now->lt($expiresAt)) {
        echo "✅ Status: VALID (expires in " . $now->diffInMinutes($expiresAt) . " minutes)\n";
    } else {
        echo "❌ Status: EXPIRED (expired " . $now->diffInMinutes($expiresAt) . " minutes ago)\n";
    }
    echo "---\n";
}

echo "\n🔧 TESTING VERIFICATION LOGIC:\n";

// Get the most recent record
$latestRecord = $records->first();
if ($latestRecord) {
    $testCode = $latestRecord->verification_code;
    $testEmail = $latestRecord->email;
    
    echo "Testing with code: " . $testCode . "\n";
    echo "Testing with email: " . $testEmail . "\n\n";
    
    // Test the same logic as the controller
    $resetRecord = DB::table('password_resets')
        ->where('email', $testEmail)
        ->where('verification_code', $testCode)
        ->where('code_expires_at', '>', Carbon::now())
        ->first();
    
    if ($resetRecord) {
        echo "✅ Code should be VALID!\n";
        echo "🔍 Found record with ID: " . $resetRecord->id . "\n";
    } else {
        echo "❌ Code appears INVALID to the system\n";
        echo "🔍 This is the problem!\n";
        
        // Let's check why
        $checkRecord = DB::table('password_resets')
            ->where('email', $testEmail)
            ->where('verification_code', $testCode)
            ->first();
            
        if ($checkRecord) {
            echo "🔍 Record exists but expired check failed\n";
            echo "🔍 Expiration time: " . $checkRecord->code_expires_at . "\n";
            echo "🔍 Current time: " . Carbon::now() . "\n";
        } else {
            echo "🔍 Record not found at all!\n";
        }
    }
} else {
    echo "❌ No records found for this email\n";
}

echo "\n🚀 QUICK FIX:\n";
echo "1. Generate fresh verification code\n";
echo "2. Use it immediately (within 15 minutes)\n";
echo "3. Make sure to type exactly 6 digits\n";
echo "4. Email must match exactly\n\n";

echo "If still failing, the issue might be:\n";
echo "- Database timezone mismatch\n";
echo "- Code format issue\n";
echo "- Email case sensitivity\n";
?>
