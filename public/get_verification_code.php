<?php

// Get verification code for development/testing
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: application/json');

$email = $_GET['email'] ?? 'kawtarbenabdelmoumene@gmail.com';

try {
    echo "=== GET VERIFICATION CODE ===\n\n";
    echo "Email: $email\n\n";
    
    // Check if there's a verification code
    $resetRecord = DB::table('password_resets')
        ->where('email', $email)
        ->orderBy('created_at', 'desc')
        ->first();
    
    if ($resetRecord && $resetRecord->code_expires_at > now()) {
        echo "✅ Found active verification code:\n";
        echo "Code: {$resetRecord->verification_code}\n";
        echo "Expires: {$resetRecord->code_expires_at}\n";
        echo "Created: {$resetRecord->created_at}\n";
        
        echo json_encode([
            'success' => true,
            'email' => $email,
            'verification_code' => $resetRecord->verification_code,
            'expires_at' => $resetRecord->code_expires_at,
            'message' => 'Use this code to verify your email'
        ]);
    } else {
        echo "❌ No active verification code found.\n";
        echo "Generating new verification code...\n\n";
        
        // Generate new verification code
        $token = Str::random(60);
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Delete any existing tokens for this email
        DB::table('password_resets')->where('email', $email)->delete();
        
        // Create new password reset record with code
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'verification_code' => $verificationCode,
            'created_at' => now(),
            'code_expires_at' => now()->addMinutes(30)
        ]);
        
        echo "✅ New verification code generated:\n";
        echo "Code: $verificationCode\n";
        echo "Expires: " . now()->addMinutes(30) . "\n";
        
        echo json_encode([
            'success' => true,
            'email' => $email,
            'verification_code' => $verificationCode,
            'expires_at' => now()->addMinutes(30),
            'message' => 'New verification code generated. Use this code to verify your email.'
        ]);
    }
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
