<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            [
                'full_name' => 'Ahmed Benali',
                'email' => 'ahmed.benali1@student.com',
                'password' => Hash::make('password123'),
                'university' => 'USTHB - University of Science and Technology Houari Boumediene',
                'city' => 'Algiers',
                'phone' => '0550123456',
                'skills' => 'Web Development, React, Node.js, PHP, JavaScript, Python, SQL',
                'description' => 'Computer science student with 3 years of experience in web development. Passionate about creating innovative solutions and learning new technologies.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'full_name' => 'Fatima Zerrouki',
                'email' => 'fatima.zerrouki@student.com',
                'password' => Hash::make('password123'),
                'university' => 'University of Oran',
                'city' => 'Oran',
                'phone' => '0410123456',
                'skills' => 'French Translation, Content Writing, SEO, Social Media Management',
                'description' => 'Translation and linguistics student with 2 years of experience in French-English translation. Specializing in technical and creative content.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'full_name' => 'Mohamed Boudiaf',
                'email' => 'mohamed.boudiaf@student.com',
                'password' => Hash::make('password123'),
                'university' => 'University of Constantine',
                'city' => 'Constantine',
                'phone' => '0310123456',
                'skills' => 'Mathematics, Physics, Chemistry, Academic Tutoring',
                'description' => 'Mathematics major with 3 years of private tutoring experience. Specialized in algebra, geometry, and calculus.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'full_name' => 'Amina Khelifa',
                'email' => 'amina.khelifa@student.com',
                'password' => Hash::make('password123'),
                'university' => 'University of Blida',
                'city' => 'Blida',
                'phone' => '0250123456',
                'skills' => 'Photography, Photo Editing, Lightroom, Photoshop, Portrait Photography',
                'description' => 'Professional photographer specializing in portraits, events, and product photography. Experienced in both studio and outdoor photography.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Nadia Belkacem',
                'email' => 'nadia.belkacem@student.com',
                'password' => Hash::make('password123'),
                'university' => 'University of Tlemcen',
                'city' => 'Tlemcen',
                'phone' => '0430123456',
                'skills' => 'Data Entry, Excel, Word, Typing, Administrative Support, Virtual Assistant',
                'description' => 'Detail-oriented data entry specialist with excellent typing speed and accuracy. Providing administrative support services to businesses.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Rachid Messaoudi',
                'email' => 'rachid.messaoudi@student.com',
                'password' => Hash::make('password123'),
                'university' => 'University of Batna',
                'city' => 'Batna',
                'phone' => '0330123456',
                'skills' => 'Tutoring, Mathematics, Physics, Chemistry, Exam Preparation, Academic Support',
                'description' => 'Experienced tutor specializing in STEM subjects. Helping students excel in their studies and prepare for competitive exams.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Amina Djelloul',
                'email' => 'amina.djelloul@student.com',
                'password' => Hash::make('password123'),
                'university' => 'University of Béjaïa',
                'city' => 'Béjaïa',
                'phone' => '0340123456',
                'skills' => 'Marketing, Digital Marketing, Social Media, Email Marketing, Brand Strategy',
                'description' => 'Marketing specialist with expertise in digital marketing strategies. Helping businesses increase their online visibility and reach their target audience.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];

        DB::table('students')->insert($students);
    }
}
