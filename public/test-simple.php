<?php
// Simple PHP test - bypasses Laravel completely
echo "PHP Version: " . phpversion();
echo "<br>";
echo "Server Time: " . date('Y-m-d H:i:s');
echo "<br>";
echo "Backend Server Status: RUNNING";
echo "<br>";
echo "Environment: " . (getenv('APP_ENV') ?: 'not set');
echo "<br>";
echo "Database Host: " . (getenv('DB_HOST') ?: 'not set');
echo "<br>";
echo "SUCCESS: PHP is working independently!";
?>
