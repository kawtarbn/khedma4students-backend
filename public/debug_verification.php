<?php

// Debug verification codes in database
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: application/json');

$email = 'kawtarbenabdelmoumene@gmail.com';

try {
    echo "=== DEBUG VERIFICATION CODES ===\n\n";
    
    // Get all verification records for this email
    $records = DB::table('password_resets')
        ->where('email', $email)
        ->orderBy('created_at', 'desc')
        ->get();
    
    echo "Found " . $records->count() . " records for $email\n\n";
    
    foreach ($records as $record) {
        echo "Record ID: {$record->id}\n";
        echo "Email: {$record->email}\n";
        echo "Verification Code: {$record->verification_code}\n";
        echo "Token: {$record->token}\n";
        echo "Created: {$record->created_at}\n";
        echo "Expires: {$record->code_expires_at}\n";
        echo "Status: " . ($record->code_expires_at > now() ? "ACTIVE" : "EXPIRED") . "\n";
        echo "--------------------------------\n";
    }
    
    // Get the most recent active code
    $activeRecord = $records->firstWhere('code_expires_at', '>', now());
    
    if ($activeRecord) {
        echo "\n✅ ACTIVE VERIFICATION CODE:\n";
        echo "Code: {$activeRecord->verification_code}\n";
        echo "Use this code to verify the email: $email\n";
        
        echo json_encode([
            'success' => true,
            'email' => $email,
            'verification_code' => $activeRecord->verification_code,
            'expires_at' => $activeRecord->code_expires_at,
            'message' => 'Use this code to verify your email'
        ]);
    } else {
        echo "\n❌ No active verification code found.\n";
        
        echo json_encode([
            'success' => false,
            'message' => 'No active verification code found'
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
