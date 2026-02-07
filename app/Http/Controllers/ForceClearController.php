<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use App\Models\Review;

class ForceClearController extends Controller
{
    public function forceClearAll()
    {
        try {
            echo "=== FORCE CLEAR ALL DATA ===\n\n";
            
            // Step 1: Truncate all tables (more aggressive than drop)
            echo "Step 1: Truncating all tables...\n";
            
            $tables = [
                'password_resets',
                'success_stories', 
                'reviews',
                'contact_messages',
                'notifications',
                'hiring_requests',
                'applications',
                'services',
                'jobs',
                'employers',
                'students'
            ];
            
            foreach ($tables as $table) {
                try {
                    DB::table($table)->truncate();
                    echo "✓ Truncated table: $table\n";
                } catch (\Exception $e) {
                    echo "⚠ Could not truncate $table: " . $e->getMessage() . "\n";
                }
            }
            
            // Step 2: Reset PostgreSQL sequences
            echo "\nStep 2: Resetting sequences...\n";
            
            $sequences = [
                'students_id_seq',
                'employers_id_seq',
                'jobs_id_seq',
                'services_id_seq',
                'applications_id_seq',
                'hiring_requests_id_seq',
                'notifications_id_seq',
                'contact_messages_id_seq',
                'reviews_id_seq',
                'success_stories_id_seq',
                'password_resets_id_seq'
            ];
            
            foreach ($sequences as $sequence) {
                try {
                    DB::statement("ALTER SEQUENCE $sequence RESTART WITH 1");
                    echo "✓ Reset sequence: $sequence\n";
                } catch (\Exception $e) {
                    echo "⚠ Could not reset $sequence: " . $e->getMessage() . "\n";
                }
            }
            
            // Step 3: Verify all tables are empty
            echo "\nStep 3: Verifying tables are empty...\n";
            
            $allEmpty = true;
            foreach ($tables as $table) {
                try {
                    $count = DB::table($table)->count();
                    echo "   $table: $count records\n";
                    if ($count > 0) {
                        $allEmpty = false;
                    }
                } catch (\Exception $e) {
                    echo "   $table: ERROR - " . $e->getMessage() . "\n";
                    $allEmpty = false;
                }
            }
            
            // Step 4: Clear Laravel cache
            echo "\nStep 4: Clearing Laravel cache...\n";
            
            try {
                Artisan::call('cache:clear');
                echo "✓ Cache cleared\n";
            } catch (\Exception $e) {
                echo "⚠ Cache clear failed: " . $e->getMessage() . "\n";
            }
            
            // Step 5: Clear config cache
            try {
                Artisan::call('config:clear');
                echo "✓ Config cache cleared\n";
            } catch (\Exception $e) {
                echo "⚠ Config clear failed: " . $e->getMessage() . "\n";
            }
            
            echo "\n" . ($allEmpty ? "✅ SUCCESS: All tables are empty!" : "❌ WARNING: Some tables still have data") . "\n";
            
            return response()->json([
                'success' => true,
                'message' => $allEmpty ? 'All data cleared successfully' : 'Some data may remain',
                'tables_cleared' => $tables,
                'sequences_reset' => $sequences,
                'all_empty' => $allEmpty,
                'cache_cleared' => true
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
