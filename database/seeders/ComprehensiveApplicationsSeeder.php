<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ComprehensiveApplicationsSeeder extends Seeder
{
    public function run(): void
    {
        // Get students, employers, and jobs for relationships
        $students = \DB::table('students')->pluck('id', 'full_name')->toArray();
        $employers = \DB::table('employers')->pluck('id', 'company')->toArray();
        $jobs = \DB::table('jobs')->pluck('id', 'title')->toArray();
        
        // Create realistic applications with different statuses and different students
        $applications = [
            [
                'student_id' => $students['Ahmed Benali'] ?? 1,
                'job_id' => $jobs['Full Stack Web Developer'] ?? 1,
                'employer_id' => $employers['TechCorp Solutions'] ?? 1,
                'fullname' => 'Ahmed Benali',
                'email' => 'ahmed.benali@email.com',
                'phone' => '+213 555 123 456',
                'experience' => '3 years of full-stack development experience with React, Node.js, PHP, and MySQL. Built multiple web applications including e-commerce platforms and management systems. Strong understanding of modern web technologies and best practices.',
                'status' => 'pending',
                'message' => 'I am very interested in this position and believe my skills match your requirements perfectly.',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],
            [
                'student_id' => $students['Fatima Zerrouki'] ?? 2,
                'job_id' => $jobs['Mathematics Tutor'] ?? 2,
                'employer_id' => $employers['Education First Academy'] ?? 2,
                'fullname' => 'Fatima Zerrouki',
                'email' => 'fatima.zerrouki@email.com',
                'phone' => '+213 555 234 567',
                'experience' => 'Mathematics major with 2 years of tutoring experience. Specialized in calculus, algebra, and statistics. Helped over 50 students improve their grades and exam scores.',
                'status' => 'accepted',
                'message' => 'I am passionate about education and would love to contribute to your academy.',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(3),
            ],
            [
                'student_id' => $students['Mohamed Kaci'] ?? 3,
                'job_id' => $jobs['Digital Marketing Specialist'] ?? 3,
                'employer_id' => $employers['Marketing Pro Agency'] ?? 3,
                'fullname' => 'Mohamed Kaci',
                'email' => 'mohamed.kaci@email.com',
                'phone' => '+213 555 345 678',
                'experience' => 'Business administration student with digital marketing internship experience. Managed social media campaigns for local businesses with proven results in engagement and conversion.',
                'status' => 'pending',
                'message' => 'I am excited about the opportunity to apply my marketing skills in a professional setting.',
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],
            [
                'student_id' => $students['Amina Boudiaf'] ?? 4,
                'job_id' => $jobs['UI/UX Designer'] ?? 4,
                'employer_id' => $employers['Creative Design Studio'] ?? 4,
                'fullname' => 'Amina Boudiaf',
                'email' => 'amina.boudiaf@email.com',
                'phone' => '+213 555 456 789',
                'experience' => 'Graphic design student with portfolio of UI/UX projects. Proficient in Figma, Adobe XD, and design principles. Created user interfaces for mobile apps and websites.',
                'status' => 'rejected',
                'message' => 'I believe my creative skills and design experience would be valuable for your team.',
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(6),
            ],
            [
                'student_id' => $students['Yacine Meziane'] ?? 5,
                'job_id' => $jobs['Junior Mechanical Engineer'] ?? 5,
                'employer_id' => $employers['Engineering Plus'] ?? 5,
                'fullname' => 'Yacine Meziane',
                'email' => 'yacine.meziane@email.com',
                'phone' => '+213 555 567 890',
                'experience' => 'Final year electrical engineering student with strong foundation in mechanical systems. Completed multiple projects involving CAD design and prototype development. Internship experience in manufacturing.',
                'status' => 'pending',
                'message' => 'I am eager to apply my engineering knowledge in a practical environment.',
                'created_at' => now()->subHours(12),
                'updated_at' => now()->subHours(12),
            ],
            [
                'student_id' => $students['Sofia Belkacem'] ?? 6,
                'job_id' => $jobs['Content Creator'] ?? 7,
                'employer_id' => $employers['Media Corporation'] ?? 7,
                'fullname' => 'Sofia Belkacem',
                'email' => 'sofia.belkacem@email.com',
                'phone' => '+213 555 678 901',
                'experience' => 'English literature student with strong writing skills. Created content for university blogs and social media. Experience in SEO optimization and content strategy.',
                'status' => 'accepted',
                'message' => 'I would love to contribute my writing and content creation skills to your media company.',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(2),
            ],
            [
                'student_id' => $students['Karim Hadj'] ?? 7,
                'job_id' => $jobs['Mobile App Developer'] ?? 9,
                'employer_id' => $employers['TechCorp Solutions'] ?? 1,
                'fullname' => 'Karim Hadj',
                'email' => 'karim.hadj@email.com',
                'phone' => '+213 555 789 012',
                'experience' => 'Marketing student with mobile app development experience. Built 3 apps using React Native and published them on app stores. Understanding of mobile UX principles.',
                'status' => 'pending',
                'message' => 'I am excited about the opportunity to develop mobile applications for your company.',
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],
            [
                'student_id' => $students['Lila Mansouri'] ?? 8,
                'job_id' => $jobs['Accounting Assistant'] ?? 6,
                'employer_id' => $employers['Finance Hub Solutions'] ?? 6,
                'fullname' => 'Lila Mansouri',
                'email' => 'lila.mansouri@email.com',
                'phone' => '+213 555 890 123',
                'experience' => 'Accounting student with experience in bookkeeping and financial reporting. Proficient in QuickBooks and Excel. Completed accounting internship at local firm.',
                'status' => 'accepted',
                'message' => 'I am detail-oriented and would be a valuable addition to your finance team.',
                'created_at' => now()->subDays(4),
                'updated_at' => now()->subDays(3),
            ],
            [
                'student_id' => $students['Omar Taleb'] ?? 9,
                'job_id' => $jobs['English Language Tutor'] ?? 10,
                'employer_id' => $employers['Education First Academy'] ?? 2,
                'fullname' => 'Omar Taleb',
                'email' => 'omar.taleb@email.com',
                'phone' => '+213 555 901 234',
                'experience' => 'Engineering student with excellent English skills. TOEFL certified with experience tutoring international students. Can teach technical and business English.',
                'status' => 'pending',
                'message' => 'I am passionate about education and helping others learn English.',
                'created_at' => now()->subHours(18),
                'updated_at' => now()->subHours(18),
            ],
            [
                'student_id' => $students['Nadia Cherif'] ?? 10,
                'job_id' => $jobs['Medical Assistant'] ?? 8,
                'employer_id' => $employers['Healthcare Plus'] ?? 8,
                'fullname' => 'Nadia Cherif',
                'email' => 'nadia.cherif@email.com',
                'phone' => '+213 555 012 345',
                'experience' => 'Biology student with medical assistant certification. Volunteer experience at local clinic. Knowledge of medical terminology and patient care procedures.',
                'status' => 'rejected',
                'message' => 'I am dedicated to healthcare and would be committed to supporting your medical team.',
                'created_at' => now()->subDays(8),
                'updated_at' => now()->subDays(7),
            ],
        ];

        foreach ($applications as $application) {
            \DB::table('applications')->insert($application);
        }

        $this->command->info('Comprehensive applications seeded successfully!');
    }
}
