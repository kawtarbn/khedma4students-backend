<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SimpleApplicationsSeeder extends Seeder
{
    public function run(): void
    {
        // Get students and jobs for relationships
        $students = \DB::table('students')->pluck('id')->toArray();
        $jobs = \DB::table('jobs')->pluck('id')->toArray();
        
        if (empty($students) || empty($jobs)) {
            $this->command->error('No students or active jobs found. Please run students and jobs seeders first.');
            return;
        }

        $applications = [
            // Pending application
            [
                'job_id' => $jobs[0] ?? 1,
                'student_id' => $students[0] ?? 1,
                'fullname' => 'Ahmed Benali',
                'email' => 'ahmed.weak@example.com',
                'phone' => '+213 555 111 222',
                'message' => 'I am very interested in this React Developer position. I have 3 years of experience with React and modern JavaScript.',
                'experience' => '3 years of React development, 2 years with Node.js, experienced with Git, REST APIs, and modern CSS frameworks.',
                'status' => 'pending',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            // Accepted application
            [
                'job_id' => $jobs[1] ?? 2,
                'student_id' => $students[1] ?? 2,
                'fullname' => 'Fatima Zohra',
                'email' => 'fatima.strong@example.com',
                'phone' => '+213 555 333 444',
                'message' => 'As a creative writing student, I believe I am perfect for this content writing internship.',
                'experience' => '2 years of content writing experience, managed university blog with 500+ monthly visitors, social media marketing experience.',
                'status' => 'accepted',
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(10),
            ],
            // Rejected application
            [
                'job_id' => $jobs[2] ?? 3,
                'student_id' => $students[2] ?? 3,
                'fullname' => 'Mohamed Cherif',
                'email' => 'mohamed.special@example.com',
                'phone' => '+213 555 555 666',
                'message' => 'I am a UI/UX design student with a strong portfolio in mobile app design.',
                'experience' => '1 year of UI/UX design experience, proficient in Figma and Adobe XD, have 3 mobile app projects in portfolio.',
                'status' => 'rejected',
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(18),
            ],
        ];

        foreach ($applications as $application) {
            \DB::table('applications')->insert($application);
        }

        $this->command->info('Simple applications seeded successfully!');
    }
}
