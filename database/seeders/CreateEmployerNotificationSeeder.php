<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Notification;

class CreateEmployerNotificationSeeder extends Seeder
{
    public function run()
    {
        // Create notification for employer about the real application
        $notification = [
            'employer_id' => 1, // TechCorp Solutions
            'student_id' => 1, // Ahmed Benali
            'title' => 'New Application Received',
            'description' => 'Ahmed Benali has applied to your job: Full Stack Web Developer',
            'type' => 'new_application',
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now()
        ];

        Notification::create($notification);

        echo "Created notification for TechCorp Solutions about Ahmed Benali's application\n";
    }
}
