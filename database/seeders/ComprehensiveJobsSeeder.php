<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ComprehensiveJobsSeeder extends Seeder
{
    public function run(): void
    {
        // Get employers for foreign key relationships
        $employers = \DB::table('employers')->pluck('id', 'company')->toArray();
        
        // Create diverse jobs across different categories
        $jobs = [
            [
                'employer_id' => $employers['TechCorp Solutions'] ?? 1,
                'title' => 'Full Stack Web Developer',
                'category' => 'Technology',
                'description' => 'We are looking for an experienced Full Stack Web Developer to join our team. The ideal candidate will have strong experience with React, Node.js, and modern web technologies. You will work on exciting projects for various clients and help build scalable web applications.',
                'city' => 'Algiers',
                'pay_range' => '30,000-50,000 DZD/month',
                'status' => 'active',
                'contactEmail' => 'rachid.benzema@techcorp.com',
                'contactPhone' => '+213 555 111 222',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employer_id' => $employers['Education First Academy'] ?? 2,
                'title' => 'Mathematics Tutor',
                'category' => 'Education & Tutoring',
                'description' => 'Seeking a qualified Mathematics Tutor to help students with algebra, calculus, and statistics. The tutor will work with high school and university students, providing personalized instruction and homework help.',
                'city' => 'Constantine',
                'pay_range' => '15,000-25,000 DZD/month',
                'status' => 'active',
                'contactEmail' => 'samira.kadri@educationfirst.com',
                'contactPhone' => '+213 555 333 444',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employer_id' => $employers['Marketing Pro Agency'] ?? 3,
                'title' => 'Digital Marketing Specialist',
                'category' => 'Digital & Freelance',
                'description' => 'Looking for a Digital Marketing Specialist to manage social media campaigns, SEO optimization, and content marketing. Experience with Google Analytics and social media advertising platforms required.',
                'city' => 'Oran',
                'pay_range' => '20,000-35,000 DZD/month',
                'status' => 'active',
                'contactEmail' => 'karim.boulahrouz@marketpro.com',
                'contactPhone' => '+213 555 555 666',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employer_id' => $employers['Creative Design Studio'] ?? 4,
                'title' => 'UI/UX Designer',
                'category' => 'Digital & Freelance',
                'description' => 'We need a creative UI/UX Designer to design modern, user-friendly interfaces for web and mobile applications. Proficiency in Figma, Adobe XD, and design principles required.',
                'city' => 'Blida',
                'pay_range' => '25,000-40,000 DZD/month',
                'status' => 'active',
                'contactEmail' => 'fatima.zohra@designstudio.com',
                'contactPhone' => '+213 555 777 888',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employer_id' => $employers['Engineering Plus'] ?? 5,
                'title' => 'Junior Mechanical Engineer',
                'category' => 'Engineering',
                'description' => 'Seeking a Junior Mechanical Engineer to assist with design projects, technical documentation, and client consultations. CAD software proficiency and engineering degree required.',
                'city' => 'Tlemcen',
                'pay_range' => '35,000-55,000 DZD/month',
                'status' => 'active',
                'contactEmail' => 'omar.belkacem@engineeringplus.com',
                'contactPhone' => '+213 555 999 000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employer_id' => $employers['Finance Hub Solutions'] ?? 6,
                'title' => 'Accounting Assistant',
                'category' => 'Finance & Accounting',
                'description' => 'Looking for an Accounting Assistant to help with bookkeeping, financial reporting, and client account management. Experience with accounting software and attention to detail required.',
                'city' => 'Annaba',
                'pay_range' => '18,000-30,000 DZD/month',
                'status' => 'active',
                'contactEmail' => 'amina.mansour@financehub.com',
                'contactPhone' => '+213 555 123 456',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employer_id' => $employers['Media Corporation'] ?? 7,
                'title' => 'Content Creator',
                'category' => 'Digital & Freelance',
                'description' => 'We need a creative Content Creator to produce engaging content for social media, blogs, and video platforms. Strong writing skills and social media experience required.',
                'city' => 'Sétif',
                'pay_range' => '15,000-28,000 DZD/month',
                'status' => 'active',
                'contactEmail' => 'yacine.derradji@mediacorp.com',
                'contactPhone' => '+213 555 234 567',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employer_id' => $employers['Healthcare Plus'] ?? 8,
                'title' => 'Medical Assistant',
                'category' => 'Health & Wellness',
                'description' => 'Seeking a Medical Assistant to help with patient care, administrative tasks, and medical record management. Medical background or certification preferred.',
                'city' => 'Béjaïa',
                'pay_range' => '22,000-38,000 DZD/month',
                'status' => 'active',
                'contactEmail' => 'sofia.cherif@healthcareplus.com',
                'contactPhone' => '+213 555 345 678',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employer_id' => $employers['TechCorp Solutions'] ?? 1,
                'title' => 'Mobile App Developer',
                'category' => 'Technology',
                'description' => 'Looking for an experienced Mobile App Developer to create iOS and Android applications. React Native or Flutter experience required. Portfolio of published apps preferred.',
                'city' => 'Algiers',
                'pay_range' => '35,000-60,000 DZD/month',
                'status' => 'active',
                'contactEmail' => 'rachid.benzema@techcorp.com',
                'contactPhone' => '+213 555 111 222',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'employer_id' => $employers['Education First Academy'] ?? 2,
                'title' => 'English Language Tutor',
                'category' => 'Education & Tutoring',
                'description' => 'Seeking an English Language Tutor to help students improve their reading, writing, and speaking skills. Experience with TOEFL/IELTS preparation a plus.',
                'city' => 'Constantine',
                'pay_range' => '12,000-20,000 DZD/month',
                'status' => 'active',
                'contactEmail' => 'samira.kadri@educationfirst.com',
                'contactPhone' => '+213 555 333 444',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($jobs as $job) {
            \DB::table('jobs')->insert($job);
        }

        $this->command->info('Comprehensive jobs seeded successfully!');
    }
}
