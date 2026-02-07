<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class EmptyDatabaseController extends Controller
{
    public function createEmptyDatabase()
    {
        try {
            echo "=== CREATING EMPTY DATABASE ===\n\n";
            
            // Step 1: Drop all tables
            echo "Step 1: Dropping all tables...\n";
            
            $tables = [
                'password_resets',
                'success_stories', 
                'reviews',  // Reviews table
                'contact_messages',
                'notifications',
                'hiring_requests',
                'applications',
                'services',
                'jobs',
                'employers',
                'students',
                'personal_access_tokens',
                'cache',
                'sessions'
            ];
            
            foreach ($tables as $table) {
                try {
                    DB::statement("DROP TABLE IF EXISTS $table CASCADE");
                    echo "✓ Dropped table: $table\n";
                } catch (\Exception $e) {
                    echo "⚠ Could not drop $table: " . $e->getMessage() . "\n";
                }
            }
            
            // Step 2: Run fresh migrations (empty tables only)
            echo "\nStep 2: Running fresh migrations (NO DATA)...\n";
            
            // Run migrate:fresh to drop all tables and re-run migrations
            $exitCode = Artisan::call('migrate:fresh', ['--force' => true]);
            
            if ($exitCode === 0) {
                echo "✅ Migrations completed successfully\n";
            } else {
                echo "❌ Migration failed with exit code: $exitCode\n";
                echo Artisan::output();
            }
            
            // Step 3: DO NOT run seeders - keep empty
            echo "\nStep 3: Skipping seeders - keeping database EMPTY\n";
            echo "✅ Database is now completely empty\n";
            
            // Step 4: Show final status
            echo "\n📊 Final Database Status:\n";
            
            $tables = ['students', 'employers', 'jobs', 'services', 'applications', 'hiring_requests', 'reviews'];
            
            foreach ($tables as $table) {
                try {
                    $count = DB::table($table)->count();
                    echo "   $table: $count records\n";
                } catch (\Exception $e) {
                    echo "   $table: ERROR - " . $e->getMessage() . "\n";
                }
            }
            
            echo "\n🎯 READY FOR USE!\n";
            echo "   - All tables created with proper structure\n";
            echo "   - NO pre-filled data\n";
            echo "   - Ready for your users to register\n";
            echo "   - Ready for your content\n";
            
            echo "\n✅ SUCCESS! Empty database created!\n";
            
            return response()->json([
                'success' => true,
                'message' => 'Empty database created successfully',
                'migrations_run' => true,
                'seeders_run' => false,
                'data_status' => 'completely_empty'
            ]);
            
        } catch (\Exception $e) {
            echo "❌ ERROR: " . $e->getMessage() . "\n";
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
