<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== QUICK EMAIL TEST ===\n\n";

use Illuminate\Support\Facades\Mail;

try {
    // Send a test email to see the exact error
    Mail::raw('Test email from Khedma4Students', function ($message) {
        $message->to('test@example.com')
                ->subject('🧪 Email Test')
                ->from(config('mail.from.address'), config('mail.from.name'));
    });
    
    echo "✅ Email sent successfully!\n";
    echo "✅ Your email service is working!\n";
    
} catch (\Exception $e) {
    echo "❌ Email failed to send\n";
    echo "❌ Error: " . $e->getMessage() . "\n\n";
    
    if (strpos($e->getMessage(), 'Application-specific password required') !== false) {
        echo "🔧 SOLUTION:\n";
        echo "1. Enable 2-Step Verification on your Google Account\n";
        echo "2. Go to: https://myaccount.google.com/apppasswords\n";
        echo "3. Generate App Password for 'Mail'\n";
        echo "4. Copy the 16-character password (with spaces)\n";
        echo "5. Update MAIL_PASSWORD in .env\n";
        echo "6. Run: php artisan config:cache\n\n";
    }
}

echo "Current .env settings:\n";
echo "MAIL_MAILER=" . config('mail.default') . "\n";
echo "MAIL_HOST=" . config('mail.mailers.smtp.host') . "\n";
echo "MAIL_PORT=" . config('mail.mailers.smtp.port') . "\n";
echo "MAIL_USERNAME=" . config('mail.mailers.smtp.username') . "\n";
echo "MAIL_PASSWORD=" . (config('mail.mailers.smtp.password') ? '[SET]' : '[NOT SET]') . "\n";
echo "MAIL_ENCRYPTION=" . config('mail.mailers.smtp.encryption') . "\n";
?>
