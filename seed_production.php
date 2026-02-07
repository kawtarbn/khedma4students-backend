<?php

require_once __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$kernel->bootstrap();

try {
    echo "=== SEEDING PRODUCTION DATABASE ===\n\n";
    
    // Create sample students
    echo "Creating sample students...\n";
    $students = [
        [
            'full_name' => 'Ahmed Mohammed',
            'email' => 'ahmed@university.edu',
            'password' => Hash::make('password123'),
            'university' => 'University of Technology',
            'city' => 'Casablanca',
            'phone' => '+212600000001',
            'skills' => 'Web Development, PHP, Laravel',
            'description' => 'Computer Science student with passion for web development',
            'email_verified_at' => now()
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
            'email_verified_at' => now()
        ],
        [
            'full_name' => 'Youssef Ali',
            'email' => 'youssef@university.edu',
            'password' => Hash::make('password123'),
            'university' => 'Business School',
            'city' => 'Marrakech',
            'phone' => '+212600000003',
            'skills' => 'Digital Marketing, SEO, Content Writing',
            'description' => 'Marketing student with digital expertise',
            'email_verified_at' => now()
        ]
    ];
    
    foreach ($students as $student) {
        DB::table('students')->insert($student);
    }
    
    // Create sample employers
    echo "Creating sample employers...\n";
    $employers = [
        [
            'company_name' => 'Tech Solutions Inc',
            'email' => 'hr@techsolutions.com',
            'password' => Hash::make('password123'),
            'industry' => 'Technology',
            'city' => 'Casablanca',
            'phone' => '+212500000001',
            'description' => 'Leading technology company seeking talented developers',
            'email_verified_at' => now()
        ],
        [
            'company_name' => 'Digital Marketing Agency',
            'email' => 'jobs@digitalma.com',
            'password' => Hash::make('password123'),
            'industry' => 'Marketing',
            'city' => 'Rabat',
            'phone' => '+212500000002',
            'description' => 'Full-service digital marketing agency',
            'email_verified_at' => now()
        ]
    ];
    
    foreach ($employers as $employer) {
        DB::table('employers')->insert($employer);
    }
    
    // Get created IDs
    $studentIds = DB::table('students')->pluck('id')->toArray();
    $employerIds = DB::table('employers')->pluck('id')->toArray();
    
    // Create sample jobs
    echo "Creating sample jobs...\n";
    $jobs = [
        [
            'title' => 'Full Stack Developer',
            'description' => 'Looking for an experienced full stack developer to join our team. Must know Laravel, React, and modern web technologies.',
            'category' => 'Web Development',
            'city' => 'Casablanca',
            'pay_range' => '8000-12000 MAD/month',
            'contactEmail' => 'hr@techsolutions.com',
            'contactPhone' => '+212500000001',
            'status' => 'Active',
            'employer_id' => $employerIds[0]
        ],
        [
            'title' => 'Mobile App Developer',
            'description' => 'Seeking mobile app developer with React Native experience for exciting projects.',
            'category' => 'Mobile Development',
            'city' => 'Rabat',
            'pay_range' => '7000-10000 MAD/month',
            'contactEmail' => 'hr@techsolutions.com',
            'contactPhone' => '+212500000001',
            'status' => 'Active',
            'employer_id' => $employerIds[0]
        ],
        [
            'title' => 'Digital Marketing Intern',
            'description' => 'Great opportunity for students to learn digital marketing hands-on.',
            'category' => 'Marketing',
            'city' => 'Rabat',
            'pay_range' => '3000-4000 MAD/month',
            'contactEmail' => 'jobs@digitalma.com',
            'contactPhone' => '+212500000002',
            'status' => 'Active',
            'employer_id' => $employerIds[1]
        ]
    ];
    
    foreach ($jobs as $job) {
        DB::table('jobs')->insert($job);
    }
    
    // Create sample services
    echo "Creating sample services...\n";
    $services = [
        [
            'title' => 'Web Development Services',
            'description' => 'Custom website development using modern technologies',
            'category' => 'Web Development',
            'city' => 'Casablanca',
            'pay' => '500-2000 MAD/project',
            'availability' => 'Weekends',
            'contact_email' => 'ahmed@university.edu',
            'status' => 'Active',
            'student_id' => $studentIds[0]
        ],
        [
            'title' => 'Mobile App Development',
            'description' => 'React Native mobile app development for iOS and Android',
            'category' => 'Mobile Development',
            'city' => 'Rabat',
            'pay' => '1000-3000 MAD/project',
            'availability' => 'Flexible',
            'contact_email' => 'fatima@university.edu',
            'status' => 'Active',
            'student_id' => $studentIds[1]
        ]
    ];
    
    foreach ($services as $service) {
        DB::table('services')->insert($service);
    }
    
    echo "\n✅ Database seeded successfully!\n";
    echo "📊 Created " . count($students) . " students\n";
    echo "📊 Created " . count($employers) . " employers\n";
    echo "📊 Created " . count($jobs) . " jobs\n";
    echo "📊 Created " . count($services) . " services\n";
    
} catch (Exception $e) {
    echo "❌ Seeding Error: " . $e->getMessage() . "\n";
}
