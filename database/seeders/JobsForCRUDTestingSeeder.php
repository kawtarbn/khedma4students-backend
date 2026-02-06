<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Employer;

class JobsForCRUDTestingSeeder extends Seeder
{
    public function run(): void
    {
        // Get employers to associate with jobs
        $employers = \DB::table('employers')->pluck('id')->toArray();
        
        if (empty($employers)) {
            $this->command->error('No employers found. Please run employers seeder first.');
            return;
        }

        $jobs = [
            // Active job with full details
            [
                'title' => 'Senior React Developer',
                'description' => 'We are looking for an experienced React developer to join our team. You will work on cutting-edge web applications using React, Redux, and modern JavaScript technologies.',
                'category' => 'Technology',
                'city' => 'Algiers',
                'pay_range' => '80000-120000 DZD/month',
                'contactEmail' => 'jobs@techcorp.com',
                'contactPhone' => '+213 555 111 222',
                'employer_id' => $employers[0] ?? 1,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Part-time job
            [
                'title' => 'Content Writer Intern',
                'description' => 'Looking for a creative content writer to create engaging blog posts and social media content. Perfect for students looking to gain experience.',
                'category' => 'Marketing',
                'city' => 'Remote',
                'pay_range' => '20000-30000 DZD/month',
                'contactEmail' => 'interns@educationfirst.com',
                'contactPhone' => '+213 555 333 444',
                'employer_id' => $employers[1] ?? 2,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Freelance project
            [
                'title' => 'Mobile App UI/UX Designer',
                'description' => 'Need a talented designer to create modern UI/UX for a mobile application. Portfolio required.',
                'category' => 'Design',
                'city' => 'Remote',
                'pay_range' => '50000-80000 DZD/project',
                'contactEmail' => 'design@marketpro.com',
                'contactPhone' => '+213 555 555 666',
                'employer_id' => $employers[2] ?? 3,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Closed job (for testing filters)
            [
                'title' => 'Junior Java Developer',
                'description' => 'Entry-level Java developer position. Recent graduates encouraged to apply.',
                'category' => 'Technology',
                'city' => 'Constantine',
                'pay_range' => '40000-60000 DZD/month',
                'contactEmail' => 'careers@engineeringplus.com',
                'contactPhone' => '+213 555 999 000',
                'employer_id' => $employers[3] ?? 4,
                'status' => 'Closed',
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(5),
            ],
            // High salary job
            [
                'title' => 'Senior Project Manager',
                'description' => 'Experienced project manager needed for large-scale software projects. PMP certification preferred.',
                'category' => 'Management',
                'city' => 'Oran',
                'pay_range' => '150000-200000 DZD/month',
                'contactEmail' => 'pm@financehub.com',
                'contactPhone' => '+213 555 123 456',
                'employer_id' => $employers[4] ?? 5,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($jobs as $job) {
            \DB::table('jobs')->insert($job);
        }

        $this->command->info('Jobs for CRUD testing seeded successfully!');
    }
}
