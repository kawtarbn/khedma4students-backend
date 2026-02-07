<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

header('Content-Type: application/json');

try {
    echo "=== PRODUCTION DATABASE SEEDING ===\n\n";
    
    // Check current database state
    $studentCount = DB::table('students')->count();
    $employerCount = DB::table('employers')->count();
    $jobCount = DB::table('jobs')->count();
    
    echo "Current database state:\n";
    echo "Students: $studentCount\n";
    echo "Employers: $employerCount\n";
    echo "Jobs: $jobCount\n\n";
    
    if ($jobCount > 0) {
        echo "Database already has jobs, skipping seeding...\n";
        echo json_encode(['success' => true, 'message' => 'Database already seeded']);
        exit;
    }
    
    // Create sample employers first
    echo "Creating employers...\n";
    $employers = [
        [
            'full_name' => 'Tech Solutions HR',
            'email' => 'hr@techsolutions.com',
            'password' => Hash::make('password123'),
            'company' => 'Tech Solutions Inc',
            'city' => 'Casablanca',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'full_name' => 'Digital Agency Manager',
            'email' => 'jobs@digitalma.com',
            'password' => Hash::make('password123'),
            'company' => 'Digital Marketing Agency',
            'city' => 'Rabat',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ];
    
    foreach ($employers as $employer) {
        DB::table('employers')->insert($employer);
    }
    
    // Get employer IDs
    $employerIds = DB::table('employers')->pluck('id')->toArray();
    
    // Create jobs
    echo "Creating jobs...\n";
    $jobs = [
        [
            'title' => 'Full Stack Developer',
            'description' => 'Looking for an experienced full stack developer with Laravel and React skills.',
            'category' => 'Web Development',
            'city' => 'Casablanca',
            'pay_range' => '8000-12000 MAD/month',
            'contactEmail' => 'hr@techsolutions.com',
            'contactPhone' => '+212500000001',
            'status' => 'Active',
            'employer_id' => $employerIds[0],
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Mobile App Developer',
            'description' => 'Seeking mobile app developer with React Native experience.',
            'category' => 'Mobile Development',
            'city' => 'Rabat',
            'pay_range' => '7000-10000 MAD/month',
            'contactEmail' => 'hr@techsolutions.com',
            'contactPhone' => '+212500000001',
            'status' => 'Active',
            'employer_id' => $employerIds[0],
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Digital Marketing Intern',
            'description' => 'Great opportunity for students to learn digital marketing.',
            'category' => 'Marketing',
            'city' => 'Rabat',
            'pay_range' => '3000-4000 MAD/month',
            'contactEmail' => 'jobs@digitalma.com',
            'contactPhone' => '+212500000002',
            'status' => 'Active',
            'employer_id' => $employerIds[1],
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ];
    
    foreach ($jobs as $job) {
        DB::table('jobs')->insert($job);
    }
    
    // Create sample services
    echo "Creating services...\n";
    $studentIds = DB::table('students')->pluck('id')->toArray();
    
    if (!empty($studentIds)) {
        $services = [
            [
                'title' => 'Web Development Services',
                'description' => 'Custom website development using modern technologies',
                'category' => 'Web Development',
                'city' => 'Casablanca',
                'pay' => '500-2000 MAD/project',
                'availability' => 'Weekends',
                'contact_email' => 'student@university.edu',
                'status' => 'Active',
                'student_id' => $studentIds[0],
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        
        foreach ($services as $service) {
            DB::table('services')->insert($service);
        }
    }
    
    // Final counts
    $finalStudentCount = DB::table('students')->count();
    $finalEmployerCount = DB::table('employers')->count();
    $finalJobCount = DB::table('jobs')->count();
    $finalServiceCount = DB::table('services')->count();
    
    echo "\n✅ Database seeded successfully!\n";
    echo "📊 Final counts:\n";
    echo "   Students: $finalStudentCount\n";
    echo "   Employers: $finalEmployerCount\n";
    echo "   Jobs: $finalJobCount\n";
    echo "   Services: $finalServiceCount\n";
    
    echo json_encode([
        'success' => true,
        'message' => 'Database seeded successfully',
        'counts' => [
            'students' => $finalStudentCount,
            'employers' => $finalEmployerCount,
            'jobs' => $finalJobCount,
            'services' => $finalServiceCount
        ]
    ]);
    
} catch (Exception $e) {
    echo "❌ Seeding Error: " . $e->getMessage() . "\n";
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
