<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ComprehensiveEmployersSeeder extends Seeder
{
    public function run(): void
    {
        // Create diverse employers with complete company profiles
        $employers = [
            [
                'full_name' => 'Dr. Rachid Benzema',
                'email' => 'rachid.benzema@techcorp.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 111 222',
                'company' => 'TechCorp Solutions',
                'description' => 'Leading technology company specializing in web development and digital solutions. We help businesses transform their digital presence.',
                'city' => 'Algiers',
                'contact_person' => 'Dr. Rachid Benzema',
                'location' => 'Algiers, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Mrs. Samira Kadri',
                'email' => 'samira.kadri@educationfirst.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 333 444',
                'company' => 'Education First Academy',
                'description' => 'Premier educational institution providing quality tutoring and academic support services across all subjects.',
                'city' => 'Constantine',
                'contact_person' => 'Mrs. Samira Kadri',
                'location' => 'Constantine, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Mr. Karim Boulahrouz',
                'email' => 'karim.boulahrouz@marketpro.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 555 666',
                'company' => 'Marketing Pro Agency',
                'description' => 'Full-service digital marketing agency helping businesses grow their online presence and reach target audiences.',
                'city' => 'Oran',
                'contact_person' => 'Mr. Karim Boulahrouz',
                'location' => 'Oran, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Ms. Fatima Zohra',
                'email' => 'fatima.zohra@designstudio.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 777 888',
                'company' => 'Creative Design Studio',
                'description' => 'Award-winning design agency specializing in branding, web design, and creative visual solutions.',
                'city' => 'Blida',
                'contact_person' => 'Ms. Fatima Zohra',
                'location' => 'Blida, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Dr. Omar Belkacem',
                'email' => 'omar.belkacem@engineeringplus.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 999 000',
                'company' => 'Engineering Plus',
                'description' => 'Engineering consulting firm providing innovative solutions for industrial and infrastructure projects.',
                'city' => 'Tlemcen',
                'contact_person' => 'Dr. Omar Belkacem',
                'location' => 'Tlemcen, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Mrs. Amina Mansour',
                'email' => 'amina.mansour@financehub.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 123 456',
                'company' => 'Finance Hub Solutions',
                'description' => 'Financial services company offering accounting, bookkeeping, and financial consulting services.',
                'city' => 'Annaba',
                'contact_person' => 'Mrs. Amina Mansour',
                'location' => 'Annaba, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Mr. Yacine Derradji',
                'email' => 'yacine.derradji@mediacorp.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 234 567',
                'company' => 'Media Corporation',
                'description' => 'Media production company specializing in content creation, video production, and digital media services.',
                'city' => 'Sétif',
                'contact_person' => 'Mr. Yacine Derradji',
                'location' => 'Sétif, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'full_name' => 'Dr. Sofia Cherif',
                'email' => 'sofia.cherif@healthcareplus.com',
                'password' => Hash::make('password123'),
                'phone' => '+213 555 345 678',
                'company' => 'Healthcare Plus',
                'description' => 'Healthcare services provider offering medical consulting, health education, and wellness programs.',
                'city' => 'Béjaïa',
                'contact_person' => 'Dr. Sofia Cherif',
                'location' => 'Béjaïa, Algeria',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($employers as $employer) {
            \DB::table('employers')->insert($employer);
        }

        $this->command->info('Comprehensive employers seeded successfully!');
    }
}
