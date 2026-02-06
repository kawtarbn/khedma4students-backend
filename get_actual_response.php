<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== GETTING ACTUAL RESPONSE ===\n\n";

use App\Http\Controllers\StudentPasswordResetController;
use Illuminate\Http\Request;

$controller = new StudentPasswordResetController();

$request = new Request(['email' => 'kawtarbenabdelmoumene@gmail.com']);
$response = $controller->sendResetLink($request);

echo "📧 Response Status: " . $response->getStatusCode() . "\n";
echo "📄 Response Data:\n";
print_r($response->getData(true));

echo "\n🎯 USE THE VERIFICATION CODE FROM ABOVE!\n";
echo "Go to: http://localhost:3000/reset-password\n";
echo "Enter the exact code shown in the response\n";
?>
