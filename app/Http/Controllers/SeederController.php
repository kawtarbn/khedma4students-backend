<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeederController extends Controller
{
    public function seedProduction()
    {
        try {
            // Check current database state
            $studentCount = DB::table('students')->count();
            $employerCount = DB::table('employers')->count();
            $jobCount = DB::table('jobs')->count();
            
            if ($jobCount > 0) {
                return response()->json([
                    'success' => true,
                    'message' => 'Database already has jobs',
                    'counts' => [
                        'students' => $studentCount,
                        'employers' => $employerCount,
                        'jobs' => $jobCount
                    ]
                ]);
            }
            
            // Create sample employers
            $employers = [
                [
                    'full_name' => 'Tech Solutions HR',
                    'email' => 'hr@techsolutions.com',
                    'password' => bcrypt('password123'),
                    'company' => 'Tech Solutions Inc',
                    'city' => 'Casablanca',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Digital Agency Manager',
                    'email' => 'jobs@digitalma.com',
                    'password' => bcrypt('password123'),
                    'company' => 'Digital Marketing Agency',
                    'city' => 'Rabat',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            
            foreach ($employers as $employer) {
                DB::table('employers')->insert($employer);
            }
            
            // Get employer IDs
            $employerIds = DB::table('employers')->pluck('id')->toArray();
            
            // Create jobs
            $jobs = [
                [
                    'title' => 'Full Stack Developer',
                    'description' => 'Looking for an experienced full stack developer with Laravel and React skills.',
                    'category' => 'Web Development',
                    'city' => 'Casablanca',
                    'pay_range' => '8000-12000 MAD/month',
                    'contactEmail' => 'hr@techsolutions.com',
                    'contactPhone' => '+212500000001',
                    'status' => 'Active',
                    'employer_id' => $employerIds[0],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Mobile App Developer',
                    'description' => 'Seeking mobile app developer with React Native experience.',
                    'category' => 'Mobile Development',
                    'city' => 'Rabat',
                    'pay_range' => '7000-10000 MAD/month',
                    'contactEmail' => 'hr@techsolutions.com',
                    'contactPhone' => '+212500000001',
                    'status' => 'Active',
                    'employer_id' => $employerIds[0],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Digital Marketing Intern',
                    'description' => 'Great opportunity for students to learn digital marketing.',
                    'category' => 'Marketing',
                    'city' => 'Rabat',
                    'pay_range' => '3000-4000 MAD/month',
                    'contactEmail' => 'jobs@digitalma.com',
                    'contactPhone' => '+212500000002',
                    'status' => 'Active',
                    'employer_id' => $employerIds[1],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            
            foreach ($jobs as $job) {
                DB::table('jobs')->insert($job);
            }
            
            // Create sample services
            $studentIds = DB::table('students')->pluck('id')->toArray();
            
            if (!empty($studentIds)) {
                $services = [
                    [
                        'title' => 'Web Development Services',
                        'description' => 'Custom website development using modern technologies',
                        'category' => 'Web Development',
                        'city' => 'Casablanca',
                        'pay' => '500-2000 MAD/project',
                        'availability' => 'Weekends',
                        'contact_email' => 'student@university.edu',
                        'status' => 'Active',
                        'student_id' => $studentIds[0],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                ];
                
                foreach ($services as $service) {
                    DB::table('services')->insert($service);
                }
            }
            
            // Final counts
            $finalStudentCount = DB::table('students')->count();
            $finalEmployerCount = DB::table('employers')->count();
            $finalJobCount = DB::table('jobs')->count();
            $finalServiceCount = DB::table('services')->count();
            
            return response()->json([
                'success' => true,
                'message' => 'Database seeded successfully',
                'counts' => [
                    'students' => $finalStudentCount,
                    'employers' => $finalEmployerCount,
                    'jobs' => $finalJobCount,
                    'services' => $finalServiceCount
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
