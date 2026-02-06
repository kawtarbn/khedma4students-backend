<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Service;
use App\Models\Student;

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        // Get students for foreign key relationships
        $students = Student::all();
        
        $services = [
            [
                'title' => 'Web Development Tutoring',
                'description' => 'Professional web development tutoring covering HTML, CSS, JavaScript, and React. Available weekends and evenings.',
                'category' => 'Tutoring & education',
                'city' => 'Algiers',
                'pay' => '2000 DA/hour',
                'availability' => 'Weekends, Evenings',
                'contact_email' => 'ahmed.benali1@student.com',
                'status' => 'Active',
                'student_id' => $students[0]->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'French Translation Services',
                'description' => 'Professional French to English and English to French translation services. Academic and business documents welcome.',
                'category' => 'Freelance & digital work',
                'city' => 'Oran',
                'pay' => '1500 DA/document',
                'availability' => 'Flexible',
                'contact_email' => 'fatima.zerrouki@student.com',
                'status' => 'Active',
                'student_id' => $students[1]->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Math Homework Help',
                'description' => 'Help with mathematics homework for elementary and middle school students. Patient and experienced tutor.',
                'category' => 'Tutoring & education',
                'city' => 'Constantine',
                'pay' => '1000 DA/hour',
                'availability' => 'After school hours',
                'contact_email' => 'mohamed.boudiaf@student.com',
                'status' => 'Active',
                'student_id' => $students[2]->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Graphic Design Services',
                'description' => 'Creative graphic design services including logos, posters, and social media graphics. Quick turnaround time.',
                'category' => 'Freelance & digital work',
                'city' => 'Blida',
                'pay' => '3000 DA/project',
                'availability' => 'Available 24/7',
                'contact_email' => 'amina.khelifa@student.com',
                'status' => 'Active',
                'student_id' => $students[3]->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Babysitting Services',
                'description' => 'Reliable babysitting services in the Tlemcen area. Experience with children of all ages. References available.',
                'category' => 'Babysitting & Household Help',
                'city' => 'Tlemcen',
                'pay' => '800 DA/hour',
                'availability' => 'Evenings, Weekends',
                'contact_email' => 'karim.tlemcani@student.com',
                'status' => 'Active',
                'student_id' => $students[4]->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Grocery Shopping Assistant',
                'description' => 'Help with grocery shopping and errands for elderly or busy families. Trustworthy and efficient.',
                'category' => 'Delivery and Errands',
                'city' => 'Algiers',
                'pay' => '500 DA/trip',
                'availability' => 'Flexible schedule',
                'contact_email' => 'ahmed.benali1@student.com',
                'status' => 'Active',
                'student_id' => $students[0]->id,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Academic Writing Services',
                'description' => 'Professional academic writing for essays, research papers, and dissertations. All subjects covered.',
                'category' => 'Tutoring & education',
                'city' => 'Oran',
                'pay' => '2000 DA/page',
                'availability' => 'Weekdays',
                'contact_email' => 'fatima.zerrouki@student.com',
                'status' => 'Active',
                'student_id' => $students[1]->id,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
