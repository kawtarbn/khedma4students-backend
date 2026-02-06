<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ComprehensiveServicesSeeder extends Seeder
{
    public function run(): void
    {
        // Get students for foreign key relationships
        $students = \DB::table('students')->pluck('id', 'full_name')->toArray();
        
        // Create diverse services offered by students (stored in 'requests' table)
        $services = [
            [
                'student_id' => $students['Ahmed Benali'] ?? 1,
                'title' => 'Web Development Services',
                'category' => 'Digital & Freelance',
                'description' => 'Professional web development services including React, Vue.js, Node.js, and PHP development. I can build responsive websites, web applications, and e-commerce platforms. Experience with modern frameworks and best practices.',
                'city' => 'Algiers',
                'pay' => '2,000-5,000 DZD/project',
                'availability' => 'Flexible - Weekdays & Weekends',
                'contactEmail' => 'ahmed.benali@email.com',
                'contactPhone' => '+213 555 123 456',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => $students['Fatima Zerrouki'] ?? 2,
                'title' => 'Mathematics Tutoring',
                'category' => 'Education & Tutoring',
                'description' => 'Expert mathematics tutoring for high school and university students. Specialized in calculus, algebra, statistics, and exam preparation. Patient teaching approach with proven results.',
                'city' => 'Constantine',
                'pay' => '1,500 DZD/hour',
                'availability' => 'Evenings & Weekends',
                'contactEmail' => 'fatima.zerrouki@email.com',
                'contactPhone' => '+213 555 234 567',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => $students['Mohamed Kaci'] ?? 3,
                'title' => 'Business Consulting',
                'category' => 'Business & Consulting',
                'description' => 'Business consulting services for startups and small businesses. Expertise in market research, business planning, financial analysis, and growth strategies. MBA-level knowledge.',
                'city' => 'Oran',
                'pay' => '3,000-7,000 DZD/project',
                'availability' => 'Flexible Schedule',
                'contactEmail' => 'mohamed.kaci@email.com',
                'contactPhone' => '+213 555 345 678',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => $students['Amina Boudiaf'] ?? 4,
                'title' => 'Graphic Design Services',
                'category' => 'Digital & Freelance',
                'description' => 'Creative graphic design services including logo design, branding, web graphics, and print materials. Proficient in Adobe Creative Suite, Figma, and modern design tools.',
                'city' => 'Blida',
                'pay' => '1,000-3,000 DZD/design',
                'availability' => 'Part-time - Remote',
                'contactEmail' => 'amina.boudiaf@email.com',
                'contactPhone' => '+213 555 456 789',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => $students['Yacine Meziane'] ?? 5,
                'title' => 'Electrical Engineering Tutor',
                'category' => 'Education & Tutoring',
                'description' => 'Electrical engineering tutoring for university students. Topics include circuit analysis, electronics, power systems, and control systems. Practical approach with real-world examples.',
                'city' => 'Tlemcen',
                'pay' => '2,000 DZD/hour',
                'availability' => 'Weekends & Evenings',
                'contactEmail' => 'yacine.meziane@email.com',
                'contactPhone' => '+213 555 567 890',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => $students['Sofia Belkacem'] ?? 6,
                'title' => 'Content Writing & Translation',
                'category' => 'Digital & Freelance',
                'description' => 'Professional content writing and translation services (English-Arabic-French). Blog posts, articles, web content, and creative writing. SEO optimization included.',
                'city' => 'Annaba',
                'pay' => '500-1,500 DZD/article',
                'availability' => 'Remote Flexible',
                'contactEmail' => 'sofia.belkacem@email.com',
                'contactPhone' => '+213 555 678 901',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => $students['Karim Hadj'] ?? 7,
                'title' => 'Digital Marketing Services',
                'category' => 'Digital & Freelance',
                'description' => 'Complete digital marketing services including social media management, SEO optimization, email marketing, and online advertising. Google Analytics certified.',
                'city' => 'Sétif',
                'pay' => '2,500-6,000 DZD/month',
                'availability' => 'Full-time or Part-time',
                'contactEmail' => 'karim.hadj@email.com',
                'contactPhone' => '+213 555 789 012',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => $students['Lila Mansouri'] ?? 8,
                'title' => 'Accounting & Bookkeeping',
                'category' => 'Finance & Business',
                'description' => 'Professional accounting and bookkeeping services for small businesses. Financial statements, tax preparation, payroll management, and financial consulting.',
                'city' => 'Béjaïa',
                'pay' => '1,800-4,000 DZD/project',
                'availability' => 'Flexible Hours',
                'contactEmail' => 'lila.mansouri@email.com',
                'contactPhone' => '+213 555 890 123',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => $students['Omar Taleb'] ?? 9,
                'title' => 'CAD Design & Drafting',
                'category' => 'Engineering & Technical',
                'description' => 'Professional CAD design and drafting services for mechanical and architectural projects. Proficient in AutoCAD, SolidWorks, and 3D modeling.',
                'city' => 'Batna',
                'pay' => '3,000-8,000 DZD/project',
                'availability' => 'Remote & On-site',
                'contactEmail' => 'omar.taleb@email.com',
                'contactPhone' => '+213 555 901 234',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => $students['Nadia Cherif'] ?? 10,
                'title' => 'Science Tutoring',
                'category' => 'Education & Tutoring',
                'description' => 'Science tutoring for high school students in biology, chemistry, and physics. Laboratory experience and exam preparation. Interactive teaching methods.',
                'city' => 'Tizi Ouzou',
                'pay' => '1,200 DZD/hour',
                'availability' => 'After School Hours',
                'contactEmail' => 'nadia.cherif@email.com',
                'contactPhone' => '+213 555 012 345',
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($services as $service) {
            \DB::table('requests')->insert($service);
        }

        $this->command->info('Comprehensive services (requests) seeded successfully!');
    }
}
