<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Student;

class DebugStudentsController extends Controller
{
    public function debugStudents()
    {
        try {
            echo "=== DEBUG STUDENTS TABLE ===\n\n";
            
            // Check table exists
            $tableExists = DB::select("SELECT EXISTS (
                SELECT FROM information_schema.tables 
                WHERE table_schema = 'public' 
                AND table_name = 'students'
            ) as exists");
            
            echo "Table exists: " . ($tableExists[0]->exists ? 'YES' : 'NO') . "\n";
            
            // Get raw count
            $rawCount = DB::select("SELECT COUNT(*) as count FROM students");
            echo "Raw count: " . $rawCount[0]->count . "\n";
            
            // Get Laravel count
            $laravelCount = Student::count();
            echo "Laravel count: " . $laravelCount . "\n";
            
            // Show all students if any exist
            $students = Student::all();
            echo "Students found: " . $students->count() . "\n";
            
            if ($students->count() > 0) {
                echo "\nStudent records:\n";
                foreach ($students as $student) {
                    echo "ID: {$student->id}, Email: {$student->email}, Name: {$student->full_name}\n";
                }
            } else {
                echo "\n✅ NO STUDENTS FOUND - Table is empty!\n";
            }
            
            // Check sequence
            $sequence = DB::select("SELECT last_value FROM students_id_seq");
            echo "\nCurrent sequence value: " . $sequence[0]->last_value . "\n";
            
            // Reset sequence if needed
            if ($sequence[0]->last_value > 1) {
                echo "⚠ SEQUENCE NEEDS RESET!\n";
                DB::statement("ALTER SEQUENCE students_id_seq RESTART WITH 1");
                echo "✅ Sequence reset to 1\n";
            }
            
            return response()->json([
                'success' => true,
                'table_exists' => $tableExists[0]->exists,
                'raw_count' => $rawCount[0]->count,
                'laravel_count' => $laravelCount,
                'students' => $students->toArray(),
                'sequence_value' => $sequence[0]->last_value,
                'message' => $students->count() === 0 ? 'Table is empty' : 'Table has data'
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
