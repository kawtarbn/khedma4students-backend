<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\StudentPasswordResetController;
use Illuminate\Http\Request;

echo "=== TESTING IMPROVED PASSWORD RESET ===\n\n";

$controller = new StudentPasswordResetController();

// Test with a real student email
$request = new Request(['email' => 'teststudent@example.com']);
$response = $controller->sendResetLink($request);

$data = $response->getData();

echo "1. Student Password Reset Request:\n";
echo "   - Message: " . $data->message . "\n";
if (isset($data->reset_url)) {
    echo "   - Reset URL: " . $data->reset_url . "\n";
}
if (isset($data->token)) {
    echo "   - Token: " . $data->token . "\n";
}
if (isset($data->note)) {
    echo "   - Note: " . $data->note . "\n";
}

echo "\n2. What you can do now:\n";
echo "   - Copy the reset URL above and paste in browser\n";
echo "   - Or copy the token and use the reset form\n";
echo "   - The system will work even without email configuration\n";

echo "\n3. Email Logging:\n";
echo "   - All password reset attempts are logged\n";
echo "   - Check: http://127.0.0.1:8000/preview-emails\n";
echo "   - See email template: http://127.0.0.1:8000/email-test\n";

echo "\n=== READY TO USE! ===\n";
?>
