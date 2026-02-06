<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServicesForCRUDTestingSeeder extends Seeder
{
    public function run(): void
    {
        // Get students to associate with services
        $students = \DB::table('students')->pluck('id')->toArray();
        
        if (empty($students)) {
            $this->command->error('No students found. Please run students seeder first.');
            return;
        }

        $services = [
            // Tutoring service
            [
                'title' => 'Mathematics Tutoring',
                'description' => 'Professional mathematics tutoring for high school and university students. Specializing in calculus, algebra, and statistics.',
                'category' => 'Education',
                'city' => 'Algiers',
                'pay' => '1500 DZD/hour',
                'availability' => 'Weekdays 4PM-8PM, Weekends 9AM-6PM',
                'contact_email' => 'tutor@ahmed.example.com',
                'student_id' => $students[0] ?? 1,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Web development service
            [
                'title' => 'Full-Stack Web Development',
                'description' => 'Custom website development using modern technologies. React, Node.js, MongoDB, and cloud deployment.',
                'category' => 'Technology',
                'city' => 'Constantine',
                'pay' => '5000-15000 DZD/project',
                'availability' => 'Flexible, project-based',
                'contact_email' => 'dev@fatima.example.com',
                'student_id' => $students[1] ?? 2,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Design service
            [
                'title' => 'Logo Design & Branding',
                'description' => 'Creative logo design and complete branding packages for startups and businesses.',
                'category' => 'Design',
                'city' => 'Oran',
                'pay' => '3000-8000 DZD/project',
                'availability' => '24-48 hour turnaround',
                'contact_email' => 'design@mohamed.example.com',
                'student_id' => $students[2] ?? 3,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Translation service
            [
                'title' => 'English-Arabic Translation',
                'description' => 'Professional translation services between English and Arabic. Documents, websites, and content.',
                'category' => 'Languages',
                'city' => 'Tlemcen',
                'pay' => '50 DZD/page',
                'availability' => 'Same-day delivery for short documents',
                'contact_email' => 'translate@amina.example.com',
                'student_id' => $students[3] ?? 4,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Unavailable service (for testing filters)
            [
                'title' => 'Photography Services',
                'description' => 'Professional photography for events, portraits, and commercial projects.',
                'category' => 'Media',
                'city' => 'Annaba',
                'pay' => '2000-10000 DZD/session',
                'availability' => 'Currently booked until next month',
                'contact_email' => 'photo@yacine.example.com',
                'student_id' => $students[4] ?? 5,
                'status' => 'Inactive',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(2),
            ],
        ];

        foreach ($services as $service) {
            \DB::table('services')->insert($service);
        }

        $this->command->info('Services for CRUD testing seeded successfully!');
    }
}
