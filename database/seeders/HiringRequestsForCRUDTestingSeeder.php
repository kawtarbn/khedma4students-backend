<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class HiringRequestsForCRUDTestingSeeder extends Seeder
{
    public function run(): void
    {
        // Get employers and services for relationships
        $employers = \DB::table('employers')->pluck('id')->toArray();
        $services = \DB::table('services')->where('status', 'available')->pluck('id')->toArray();
        $students = \DB::table('students')->pluck('id')->toArray();
        
        if (empty($employers) || empty($services) || empty($students)) {
            $this->command->error('No employers, services, or students found. Please run other seeders first.');
            return;
        }

        $hiringRequests = [
            // Pending hiring request
            [
                'employer_id' => $employers[0] ?? 1,
                'student_id' => $students[0] ?? 1,
                'service_id' => $services[0] ?? 1,
                'employer_name' => 'TechCorp Solutions',
                'employer_email' => 'rachid.weak@techcorp.com',
                'employer_phone' => '+213 555 111 222',
                'message' => 'We are looking for a mathematics tutor for our after-school program. The position requires 10 hours per week, working with high school students preparing for exams.',
                'service_title' => 'Mathematics Tutoring',
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(3),
            ],
            // Accepted hiring request
            [
                'employer_id' => $employers[1] ?? 2,
                'student_id' => $students[1] ?? 2,
                'service_id' => $services[1] ?? 2,
                'employer_name' => 'Education First Academy',
                'employer_email' => 'samira.strong@educationfirst.com',
                'employer_phone' => '+213 555 333 444',
                'message' => 'We need a full-stack developer for a 3-month project to build our company website. This is a paid opportunity with potential for long-term collaboration.',
                'service_title' => 'Full-Stack Web Development',
                'status' => 'accepted',
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(7),
            ],
            // Rejected hiring request
            [
                'employer_id' => $employers[2] ?? 3,
                'student_id' => $students[2] ?? 3,
                'service_id' => $services[2] ?? 3,
                'employer_name' => 'Marketing Pro Agency',
                'employer_email' => 'karim.special@marketpro.com',
                'employer_phone' => '+213 555 555 666',
                'message' => 'Looking for a logo designer for our startup. We have a limited budget but offer great portfolio exposure.',
                'service_title' => 'Logo Design & Branding',
                'status' => 'rejected',
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(14),
            ],
            // Recent hiring request
            [
                'employer_id' => $employers[3] ?? 4,
                'student_id' => $students[3] ?? 4,
                'service_id' => $services[3] ?? 4,
                'employer_name' => 'Engineering Plus',
                'employer_email' => 'omar.mixed@engineeringplus.com',
                'employer_phone' => '+213 555 999 000',
                'message' => 'Need translation services for our website localization project. Approximately 50 pages of technical documentation to translate.',
                'service_title' => 'English-Arabic Translation',
                'created_at' => now()->subHours(6),
                'updated_at' => now()->subHours(6),
            ],
            // High-value hiring request
            [
                'employer_id' => $employers[4] ?? 5,
                'student_id' => $students[4] ?? 5,
                'service_id' => $services[4] ?? 5,
                'employer_name' => 'Finance Hub Solutions',
                'employer_email' => 'amina.long@financehub.com',
                'employer_phone' => '+213 555 123 456',
                'message' => 'Corporate event photography needed for our annual conference. Full day event, approximately 8 hours, requires professional equipment and experience.',
                'service_title' => 'Photography Services',
                'created_at' => now()->subHours(24),
                'updated_at' => now()->subHours(24),
            ],
        ];

        foreach ($hiringRequests as $request) {
            \DB::table('hiring_requests')->insert($request);
        }

        $this->command->info('Hiring requests for CRUD testing seeded successfully!');
    }
}
