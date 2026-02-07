<?php

// Simple seeding script
header('Content-Type: text/plain');

try {
    require_once __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "=== DATABASE SEEDING START ===\n\n";
    
    // Clear existing data
    echo "Clearing existing data...\n";
    DB::table('applications')->delete();
    DB::table('hiring_requests')->delete();
    DB::table('reviews')->delete();
    DB::table('notifications')->delete();
    DB::table('contact_messages')->delete();
    DB::table('services')->delete();
    DB::table('jobs')->delete();
    DB::table('students')->delete();
    DB::table('employers')->delete();
    
    // Create students
    echo "Creating students...\n";
    DB::table('students')->insert([
        [
            'full_name' => 'Ahmed Mohammed',
            'email' => 'ahmed@university.edu',
            'password' => Hash::make('password123'),
            'university' => 'University of Technology',
            'city' => 'Casablanca',
            'phone' => '+212600000001',
            'skills' => 'Web Development, PHP, Laravel',
            'description' => 'Computer Science student with passion for web development',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'full_name' => 'Fatima Zahra',
            'email' => 'fatima@university.edu',
            'password' => Hash::make('password123'),
            'university' => 'University of Science',
            'city' => 'Rabat',
            'phone' => '+212600000002',
            'skills' => 'Mobile Development, React Native',
            'description' => 'Software Engineering student focused on mobile apps',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]
    ]);
    
    // Create employers
    echo "Creating employers...\n";
    DB::table('employers')->insert([
        [
            'company_name' => 'Tech Solutions Inc',
            'email' => 'hr@techsolutions.com',
            'password' => Hash::make('password123'),
            'industry' => 'Technology',
            'city' => 'Casablanca',
            'phone' => '+212500000001',
            'description' => 'Leading technology company seeking talented developers',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]
    ]);
    
    // Get IDs
    $studentIds = DB::table('students')->pluck('id')->toArray();
    $employerIds = DB::table('employers')->pluck('id')->toArray();
    
    // Create jobs
    echo "Creating jobs...\n";
    DB::table('jobs')->insert([
        [
            'title' => 'Full Stack Developer',
            'description' => 'Looking for an experienced full stack developer to join our team. Must know Laravel, React, and modern web technologies.',
            'category' => 'Web Development',
            'city' => 'Casablanca',
            'pay_range' => '8000-12000 MAD/month',
            'contactEmail' => 'hr@techsolutions.com',
            'contactPhone' => '+212500000001',
            'status' => 'Active',
            'employer_id' => $employerIds[0],
            'created_at' => now(),
            'updated_at' => now()
        ]
    ]);
    
    // Create services
    echo "Creating services...\n";
    DB::table('services')->insert([
        [
            'title' => 'Web Development Services',
            'description' => 'Custom website development using modern technologies',
            'category' => 'Web Development',
            'city' => 'Casablanca',
            'pay' => '500-2000 MAD/project',
            'availability' => 'Weekends',
            'contact_email' => 'ahmed@university.edu',
            'status' => 'Active',
            'student_id' => $studentIds[0],
            'created_at' => now(),
            'updated_at' => now()
        ]
    ]);
    
    echo "\n✅ SEEDING COMPLETED!\n";
    echo "Students: " . DB::table('students')->count() . "\n";
    echo "Employers: " . DB::table('employers')->count() . "\n";
    echo "Jobs: " . DB::table('jobs')->count() . "\n";
    echo "Services: " . DB::table('services')->count() . "\n";
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "Stack: " . $e->getTraceAsString() . "\n";
}
