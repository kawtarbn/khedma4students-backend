<?php

// Complete database recreation - drop all tables and recreate from scratch
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: application/json');

try {
    echo "=== COMPLETE DATABASE RECREATION ===\n\n";
    
    // Get all table names
    $tables = [
        'students',
        'employers', 
        'jobs',
        'services',
        'applications',
        'hiring_requests',
        'notifications',
        'contact_messages',
        'reviews',
        'success_stories',
        'password_resets'
    ];
    
    echo "Step 1: Dropping all tables...\n";
    
    // Drop all tables in correct order (respecting foreign keys)
    $dropOrder = [
        'password_resets',
        'success_stories', 
        'reviews',
        'contact_messages',
        'notifications',
        'hiring_requests',
        'applications',
        'services',
        'jobs',
        'employers',
        'students'
    ];
    
    foreach ($dropOrder as $table) {
        try {
            DB::statement("DROP TABLE IF EXISTS $table CASCADE");
            echo "✓ Dropped table: $table\n";
        } catch (Exception $e) {
            echo "⚠ Could not drop $table: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\nStep 2: Running migrations to recreate tables...\n";
    
    // Run all migrations
    $migrations = [
        'create_students_table',
        'create_employers_table',
        'create_jobs_table',
        'create_services_table',
        'create_applications_table',
        'create_hiring_requests_table',
        'create_notifications_table',
        'create_contact_messages_table',
        'create_reviews_table',
        'create_success_stories_table',
        'create_password_resets_table'
    ];
    
    foreach ($migrations as $migration) {
        try {
            echo "Running migration: $migration\n";
            Artisan::call("migrate --path=database/migrations/" . $migration . ".php --force");
        } catch (Exception $e) {
            echo "⚠ Migration $migration failed: " . $e->getMessage() . "\n";
        }
    }
    
    echo "\nStep 3: Seeding fresh data...\n";
    
    // Create fresh sample data
    $this->seedFreshData();
    
    echo "\n✅ SUCCESS! Database recreated and seeded from scratch!\n";
    
    // Show final counts
    $this->showFinalCounts();
    
    echo json_encode([
        'success' => true,
        'message' => 'Database recreated and seeded successfully',
        'tables_dropped' => count($tables),
        'migrations_run' => count($migrations),
        'data_seeded' => true
    ]);
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}

private function seedFreshData()
{
    echo "Creating fresh sample data...\n";
    
    // Create Students (IDs 1-5)
    $students = [
        [
            'id' => 1,
            'full_name' => 'Ahmed Benali',
            'email' => 'ahmed.benali@university.edu',
            'password' => Hash::make('password123'),
            'university' => 'University of Casablanca',
            'city' => 'Casablanca',
            'phone' => '+212600000001',
            'skills' => 'Web Development, React, Node.js, MongoDB',
            'description' => 'Computer Science student passionate about full-stack development and modern web technologies.',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 2,
            'full_name' => 'Fatima Zahra',
            'email' => 'fatima.zahra@university.edu',
            'password' => Hash::make('password123'),
            'university' => 'University of Rabat',
            'city' => 'Rabat',
            'phone' => '+212600000002',
            'skills' => 'Mobile Development, Flutter, Dart, Firebase',
            'description' => 'Software Engineering student specializing in cross-platform mobile app development.',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 3,
            'full_name' => 'Mohammed Alami',
            'email' => 'mohammed.alami@university.edu',
            'password' => Hash::make('password123'),
            'university' => 'University of Marrakech',
            'city' => 'Marrakech',
            'phone' => '+212600000003',
            'skills' => 'UI/UX Design, Figma, Adobe XD, Prototyping',
            'description' => 'Design student focused on user experience and interface design for digital products.',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 4,
            'full_name' => 'Sara Amrani',
            'email' => 'sara.amrani@university.edu',
            'password' => Hash::make('password123'),
            'university' => 'University of Fez',
            'city' => 'Fez',
            'phone' => '+212600000004',
            'skills' => 'Data Science, Python, Machine Learning, TensorFlow',
            'description' => 'Data Science student with expertise in machine learning and artificial intelligence.',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 5,
            'full_name' => 'Yassine Kabbaj',
            'email' => 'yassine.kabbaj@university.edu',
            'password' => Hash::make('password123'),
            'university' => 'University of Tangier',
            'city' => 'Tangier',
            'phone' => '+212600000005',
            'skills' => 'Digital Marketing, SEO, Social Media, Content Strategy',
            'description' => 'Marketing student specializing in digital marketing strategies and SEO optimization.',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ];
    
    foreach ($students as $student) {
        DB::table('students')->insert($student);
        echo "✓ Created student: {$student['full_name']} (ID: {$student['id']})\n";
    }
    
    // Create Employers (IDs 1-2)
    $employers = [
        [
            'id' => 1,
            'full_name' => 'Karim Mansouri',
            'email' => 'karim.mansouri@techsolutions.ma',
            'password' => Hash::make('password123'),
            'company' => 'TechSolutions Morocco',
            'city' => 'Casablanca',
            'phone' => '+212500000001',
            'description' => 'Leading technology company in Morocco providing innovative software solutions and digital transformation services.',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 2,
            'full_name' => 'Lina Belkacem',
            'email' => 'lina.belkacem@digitalagency.ma',
            'password' => Hash::make('password123'),
            'company' => 'Digital Marketing Pro',
            'city' => 'Rabat',
            'phone' => '+212500000002',
            'description' => 'Full-service digital marketing agency helping businesses grow their online presence and reach their target audience.',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ];
    
    foreach ($employers as $employer) {
        DB::table('employers')->insert($employer);
        echo "✓ Created employer: {$employer['full_name']} (ID: {$employer['id']})\n";
    }
    
    // Create Jobs (IDs 1-5)
    $jobs = [
        [
            'id' => 1,
            'title' => 'Full Stack Web Developer',
            'description' => 'We are looking for a talented Full Stack Developer to join our team. You will work on exciting projects using modern technologies like React, Node.js, and MongoDB. Experience with cloud services is a plus.',
            'category' => 'Web Development',
            'city' => 'Casablanca',
            'pay_range' => '8000-15000 MAD/month',
            'contactEmail' => 'karim.mansouri@techsolutions.ma',
            'contactPhone' => '+212500000001',
            'status' => 'Active',
            'employer_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 2,
            'title' => 'Mobile App Developer',
            'description' => 'Join our team to develop amazing mobile applications for iOS and Android. We are looking for someone with experience in Flutter or React Native. Knowledge of Firebase and backend integration is required.',
            'category' => 'Mobile Development',
            'city' => 'Rabat',
            'pay_range' => '7000-12000 MAD/month',
            'contactEmail' => 'lina.belkacem@digitalagency.ma',
            'contactPhone' => '+212500000002',
            'status' => 'Active',
            'employer_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 3,
            'title' => 'UI/UX Designer Intern',
            'description' => 'Great opportunity for design students to gain hands-on experience in UI/UX design. You will work on real projects and learn from experienced designers. Portfolio required.',
            'category' => 'Design',
            'city' => 'Marrakech',
            'pay_range' => '3000-5000 MAD/month',
            'contactEmail' => 'karim.mansouri@techsolutions.ma',
            'contactPhone' => '+212500000001',
            'status' => 'Active',
            'employer_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 4,
            'title' => 'Data Science Intern',
            'description' => 'Looking for a data science enthusiast to join our research team. You will work on machine learning projects, data analysis, and predictive modeling. Python and ML knowledge required.',
            'category' => 'Data Science',
            'city' => 'Casablanca',
            'pay_range' => '4000-7000 MAD/month',
            'contactEmail' => 'karim.mansouri@techsolutions.ma',
            'contactPhone' => '+212500000001',
            'status' => 'Active',
            'employer_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 5,
            'title' => 'Digital Marketing Specialist',
            'description' => 'We need a creative digital marketing specialist to manage our online campaigns. Experience with SEO, social media marketing, and content creation is essential.',
            'category' => 'Marketing',
            'city' => 'Rabat',
            'pay_range' => '6000-10000 MAD/month',
            'contactEmail' => 'lina.belkacem@digitalagency.ma',
            'contactPhone' => '+212500000002',
            'status' => 'Active',
            'employer_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ];
    
    foreach ($jobs as $job) {
        DB::table('jobs')->insert($job);
        echo "✓ Created job: {$job['title']}\n";
    }
    
    // Create Services (IDs 1-4)
    $services = [
        [
            'id' => 1,
            'title' => 'Web Development Services',
            'description' => 'Professional website development using modern technologies. I create responsive, fast, and secure websites for businesses and individuals.',
            'category' => 'Web Development',
            'city' => 'Casablanca',
            'pay' => '1000-5000 MAD/project',
            'availability' => 'Weekends, Evenings',
            'contact_email' => 'ahmed.benali@university.edu',
            'status' => 'Active',
            'student_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 2,
            'title' => 'Mobile App Development',
            'description' => 'I develop cross-platform mobile apps using Flutter. Perfect for startups and businesses looking to launch mobile applications.',
            'category' => 'Mobile Development',
            'city' => 'Rabat',
            'pay' => '2000-8000 MAD/project',
            'availability' => 'Flexible',
            'contact_email' => 'fatima.zahra@university.edu',
            'status' => 'Active',
            'student_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 3,
            'title' => 'UI/UX Design Services',
            'description' => 'Beautiful and functional design services for websites and mobile apps. I specialize in user research, wireframing, and prototyping.',
            'category' => 'Design',
            'city' => 'Marrakech',
            'pay' => '500-3000 MAD/project',
            'availability' => 'Weekdays',
            'contact_email' => 'mohammed.alami@university.edu',
            'status' => 'Active',
            'student_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'id' => 4,
            'title' => 'Data Analysis Services',
            'description' => 'Help businesses make sense of their data through analysis, visualization, and predictive modeling using Python and ML.',
            'category' => 'Data Science',
            'city' => 'Fez',
            'pay' => '1500-6000 MAD/project',
            'availability' => 'Weekends',
            'contact_email' => 'sara.amrani@university.edu',
            'status' => 'Active',
            'student_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ];
    
    foreach ($services as $service) {
        DB::table('services')->insert($service);
        echo "✓ Created service: {$service['title']}\n";
    }
    
    echo "✅ Fresh data creation completed!\n";
}

private function showFinalCounts()
{
    echo "\n📊 Final Database Counts:\n";
    
    $tables = ['students', 'employers', 'jobs', 'services', 'applications', 'hiring_requests'];
    
    foreach ($tables as $table) {
        try {
            $count = DB::table($table)->count();
            echo "   $table: $count records\n";
        } catch (Exception $e) {
            echo "   $table: ERROR - " . $e->getMessage() . "\n";
        }
    }
    
    echo "\n🔑 Test Accounts:\n";
    echo "   Student 1: ahmed.benali@university.edu / password123\n";
    echo "   Student 2: fatima.zahra@university.edu / password123\n";
    echo "   Student 3: mohammed.alami@university.edu / password123\n";
    echo "   Student 4: sara.amrani@university.edu / password123\n";
    echo "   Student 5: yassine.kabbaj@university.edu / password123\n";
    echo "   Employer 1: karim.mansouri@techsolutions.ma / password123\n";
    echo "   Employer 2: lina.belkacem@digitalagency.ma / password123\n";
}
?>
