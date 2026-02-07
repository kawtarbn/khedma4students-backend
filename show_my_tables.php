<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

try {
    echo "=== YOUR DATABASE TABLES ===\n\n";
    
    // Get all tables
    $tables = DB::select('SHOW TABLES');
    
    foreach ($tables as $table) {
        $tableName = array_values((array)$table)[0];
        echo "📋 " . strtoupper($tableName) . "\n";
        echo str_repeat("=", 50) . "\n";
        
        // Get table structure
        $columns = DB::select("DESCRIBE `$tableName`");
        
        foreach ($columns as $column) {
            $null = $column->Null === 'YES' ? 'NULL' : 'NOT NULL';
            $key = $column->Key ? " {$column->Key}" : '';
            $default = $column->Default !== null ? " DEFAULT {$column->Default}" : '';
            
            printf("  %-20s %-20s %-8s %s%s\n", 
                $column->Field, 
                $column->Type, 
                $null,
                $key,
                $default
            );
        }
        
        // Get row count
        $count = DB::select("SELECT COUNT(*) as count FROM `$tableName`");
        echo "\n  📊 Rows: " . $count[0]->count . "\n\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
