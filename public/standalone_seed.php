<?php

// Standalone seeding script
header('Content-Type: text/plain');

try {
    require_once __DIR__ . '/../vendor/autoload.php';
    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
    $kernel->bootstrap();
    
    echo "=== STANDALONE DATABASE SEEDING ===\n\n";
    
    // Test database connection first
    echo "Testing database connection...\n";
    $pdo = DB::connection()->getPdo();
    echo "✅ Database connected!\n\n";
    
    // Check current data
    $studentCount = DB::table('students')->count();
    echo "Current students: $studentCount\n\n";
    
    if ($studentCount > 0) {
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
        echo "✅ Data cleared\n\n";
    }
    
    // Create students
    echo "Creating students...\n";
    $student1 = DB::table('students')->insertGetId([
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
    ]);
    
    $student2 = DB::table('students')->insertGetId([
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
    ]);
    
    echo "✅ Created 2 students (IDs: $student1, $student2)\n";
    
    // Create employers
    echo "Creating employers...\n";
    $employer1 = DB::table('employers')->insertGetId([
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
    ]);
    
    echo "✅ Created 1 employer (ID: $employer1)\n";
    
    // Create jobs
    echo "Creating jobs...\n";
    DB::table('jobs')->insert([
        'title' => 'Full Stack Developer',
        'description' => 'Looking for an experienced full stack developer to join our team. Must know Laravel, React, and modern web technologies.',
        'category' => 'Web Development',
        'city' => 'Casablanca',
        'pay_range' => '8000-12000 MAD/month',
        'contactEmail' => 'hr@techsolutions.com',
        'contactPhone' => '+212500000001',
        'status' => 'Active',
        'employer_id' => $employer1,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    
    echo "✅ Created 1 job\n";
    
    // Create services
    echo "Creating services...\n";
    DB::table('services')->insert([
        'title' => 'Web Development Services',
        'description' => 'Custom website development using modern technologies',
        'category' => 'Web Development',
        'city' => 'Casablanca',
        'pay' => '500-2000 MAD/project',
        'availability' => 'Weekends',
        'contact_email' => 'ahmed@university.edu',
        'status' => 'Active',
        'student_id' => $student1,
        'created_at' => now(),
        'updated_at' => now()
    ]);
    
    echo "✅ Created 1 service\n\n";
    
    // Final count
    echo "=== FINAL RESULTS ===\n";
    echo "Students: " . DB::table('students')->count() . "\n";
    echo "Employers: " . DB::table('employers')->count() . "\n";
    echo "Jobs: " . DB::table('jobs')->count() . "\n";
    echo "Services: " . DB::table('services')->count() . "\n\n";
    
    echo "🔑 LOGIN CREDENTIALS:\n";
    echo "Students: ahmed@university.edu, fatima@university.edu\n";
    echo "Password: password123\n";
    echo "Employer: hr@techsolutions.com\n";
    echo "Password: password123\n\n";
    
    echo "✅ SEEDING COMPLETED SUCCESSFULLY!\n";
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
