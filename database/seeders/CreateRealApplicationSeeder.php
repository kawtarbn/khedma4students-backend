<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Application;
use App\Models\Student;
use App\Models\Job;
use App\Models\Employer;

class CreateRealApplicationSeeder extends Seeder
{
    public function run()
    {
        // Get first student and employer
        $student = Student::first(); // Ahmed Benali (ID: 1)
        $employer = Employer::first(); // TechCorp Solutions (ID: 1)
        $job = Job::where('employer_id', $employer->id)->first(); // First job by TechCorp

        if ($student && $employer && $job) {
            // Create a real application linking student to employer's job
            $application = [
                'student_id' => $student->id,
                'job_id' => $job->id,
                'employer_id' => $employer->id,
                'fullname' => $student->full_name,
                'email' => $student->email,
                'phone' => $student->phone,
                'experience' => 'I am a passionate web developer with 2 years of experience in React, Laravel, and modern JavaScript frameworks. I have built several personal projects and contributed to open source projects. I am eager to learn and contribute to a professional team.',
                'message' => 'I am very interested in this Full Stack Web Developer position at TechCorp Solutions. My experience with React and Laravel aligns perfectly with your requirements, and I am excited about the opportunity to work on various web applications with your team.',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ];

            Application::create($application);

            echo "Created application: {$student->full_name} → {$job->title} at {$employer->company}\n";
        } else {
            echo "Missing data to create application\n";
        }
    }
}
