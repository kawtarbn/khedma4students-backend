<?php

namespace Database\Seeders;

use App\Models\Notification;
use Illuminate\Database\Seeder;

class NotificationsTableSeeder extends Seeder
{
    public function run(): void
    {
        $samples = [
            [
                'student_id' => 1,
                'employer_id' => null,
                'type' => 'application_accepted',
                'title' => 'Application Accepted',
                'description' => 'Your application for "Café Assistant" has been accepted!',
                'is_read' => false,
            ],
            [
                'student_id' => 1,
                'employer_id' => null,
                'type' => 'new_message',
                'title' => 'New Message',
                'description' => 'Pizza Express replied to your inquiry about delivery timing',
                'is_read' => false,
            ],
            [
                'student_id' => 1,
                'employer_id' => null,
                'type' => 'rating_reminder',
                'title' => 'Rating Reminder',
                'description' => "Don't forget to rate your experience with Leila Boudiaf",
                'is_read' => true,
            ],
            [
                'student_id' => null,
                'employer_id' => 1,
                'type' => 'application_received',
                'title' => 'New Application Received',
                'description' => 'Amina Kaci sent you a message about graphic design project',
                'is_read' => false,
            ],
            [
                'student_id' => null,
                'employer_id' => 1,
                'type' => 'new_rating',
                'title' => 'New Rating Received',
                'description' => 'You received a 5-star rating from Youcef Meziane',
                'is_read' => true,
            ],
            [
                'student_id' => null,
                'employer_id' => 1,
                'type' => 'job_expiring',
                'title' => 'Job Expiring Soon',
                'description' => 'Your "Web Developer Available" post will expire in 2 days',
                'is_read' => true,
            ],
        ];

        foreach ($samples as $data) {
            Notification::create(array_merge($data, [
                'created_at' => now()->subDays(rand(1, 13)),
            ]));
        }
    }
}
