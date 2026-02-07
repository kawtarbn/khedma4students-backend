<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentFixController extends Controller
{
    public function fixStudentIds()
    {
        try {
            // Check current students
            $currentStudents = DB::table('students')->get();
            $currentIds = $currentStudents->pluck('id')->toArray();
            
            // Create missing students (IDs 1-25)
            $missingStudents = [];
            for ($i = 1; $i <= 25; $i++) {
                if (!in_array($i, $currentIds)) {
                    $missingStudents[] = $i;
                }
            }
            
            if (!empty($missingStudents)) {
                $sampleNames = [
                    'Yassine Benzakour', 'Sara Amrani', 'Omar Khaled', 'Nadia Farsi',
                    'Karim Mansouri', 'Lina Belkacem', 'Mehdi Zoubair', 'Imane Rhali',
                    'Adil El Mansouri', 'Hajar Boudali', 'Walid Kabbaj', 'Meryem Ouafi',
                    'Anas Selmani', 'Khadija Raki', 'Brahim El Alami', 'Samira Zahidi',
                    'Tariq Jamali', 'Test Student 20', 'Test Student 21', 'Test Student 22',
                    'Test Student 23', 'Test Student 24', 'Test Student 25'
                ];
                
                $universities = [
                    'University of Casablanca', 'University of Rabat', 'University of Marrakech',
                    'University of Fez', 'University of Tangier', 'University of Agadir',
                    'University of Meknes', 'University of Oujda', 'University of El Jadida',
                    'University of Technology'
                ];
                
                $skills = [
                    'Web Development, JavaScript, React', 'Mobile Development, Flutter', 
                    'Data Science, Python, Machine Learning', 'UI/UX Design, Figma, Adobe XD',
                    'Digital Marketing, SEO, Social Media', 'Backend Development, Node.js, Express',
                    'Full Stack Development, Laravel, Vue.js', 'DevOps, Docker, Kubernetes',
                    'Game Development, Unity, C#', 'Blockchain Development, Solidity, Web3.js',
                    'Web Development, PHP, Laravel'
                ];
                
                foreach ($missingStudents as $index => $id) {
                    $nameIndex = min($index, count($sampleNames) - 1);
                    $univIndex = array_rand($universities);
                    $skillsIndex = array_rand($skills);
                    
                    $student = [
                        'id' => $id,
                        'full_name' => $sampleNames[$nameIndex] ?? "Test Student $id",
                        'email' => 'student' . $id . '@university.edu',
                        'password' => bcrypt('password123'),
                        'university' => $universities[$univIndex],
                        'city' => 'Casablanca',
                        'phone' => '+212600' . str_pad($id, 6, '0', STR_PAD_LEFT),
                        'skills' => $skills[$skillsIndex],
                        'description' => 'Computer Science student passionate about technology and innovation',
                        'email_verified_at' => now(),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    
                    DB::table('students')->insert($student);
                }
            }
            
            // Get final student list
            $allStudents = DB::table('students')->orderBy('id')->get();
            
            return response()->json([
                'success' => true,
                'message' => 'Student IDs fixed successfully',
                'total_students' => $allStudents->count(),
                'students' => $allStudents->map(function($student) {
                    return [
                        'id' => $student->id,
                        'full_name' => $student->full_name,
                        'email' => $student->email
                    ];
                })
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
