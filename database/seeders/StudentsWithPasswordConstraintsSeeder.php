<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StudentsWithPasswordConstraintsSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            // Weak password (for testing validation)
            [
                'full_name' => 'Ahmed Benali',
                'email' => 'ahmed.weak@example.com',
                'password' => Hash::make('123'), // Too short
                'university' => 'University of Algiers',
                'city' => 'Algiers',
                'phone' => '+213 555 111 222',
                'skills' => 'JavaScript, React',
                'description' => 'Student with weak password for testing validation',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Strong password
            [
                'full_name' => 'Fatima Zohra',
                'email' => 'fatima.strong@example.com',
                'password' => Hash::make('StrongP@ssw0rd123!'),
                'university' => 'USTHB',
                'city' => 'Algiers',
                'phone' => '+213 555 333 444',
                'skills' => 'Python, Django, Machine Learning',
                'description' => 'Computer Science student with strong password',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Special characters password
            [
                'full_name' => 'Mohamed Cherif',
                'email' => 'mohamed.special@example.com',
                'password' => Hash::make('P@ssw0rd#$%^&*()'),
                'university' => 'University of Constantine',
                'city' => 'Constantine',
                'phone' => '+213 555 555 666',
                'skills' => 'Java, Spring Boot, MySQL',
                'description' => 'Student with special characters in password',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Numbers only password
            [
                'full_name' => 'Amina Mansour',
                'email' => 'amina.numbers@example.com',
                'password' => Hash::make('1234567890'),
                'university' => 'University of Oran',
                'city' => 'Oran',
                'phone' => '+213 555 777 888',
                'skills' => 'PHP, Laravel, Vue.js',
                'description' => 'Student with numbers-only password',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Mixed case password
            [
                'full_name' => 'Yacine Boulahrouz',
                'email' => 'yacine.mixed@example.com',
                'password' => Hash::make('MiXeD CaSe P@ss123'),
                'university' => 'University of Tlemcen',
                'city' => 'Tlemcen',
                'phone' => '+213 555 999 000',
                'skills' => 'C++, .NET, Azure',
                'description' => 'Student with mixed case password',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($students as $student) {
            \DB::table('students')->insert($student);
        }

        $this->command->info('Students with password constraints seeded successfully!');
    }
}
