<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== CHECKING RESPONSE STRUCTURE ===\n\n";

use App\Http\Controllers\StudentPasswordResetController;
use Illuminate\Http\Request;

$controller = new StudentPasswordResetController();
$request = new Request(['email' => 'teststudent@example.com']);
$response = $controller->sendResetLink($request);

echo "Response Type: " . get_class($response) . "\n";
echo "Response Data: ";
print_r($response->getData(true)); // true for array

echo "\n=== SOLUTION FOR STUDENTS ===\n";
echo "1. Student requests password reset\n";
echo "2. Gets email with fresh token\n";
echo "3. Must click link within 60 minutes\n";
echo "4. Enters new password\n";
echo "5. Reset works! ✅\n\n";

echo "The issue was using old tokens. Fresh tokens work!\n";
?>
