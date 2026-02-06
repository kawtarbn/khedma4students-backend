<?php

echo "=== CHECKING LARAVEL LOGS FOR VERIFICATION CODE ===\n\n";

$logFile = storage_path('logs/laravel.log');
if (file_exists($logFile)) {
    $content = file_get_contents($logFile);
    
    // Look for recent password reset code entries
    $lines = explode("\n", $content);
    $recentEntries = [];
    
    foreach (array_reverse($lines) as $line) {
        if (strpos($line, 'Password reset code sent') !== false) {
            $recentEntries[] = $line;
            if (count($recentEntries) >= 3) break; // Get last 3 entries
        }
    }
    
    if (!empty($recentEntries)) {
        echo "🔍 RECENT PASSWORD RESET LOGS:\n\n";
        foreach ($recentEntries as $entry) {
            echo $entry . "\n\n";
        }
        
        // Try to extract the verification code from the most recent entry
        $latestEntry = $recentEntries[0];
        if (preg_match('/verification_code":"(\d{6})"/', $latestEntry, $matches)) {
            echo "🎯 LATEST VERIFICATION CODE: " . $matches[1] . "\n\n";
            echo "📧 Email: kawtarbenabdelmoumene@gmail.com\n";
            echo "🔢 Code: " . $matches[1] . "\n";
            echo "⏰ Expires in 30 minutes\n\n";
            
            echo "📱 TEST NOW:\n";
            echo "1. Go to: http://localhost:3000/reset-password\n";
            echo "2. Enter email: kawtarbenabdelmoumene@gmail.com\n";
            echo "3. Enter code: " . $matches[1] . "\n";
            echo "4. Enter new password\n";
            echo "5. Click 'Reset Password'\n";
            echo "6. ✅ Should work!\n";
        } else {
            echo "❌ Could not extract verification code from logs\n";
        }
    } else {
        echo "❌ No recent password reset entries found in logs\n";
    }
} else {
    echo "❌ Log file not found: " . $logFile . "\n";
}

echo "\n🔧 ALTERNATIVE: Generate new code\n";
echo "If the code above doesn't work, generate a fresh one:\n";
echo "1. Go to: http://localhost:3000/forgot-password\n";
echo "2. Enter: kawtarbenabdelmoumene@gmail.com\n";
echo "3. Check browser network tab for response\n";
echo "4. Look for 'verification_code' in the response\n";
echo "5. Use that code immediately\n";
?>
