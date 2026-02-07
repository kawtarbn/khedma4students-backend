<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetController extends Controller
{
    public function resetDatabase()
    {
        try {
            // Get all table names
            $tables = [
                'applications',
                'hiring_requests', 
                'services',
                'jobs',
                'notifications',
                'contact_messages',
                'reviews',
                'success_stories',
                'password_resets',
                'students',
                'employers'
            ];
            
            // Disable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            foreach ($tables as $table) {
                try {
                    $count = DB::table($table)->count();
                    DB::table($table)->truncate();
                } catch (Exception $e) {
                    // Continue even if table doesn't exist
                }
            }
            
            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            
            return response()->json([
                'success' => true,
                'message' => 'Database completely reset',
                'status' => 'empty_and_ready'
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function seedFromZero()
    {
        try {
            // Check if database is empty
            $studentCount = DB::table('students')->count();
            $employerCount = DB::table('employers')->count();
            
            if ($studentCount > 0 || $employerCount > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'Database not empty. Please reset first.'
                ]);
            }
            
            // Create Students
            $students = [
                [
                    'full_name' => 'Ahmed Benali',
                    'email' => 'ahmed.benali@university.edu',
                    'password' => bcrypt('password123'),
                    'university' => 'University of Casablanca',
                    'city' => 'Casablanca',
                    'phone' => '+212600000001',
                    'skills' => 'Web Development, React, Node.js, MongoDB',
                    'description' => 'Computer Science student passionate about full-stack development.',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Fatima Zahra',
                    'email' => 'fatima.zahra@university.edu',
                    'password' => bcrypt('password123'),
                    'university' => 'University of Rabat',
                    'city' => 'Rabat',
                    'phone' => '+212600000002',
                    'skills' => 'Mobile Development, Flutter, Dart, Firebase',
                    'description' => 'Software Engineering student specializing in mobile apps.',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Mohammed Alami',
                    'email' => 'mohammed.alami@university.edu',
                    'password' => bcrypt('password123'),
                    'university' => 'University of Marrakech',
                    'city' => 'Marrakech',
                    'phone' => '+212600000003',
                    'skills' => 'UI/UX Design, Figma, Adobe XD, Prototyping',
                    'description' => 'Design student focused on user experience and interface design.',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Sara Amrani',
                    'email' => 'sara.amrani@university.edu',
                    'password' => bcrypt('password123'),
                    'university' => 'University of Fez',
                    'city' => 'Fez',
                    'phone' => '+212600000004',
                    'skills' => 'Data Science, Python, Machine Learning, TensorFlow',
                    'description' => 'Data Science student with expertise in machine learning.',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Yassine Kabbaj',
                    'email' => 'yassine.kabbaj@university.edu',
                    'password' => bcrypt('password123'),
                    'university' => 'University of Tangier',
                    'city' => 'Tangier',
                    'phone' => '+212600000005',
                    'skills' => 'Digital Marketing, SEO, Social Media, Content Strategy',
                    'description' => 'Marketing student specializing in digital marketing strategies.',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            
            foreach ($students as $student) {
                DB::table('students')->insert($student);
            }
            
            // Create Employers
            $employers = [
                [
                    'full_name' => 'Karim Mansouri',
                    'email' => 'karim.mansouri@techsolutions.ma',
                    'password' => bcrypt('password123'),
                    'company' => 'TechSolutions Morocco',
                    'city' => 'Casablanca',
                    'phone' => '+212500000001',
                    'description' => 'Leading technology company providing innovative software solutions.',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Lina Belkacem',
                    'email' => 'lina.belkacem@digitalagency.ma',
                    'password' => bcrypt('password123'),
                    'company' => 'Digital Marketing Pro',
                    'city' => 'Rabat',
                    'phone' => '+212500000002',
                    'description' => 'Full-service digital marketing agency helping businesses grow.',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'full_name' => 'Omar Zoubair',
                    'email' => 'omar.zoubair@innovatech.ma',
                    'password' => bcrypt('password123'),
                    'company' => 'Innovatech Systems',
                    'city' => 'Marrakech',
                    'phone' => '+212500000003',
                    'description' => 'Innovative technology startup focused on IoT solutions.',
                    'email_verified_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            
            foreach ($employers as $employer) {
                DB::table('employers')->insert($employer);
            }
            
            // Get created IDs
            $studentIds = DB::table('students')->pluck('id')->toArray();
            $employerIds = DB::table('employers')->pluck('id')->toArray();
            
            // Create Jobs
            $jobs = [
                [
                    'title' => 'Full Stack Web Developer',
                    'description' => 'Looking for a talented Full Stack Developer to join our team. You will work on exciting projects using React, Node.js, and MongoDB.',
                    'category' => 'Web Development',
                    'city' => 'Casablanca',
                    'pay_range' => '8000-15000 MAD/month',
                    'contactEmail' => 'karim.mansouri@techsolutions.ma',
                    'contactPhone' => '+212500000001',
                    'status' => 'Active',
                    'employer_id' => $employerIds[0],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Mobile App Developer',
                    'description' => 'Join our team to develop amazing mobile applications for iOS and Android. Experience with Flutter or React Native required.',
                    'category' => 'Mobile Development',
                    'city' => 'Rabat',
                    'pay_range' => '7000-12000 MAD/month',
                    'contactEmail' => 'lina.belkacem@digitalagency.ma',
                    'contactPhone' => '+212500000002',
                    'status' => 'Active',
                    'employer_id' => $employerIds[1],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'UI/UX Designer Intern',
                    'description' => 'Great opportunity for design students to gain hands-on experience. You will work on real projects and learn from experienced designers.',
                    'category' => 'Design',
                    'city' => 'Marrakech',
                    'pay_range' => '3000-5000 MAD/month',
                    'contactEmail' => 'omar.zoubair@innovatech.ma',
                    'contactPhone' => '+212500000003',
                    'status' => 'Active',
                    'employer_id' => $employerIds[2],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Data Science Intern',
                    'description' => 'Looking for a data science enthusiast to join our research team. You will work on machine learning projects and data analysis.',
                    'category' => 'Data Science',
                    'city' => 'Casablanca',
                    'pay_range' => '4000-7000 MAD/month',
                    'contactEmail' => 'karim.mansouri@techsolutions.ma',
                    'contactPhone' => '+212500000001',
                    'status' => 'Active',
                    'employer_id' => $employerIds[0],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Digital Marketing Specialist',
                    'description' => 'We need a creative digital marketing specialist to manage our online campaigns. Experience with SEO and social media required.',
                    'category' => 'Marketing',
                    'city' => 'Rabat',
                    'pay_range' => '6000-10000 MAD/month',
                    'contactEmail' => 'lina.belkacem@digitalagency.ma',
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
            
            // Create Services
            $services = [
                [
                    'title' => 'Web Development Services',
                    'description' => 'Professional website development using modern technologies. I create responsive, fast, and secure websites.',
                    'category' => 'Web Development',
                    'city' => 'Casablanca',
                    'pay' => '1000-5000 MAD/project',
                    'availability' => 'Weekends, Evenings',
                    'contact_email' => 'ahmed.benali@university.edu',
                    'status' => 'Active',
                    'student_id' => $studentIds[0],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Mobile App Development',
                    'description' => 'I develop cross-platform mobile apps using Flutter. Perfect for startups and businesses.',
                    'category' => 'Mobile Development',
                    'city' => 'Rabat',
                    'pay' => '2000-8000 MAD/project',
                    'availability' => 'Flexible',
                    'contact_email' => 'fatima.zahra@university.edu',
                    'status' => 'Active',
                    'student_id' => $studentIds[1],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'UI/UX Design Services',
                    'description' => 'Beautiful and functional design services for websites and mobile apps. I specialize in user research and prototyping.',
                    'category' => 'Design',
                    'city' => 'Marrakech',
                    'pay' => '500-3000 MAD/project',
                    'availability' => 'Weekdays',
                    'contact_email' => 'mohammed.alami@university.edu',
                    'status' => 'Active',
                    'student_id' => $studentIds[2],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Data Analysis Services',
                    'description' => 'Help businesses make sense of their data through analysis, visualization, and predictive modeling.',
                    'category' => 'Data Science',
                    'city' => 'Fez',
                    'pay' => '1500-6000 MAD/project',
                    'availability' => 'Weekends',
                    'contact_email' => 'sara.amrani@university.edu',
                    'status' => 'Active',
                    'student_id' => $studentIds[3],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ];
            
            foreach ($services as $service) {
                DB::table('services')->insert($service);
            }
            
            // Final counts
            $finalStudentCount = DB::table('students')->count();
            $finalEmployerCount = DB::table('employers')->count();
            $finalJobCount = DB::table('jobs')->count();
            $finalServiceCount = DB::table('services')->count();
            
            return response()->json([
                'success' => true,
                'message' => 'Database seeded successfully from zero',
                'counts' => [
                    'students' => $finalStudentCount,
                    'employers' => $finalEmployerCount,
                    'jobs' => $finalJobCount,
                    'services' => $finalServiceCount
                ],
                'test_accounts' => [
                    'student' => 'ahmed.benali@university.edu / password123',
                    'employer' => 'karim.mansouri@techsolutions.ma / password123'
                ]
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
