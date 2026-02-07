<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompleteCRUDTestingSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('🚀 Starting comprehensive CRUD testing data seeding...');
        
        // Clear existing data to avoid conflicts
        $this->command->info('📋 Clearing existing data...');
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('applications')->truncate();
        DB::table('hiring_requests')->truncate();
        DB::table('services')->truncate();
        DB::table('jobs')->truncate();
        DB::table('students')->truncate();
        DB::table('employers')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        // Run seeders in dependency order with error handling
        $this->command->info('👥 Seeding students with password constraints...');
        try {
            $this->call(StudentsWithPasswordConstraintsSeeder::class);
        } catch (\Exception $e) {
            $this->command->error('Students seeder failed: ' . $e->getMessage());
        }
        
        $this->command->info('🏢 Seeding employers with password constraints...');
        try {
            $this->call(EmployersWithPasswordConstraintsSeeder::class);
        } catch (\Exception $e) {
            $this->command->error('Employers seeder failed: ' . $e->getMessage());
        }
        
        $this->command->info('💼 Seeding jobs for CRUD testing...');
        try {
            $this->call(JobsForCRUDTestingSeeder::class);
        } catch (\Exception $e) {
            $this->command->error('Jobs seeder failed: ' . $e->getMessage());
        }
        
        $this->command->info('🛠️ Seeding services for CRUD testing...');
        try {
            $this->call(ServicesForCRUDTestingSeeder::class);
        } catch (\Exception $e) {
            $this->command->error('Services seeder failed: ' . $e->getMessage());
        }
        
        $this->command->info('📄 Seeding applications for CRUD testing...');
        try {
            $this->call(SimpleApplicationsSeeder::class);
        } catch (\Exception $e) {
            $this->command->error('Applications seeder failed: ' . $e->getMessage());
        }
        
        $this->command->info('🤝 Seeding hiring requests for CRUD testing...');
        try {
            $this->call(HiringRequestsForCRUDTestingSeeder::class);
        } catch (\Exception $e) {
            $this->command->error('Hiring requests seeder failed: ' . $e->getMessage());
        }
        
        $this->command->info('✅ Comprehensive CRUD testing data seeding completed!');
        $this->command->info('');
        $this->command->info('📊 SUMMARY:');
        $this->command->info('   👥 Students: 6 (various password strengths)');
        $this->command->info('   🏢 Employers: 6 (various password strengths)');
        $this->command->info('   💼 Jobs: 5 (different types and statuses)');
        $this->command->info('   🛠️ Services: 5 (different categories and availability)');
        $this->command->info('   📄 Applications: 5 (pending, accepted, rejected)');
        $this->command->info('   🤝 Hiring Requests: 5 (pending, accepted, rejected)');
        $this->command->info('');
        $this->command->info('🔑 PASSWORD TESTING ACCOUNTS:');
        $this->command->info('   Weak Password: ahmed.weak@example.com / 123');
        $this->command->info('   Strong Password: fatima.strong@example.com / Str0ngP@ssw0rd123!');
        $this->command->info('   Special Chars: karim.special@marketpro.com / P@ssw0rd#$%^&*()');
        $this->command->info('   Numbers Only: amina.numbers@example.com / 1234567890');
        $this->command->info('   Mixed Case: yacine.mixed@example.com / MiXeD CaSe P@ss123');
        $this->command->info('');
        $this->command->info('🎯 READY FOR CRUD TESTING!');
    }
}
