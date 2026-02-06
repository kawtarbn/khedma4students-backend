<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ComprehensiveStudentsSeeder extends Seeder
{
    public function run(): void
    {
        // Create diverse students with complete profiles
        $students = [
            [
                'full_name' => 'Ahmed Benali',
                'email' => 'ahmed.benali@email.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 123 456',
                'university' => 'University of Algiers',
                'city' => 'Algiers',
                'skills' => 'React, Node.js, JavaScript, PHP, MySQL',
                'description' => 'Passionate web developer with experience in full-stack development.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Fatima Zerrouki',
                'email' => 'fatima.zerrouki@email.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 234 567',
                'university' => 'University of Constantine',
                'city' => 'Constantine',
                'skills' => 'Calculus, Algebra, Statistics, Python',
                'description' => 'Mathematics tutor with strong analytical skills.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Mohamed Kaci',
                'email' => 'mohamed.kaci@email.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 345 678',
                'university' => 'University of Oran',
                'city' => 'Oran',
                'skills' => 'Marketing, Management, Finance, Excel',
                'description' => 'Business student with leadership experience.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Amina Boudiaf',
                'email' => 'amina.boudiaf@email.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 456 789',
                'university' => 'University of Blida',
                'city' => 'Blida',
                'skills' => 'Photoshop, Illustrator, Figma, UI/UX Design',
                'description' => 'Creative graphic designer with modern design skills.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Yacine Meziane',
                'email' => 'yacine.meziane@email.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 567 890',
                'university' => 'University of Tlemcen',
                'city' => 'Tlemcen',
                'skills' => 'Circuit Design, Arduino, PLC, AutoCAD',
                'description' => 'Engineering student with practical project experience.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Sofia Belkacem',
                'email' => 'sofia.belkacem@email.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 678 901',
                'university' => 'University of Annaba',
                'city' => 'Annaba',
                'skills' => 'Writing, Translation, Content Creation, Social Media',
                'description' => 'Literature student with excellent communication skills.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Karim Hadj',
                'email' => 'karim.hadj@email.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 789 012',
                'university' => 'University of Sétif',
                'city' => 'Sétif',
                'skills' => 'Digital Marketing, SEO, Social Media, Analytics',
                'description' => 'Marketing specialist with digital expertise.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Lila Mansouri',
                'email' => 'lila.mansouri@email.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 890 123',
                'university' => 'University of Béjaïa',
                'city' => 'Béjaïa',
                'skills' => 'Bookkeeping, Financial Analysis, Excel, QuickBooks',
                'description' => 'Accounting student with attention to detail.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Omar Taleb',
                'email' => 'omar.taleb@email.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 901 234',
                'university' => 'University of Batna',
                'city' => 'Batna',
                'skills' => 'CAD, SolidWorks, MATLAB, Thermodynamics',
                'description' => 'Mechanical engineering student with design experience.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Nadia Cherif',
                'email' => 'nadia.cherif@email.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 012 345',
                'university' => 'University of Tizi Ouzou',
                'city' => 'Tizi Ouzou',
                'skills' => 'Lab Research, Data Analysis, Biology, Chemistry',
                'description' => 'Biology student with research experience.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($students as $student) {
            \DB::table('students')->insert($student);
        }

        $this->command->info('Comprehensive students seeded successfully!');
    }
}
