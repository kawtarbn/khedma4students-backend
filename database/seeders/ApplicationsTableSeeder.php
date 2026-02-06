<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Application;
use App\Models\Student;
use App\Models\Job;
use App\Models\Employer;

class ApplicationsTableSeeder extends Seeder
{
    public function run()
    {
        // Get related models for foreign key relationships
        $students = Student::all();
        $jobs = Job::all();
        $employers = Employer::all();
        
        $applications = [
            [
                'student_id' => $students[0]->id,
                'job_id' => $jobs[0]->id,
                'employer_id' => $jobs[0]->employer_id,
                'fullname' => $students[0]->full_name,
                'email' => $students[0]->email,
                'phone' => $students[0]->phone,
                'message' => 'I am very interested in this web developer internship. I have experience with React and Laravel, and I am eager to learn and contribute to your team.',
                'experience' => '2 years of web development experience with React, JavaScript, and PHP. Built several personal projects and contributed to open source.',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => $students[1]->id,
                'job_id' => $jobs[1]->id,
                'employer_id' => $jobs[1]->employer_id,
                'fullname' => $students[1]->full_name,
                'email' => $students[1]->email,
                'phone' => $students[1]->phone,
                'message' => 'I have been teaching mathematics for 3 years and I would love to help students improve their grades. I am patient and good at explaining complex concepts.',
                'experience' => '3 years of private tutoring experience. Specialized in algebra, geometry, and calculus. Helped 20+ students improve their grades.',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => $students[2]->id,
                'job_id' => $jobs[2]->id,
                'employer_id' => $jobs[2]->employer_id,
                'fullname' => $students[2]->full_name,
                'email' => $students[2]->email,
                'phone' => $students[2]->phone,
                'message' => 'I have strong writing skills and experience with social media management. I can create engaging content and manage multiple platforms effectively.',
                'experience' => '4 years of content creation experience. Managed social media accounts with 10k+ followers. Written blog posts for various companies.',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => $students[3]->id,
                'job_id' => $jobs[3]->id,
                'employer_id' => $jobs[3]->employer_id,
                'fullname' => $students[3]->full_name,
                'email' => $students[3]->email,
                'phone' => $students[3]->phone,
                'message' => 'I am available for babysitting in Tlemcen area. I have experience with children of all ages and can provide references.',
                'experience' => '2 years of babysitting experience. Worked with children aged 2-12. Certified in first aid.',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => $students[4]->id,
                'job_id' => $jobs[4]->id,
                'employer_id' => $jobs[4]->employer_id,
                'fullname' => $students[4]->full_name,
                'email' => $students[4]->email,
                'phone' => $students[4]->phone,
                'message' => 'I would be happy to help with grocery shopping and errands. I am reliable and know Algiers area well.',
                'experience' => '1 year of personal assistant experience. Help elderly neighbors with shopping and errands. Very organized and trustworthy.',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => $students[0]->id,
                'job_id' => $jobs[5]->id,
                'employer_id' => $jobs[5]->employer_id,
                'fullname' => $students[0]->full_name,
                'email' => $students[0]->email,
                'phone' => $students[0]->phone,
                'message' => 'I am interested in this research assistant position. I have strong analytical skills and attention to detail.',
                'experience' => 'Excellent academic research skills. Published research papers. Proficient in data analysis and report writing.',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => $students[1]->id,
                'job_id' => $jobs[6]->id,
                'employer_id' => $jobs[6]->employer_id,
                'fullname' => $students[1]->full_name,
                'email' => $students[1]->email,
                'phone' => $students[1]->phone,
                'message' => 'I have experience with logo design and branding. I can create professional designs that match your company vision.',
                'experience' => '5 years of graphic design experience. Proficient in Adobe Creative Suite, Figma, and Canva. Portfolio of 50+ projects.',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'student_id' => $students[2]->id,
                'job_id' => $jobs[7]->id,
                'employer_id' => $jobs[7]->employer_id,
                'fullname' => $students[2]->full_name,
                'email' => $students[2]->email,
                'phone' => $students[2]->phone,
                'message' => 'I love working with children and have extensive experience with childcare. I am responsible and create fun, educational activities.',
                'experience' => '4 years of childcare experience. Worked with ages 6 months to 12 years. CPR and first aid certified.',
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($applications as $application) {
            Application::create($application);
        }
    }
}
