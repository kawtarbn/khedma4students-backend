<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployersWithPasswordConstraintsSeeder extends Seeder
{
    public function run(): void
    {
        $employers = [
            // Weak password (for testing validation)
            [
                'full_name' => 'Dr. Rachid Weak',
                'email' => 'rachid.weak@techcorp.com',
                'password' => Hash::make('123'), // Too short
                'phone' => '+213 555 111 222',
                'company' => 'TechCorp Solutions',
                'description' => 'Leading technology company with weak password for testing',
                'city' => 'Algiers',
                'contact_person' => 'Dr. Rachid Weak',
                'location' => 'Algiers, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Strong password
            [
                'full_name' => 'Mrs. Samira Strong',
                'email' => 'samira.strong@educationfirst.com',
                'password' => Hash::make('Str0ngP@ssw0rd123!'),
                'phone' => '+213 555 333 444',
                'company' => 'Education First Academy',
                'description' => 'Premier educational institution with strong password security',
                'city' => 'Constantine',
                'contact_person' => 'Mrs. Samira Strong',
                'location' => 'Constantine, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Special characters password
            [
                'full_name' => 'Mr. Karim Special',
                'email' => 'karim.special@marketpro.com',
                'password' => Hash::make('P@ssw0rd#$%^&*()'),
                'phone' => '+213 555 555 666',
                'company' => 'Marketing Pro Agency',
                'description' => 'Full-service digital marketing with special character password',
                'city' => 'Oran',
                'contact_person' => 'Mr. Karim Special',
                'location' => 'Oran, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Numbers only password
            [
                'full_name' => 'Ms. Fatima Numbers',
                'email' => 'fatima.numbers@designstudio.com',
                'password' => Hash::make('1234567890'),
                'phone' => '+213 555 777 888',
                'company' => 'Creative Design Studio',
                'description' => 'Award-winning design agency with numbers-only password',
                'city' => 'Blida',
                'contact_person' => 'Ms. Fatima Numbers',
                'location' => 'Blida, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Mixed case password
            [
                'full_name' => 'Dr. Omar Mixed',
                'email' => 'omar.mixed@engineeringplus.com',
                'password' => Hash::make('MiXeD CaSe P@ss123'),
                'phone' => '+213 555 999 000',
                'company' => 'Engineering Plus',
                'description' => 'Engineering consulting firm with mixed case password',
                'city' => 'Tlemcen',
                'contact_person' => 'Dr. Omar Mixed',
                'location' => 'Tlemcen, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Very long password
            [
                'full_name' => 'Mrs. Amina Long',
                'email' => 'amina.long@financehub.com',
                'password' => Hash::make('ThisIsAVeryLongPasswordThatExceedsNormalLimits123456789!@#$'),
                'phone' => '+213 555 123 456',
                'company' => 'Finance Hub Solutions',
                'description' => 'Financial services company with very long password',
                'city' => 'Annaba',
                'contact_person' => 'Mrs. Amina Long',
                'location' => 'Annaba, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // SQL injection attempt password
            [
                'full_name' => 'Mr. Yacine SQL',
                'email' => 'yacine.sql@mediacorp.com',
                'password' => Hash::make("'; DROP TABLE students; --"),
                'phone' => '+213 555 234 567',
                'company' => 'Media Corporation',
                'description' => 'Media production company - testing SQL injection resistance',
                'city' => 'Sétif',
                'contact_person' => 'Mr. Yacine SQL',
                'location' => 'Sétif, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($employers as $employer) {
            \DB::table('employers')->insert($employer);
        }

        $this->command->info('Employers with password constraints seeded successfully!');
    }
}
