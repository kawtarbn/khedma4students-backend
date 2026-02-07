<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

try {
    // Get all tables
    $tables = DB::select("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public' ORDER BY table_name");
    
    echo "=== DATABASE TABLES ===\n\n";
    
    foreach ($tables as $table) {
        echo "- " . $table->table_name . "\n";
    }
    
    echo "\n=== TABLE DETAILS ===\n\n";
    
    // Show structure for each table
    foreach ($tables as $table) {
        echo "Table: " . $table->table_name . "\n";
        echo str_repeat("-", 50) . "\n";
        
        $columns = DB::select("
            SELECT 
                column_name, 
                data_type, 
                is_nullable, 
                column_default,
                character_maximum_length
            FROM information_schema.columns 
            WHERE table_name = ? 
            ORDER BY ordinal_position
        ", [$table->table_name]);
        
        foreach ($columns as $column) {
            $nullable = $column->is_nullable === 'YES' ? 'NULL' : 'NOT NULL';
            $default = $column->column_default ? " DEFAULT {$column->column_default}" : '';
            $length = $column->character_maximum_length ? "({$column->character_maximum_length})" : '';
            
            printf("  %-20s %-15s %-10s %s%s\n", 
                $column->column_name, 
                $column->data_type . $length, 
                $nullable, 
                $default
            );
        }
        
        // Show row count
        $count = DB::select("SELECT COUNT(*) as count FROM " . $table->table_name);
        echo "\n  Rows: " . $count[0]->count . "\n\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
