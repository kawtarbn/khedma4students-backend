<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ComprehensiveNotificationsSeeder extends Seeder
{
    public function run(): void
    {
        // Get IDs for relationships
        $students = \DB::table('students')->pluck('id', 'full_name')->toArray();
        $employers = \DB::table('employers')->pluck('id', 'company')->toArray();
        
        // Create realistic notifications for different scenarios
        $notifications = [
            // Employer notifications for new applications
            [
                'employer_id' => $employers['TechCorp Solutions'] ?? 1,
                'student_id' => null,
                'title' => 'New Application Received',
                'description' => 'Ahmed Benali has applied to your job: Full Stack Web Developer',
                'type' => 'new_application',
                'is_read' => false,
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],
            [
                'employer_id' => $employers['Education First Academy'] ?? 2,
                'student_id' => null,
                'title' => 'New Application Received',
                'description' => 'Mohamed Kaci has applied to your job: Digital Marketing Specialist',
                'type' => 'new_application',
                'is_read' => false,
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(12),
            ],
            [
                'employer_id' => $employers['Marketing Pro Agency'] ?? 3,
                'student_id' => null,
                'title' => 'New Application Received',
                'description' => 'Karim Hadj has applied to your job: Mobile App Developer',
                'type' => 'new_application',
                'is_read' => false,
                'created_at' => now()->subHours(18),
                'updated_at' => now()->subHours(18),
            ],
            
            // Student notifications for accepted applications
            [
                'student_id' => $students['Fatima Zerrouki'] ?? 2,
                'employer_id' => null,
                'title' => 'Application Status Updated',
                'description' => 'Congratulations! Your application for Mathematics Tutor has been accepted by Education First Academy',
                'type' => 'application_status',
                'is_read' => false,
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            [
                'student_id' => $students['Sofia Belkacem'] ?? 6,
                'employer_id' => null,
                'title' => 'Application Status Updated',
                'description' => 'Congratulations! Your application for Content Creator has been accepted by Media Corporation',
                'type' => 'application_status',
                'is_read' => false,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'student_id' => $students['Lila Mansouri'] ?? 8,
                'employer_id' => null,
                'title' => 'Application Status Updated',
                'description' => 'Congratulations! Your application for Accounting Assistant has been accepted by Finance Hub Solutions',
                'type' => 'application_status',
                'is_read' => false,
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(4),
            ],
            
            // Student notifications for rejected applications
            [
                'student_id' => $students['Amina Boudiaf'] ?? 4,
                'employer_id' => null,
                'title' => 'Application Status Updated',
                'description' => 'Your application for UI/UX Designer has been reviewed by Creative Design Studio. Unfortunately, it was not selected at this time.',
                'type' => 'application_status',
                'is_read' => false,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'student_id' => $students['Nadia Cherif'] ?? 10,
                'employer_id' => null,
                'title' => 'Application Status Updated',
                'description' => 'Your application for Medical Assistant has been reviewed by Healthcare Plus. Unfortunately, it was not selected at this time.',
                'type' => 'application_status',
                'is_read' => false,
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(8),
            ],
            
            // Student notifications for hiring
            [
                'student_id' => $students['Ahmed Benali'] ?? 1,
                'employer_id' => null,
                'title' => '🎉 Congratulations! You\'ve Been Hired!',
                'description' => 'TechCorp Solutions wants to hire you for your Web Development Services. Please contact them to discuss next steps.',
                'type' => 'hiring_notification',
                'is_read' => false,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'student_id' => $students['Fatima Zerrouki'] ?? 2,
                'employer_id' => null,
                'title' => '🎉 Congratulations! You\'ve Been Hired!',
                'description' => 'Education First Academy wants to hire you for your Mathematics Tutoring services. Please contact them to discuss next steps.',
                'type' => 'hiring_notification',
                'is_read' => false,
                'created_at' => now()->subHours(24),
                'updated_at' => now()->subHours(24),
            ],
            [
                'student_id' => $students['Amina Boudiaf'] ?? 4,
                'employer_id' => null,
                'title' => '🎉 Congratulations! You\'ve Been Hired!',
                'description' => 'Creative Design Studio wants to hire you for your Graphic Design Services. Please contact them to discuss next steps.',
                'type' => 'hiring_notification',
                'is_read' => false,
                'created_at' => now()->subHours(36),
                'updated_at' => now()->subHours(36),
            ],
        ];

        foreach ($notifications as $notification) {
            \DB::table('notifications')->insert($notification);
        }

        $this->command->info('Comprehensive notifications seeded successfully!');
    }
}
