<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SequenceFixController extends Controller
{
    public function fixSequences()
    {
        try {
            // Clear all data first
            $tables = ['students', 'employers', 'jobs', 'services', 'applications', 'hiring_requests'];
            
            foreach ($tables as $table) {
                try {
                    DB::table($table)->truncate();
                } catch (Exception $e) {
                    // Continue even if table doesn't exist
                }
            }
            
            // Reset sequences to start from 1
            $sequences = [
                'students_id_seq',
                'employers_id_seq', 
                'jobs_id_seq',
                'services_id_seq',
                'applications_id_seq',
                'hiring_requests_id_seq'
            ];
            
            foreach ($sequences as $sequence) {
                try {
                    DB::statement("ALTER SEQUENCE $sequence RESTART WITH 1");
                } catch (Exception $e) {
                    // Continue even if sequence doesn't exist
                }
            }
            
            // Create sample students starting from ID 1
            $students = [
                [
                    'full_name' => 'Ahmed Benali',
                    'email' => 'ahmed.benali@university.edu',
                    'password' => Hash::make('password123'),
                    'university' => 'University of Casablanca',
                    'city' => 'Casablanca',
                    'phone' => '+212600000001',
                    'skills' => 'Web Development, React, Node.js',
                    'description' => 'Computer Science student passionate about web development',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Fatima Zahra',
                    'email' => 'fatima.zahra@university.edu',
                    'password' => Hash::make('password123'),
                    'university' => 'University of Rabat',
                    'city' => 'Rabat',
                    'phone' => '+212600000002',
                    'skills' => 'Mobile Development, Flutter',
                    'description' => 'Software Engineering student focused on mobile apps',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Mohammed Alami',
                    'email' => 'mohammed.alami@university.edu',
                    'password' => Hash::make('password123'),
                    'university' => 'University of Marrakech',
                    'city' => 'Marrakech',
                    'phone' => '+212600000003',
                    'skills' => 'UI/UX Design, Figma',
                    'description' => 'Design student focused on user experience',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Sara Amrani',
                    'email' => 'sara.amrani@university.edu',
                    'password' => Hash::make('password123'),
                    'university' => 'University of Fez',
                    'city' => 'Fez',
                    'phone' => '+212600000004',
                    'skills' => 'Data Science, Python',
                    'description' => 'Data Science student with ML expertise',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Yassine Kabbaj',
                    'email' => 'yassine.kabbaj@university.edu',
                    'password' => Hash::make('password123'),
                    'university' => 'University of Tangier',
                    'city' => 'Tangier',
                    'phone' => '+212600000005',
                    'skills' => 'Digital Marketing, SEO',
                    'description' => 'Marketing student specializing in digital strategies',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Karim Mansouri',
                    'email' => 'karim.mansouri@university.edu',
                    'password' => Hash::make('password123'),
                    'university' => 'University of Casablanca',
                    'city' => 'Casablanca',
                    'phone' => '+212600000006',
                    'skills' => 'Full Stack Development, Laravel',
                    'description' => 'Full stack developer with Laravel expertise',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Lina Belkacem',
                    'email' => 'lina.belkacem@university.edu',
                    'password' => Hash::make('password123'),
                    'university' => 'University of Rabat',
                    'city' => 'Rabat',
                    'phone' => '+212600000007',
                    'skills' => 'Backend Development, Node.js',
                    'description' => 'Backend developer specializing in Node.js',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            
            foreach ($students as $student) {
                DB::table('students')->insert($student);
            }
            
            // Create employers starting from ID 1
            $employers = [
                [
                    'full_name' => 'Tech Solutions HR',
                    'email' => 'hr@techsolutions.ma',
                    'password' => Hash::make('password123'),
                    'company' => 'TechSolutions Morocco',
                    'city' => 'Casablanca',
                    'phone' => '+212500000001',
                    'description' => 'Leading technology company in Morocco',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Digital Agency Manager',
                    'email' => 'manager@digitalagency.ma',
                    'password' => Hash::make('password123'),
                    'company' => 'Digital Marketing Pro',
                    'city' => 'Rabat',
                    'phone' => '+212500000002',
                    'description' => 'Full-service digital marketing agency',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            
            foreach ($employers as $employer) {
                DB::table('employers')->insert($employer);
            }
            
            // Check final results
            $finalStudents = DB::table('students')->orderBy('id')->get();
            $finalEmployers = DB::table('employers')->orderBy('id')->get();
            
            return response()->json([
                'success' => true,
                'message' => 'PostgreSQL sequences fixed and data recreated',
                'students' => $finalStudents->count(),
                'employers' => $finalEmployers->count(),
                'student_ids' => $finalStudents->pluck('id')->toArray(),
                'employer_ids' => $finalEmployers->pluck('id')->toArray(),
                'test_accounts' => [
                    'student_7' => 'lina.belkacem@university.edu / password123',
                    'student_6' => 'karim.mansouri@university.edu / password123',
                    'student_1' => 'ahmed.benali@university.edu / password123'
                ],
                'note' => 'Now your frontend will find student ID 7 and others!'
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
