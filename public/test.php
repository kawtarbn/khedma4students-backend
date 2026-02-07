<?php
echo "PHP is working!";
echo "<br>";
echo "Time: " . date('Y-m-d H:i:s');
echo "<br>";
echo "Laravel bootstrap test: ";

try {
    require_once __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    echo "✅ Laravel loads successfully";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
