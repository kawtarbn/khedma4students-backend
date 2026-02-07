<?php

// Fresh database seeding from zero
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: application/json');

try {
    echo "=== SEEDING DATABASE FROM ZERO ===\n\n";
    
    // Check if database is empty
    $studentCount = DB::table('students')->count();
    $employerCount = DB::table('employers')->count();
    
    echo "Current state:\n";
    echo "Students: $studentCount\n";
    echo "Employers: $employerCount\n\n";
    
    if ($studentCount > 0 || $employerCount > 0) {
        echo "Database is not empty. Please reset first using reset_database.php\n";
        echo json_encode([
            'success' => false,
            'message' => 'Database not empty. Please reset first.'
        ]);
        exit;
    }
    
    echo "Starting fresh seeding...\n\n";
    
    // 1. Create Students
    echo "Creating Students:\n";
    $students = [
        [
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
    
    foreach ($students as $index => $student) {
        DB::table('students')->insert($student);
        echo "✓ Created student: {$student['full_name']} ({$student['email']})\n";
    }
    
    // 2. Create Employers
    echo "\nCreating Employers:\n";
    $employers = [
        [
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
        ],
        [
            'full_name' => 'Omar Zoubair',
            'email' => 'omar.zoubair@innovatech.ma',
            'password' => Hash::make('password123'),
            'company' => 'Innovatech Systems',
            'city' => 'Marrakech',
            'phone' => '+212500000003',
            'description' => 'Innovative technology startup focused on IoT solutions and smart city implementations.',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ];
    
    foreach ($employers as $employer) {
        DB::table('employers')->insert($employer);
        echo "✓ Created employer: {$employer['full_name']} ({$employer['company']})\n";
    }
    
    // Get created IDs
    $studentIds = DB::table('students')->pluck('id')->toArray();
    $employerIds = DB::table('employers')->pluck('id')->toArray();
    
    // 3. Create Jobs
    echo "\nCreating Jobs:\n";
    $jobs = [
        [
            'title' => 'Full Stack Web Developer',
            'description' => 'We are looking for a talented Full Stack Developer to join our team. You will work on exciting projects using modern technologies like React, Node.js, and MongoDB. Experience with cloud services is a plus.',
            'category' => 'Web Development',
            'city' => 'Casablanca',
            'pay_range' => '8000-15000 MAD/month',
            'contactEmail' => 'karim.mansouri@techsolutions.ma',
            'contactPhone' => '+212500000001',
            'status' => 'Active',
            'employer_id' => $employerIds[0],
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Mobile App Developer',
            'description' => 'Join our team to develop amazing mobile applications for iOS and Android. We are looking for someone with experience in Flutter or React Native. Knowledge of Firebase and backend integration is required.',
            'category' => 'Mobile Development',
            'city' => 'Rabat',
            'pay_range' => '7000-12000 MAD/month',
            'contactEmail' => 'lina.belkacem@digitalagency.ma',
            'contactPhone' => '+212500000002',
            'status' => 'Active',
            'employer_id' => $employerIds[1],
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'UI/UX Designer Intern',
            'description' => 'Great opportunity for design students to gain hands-on experience in UI/UX design. You will work on real projects and learn from experienced designers. Portfolio required.',
            'category' => 'Design',
            'city' => 'Marrakech',
            'pay_range' => '3000-5000 MAD/month',
            'contactEmail' => 'omar.zoubair@innovatech.ma',
            'contactPhone' => '+212500000003',
            'status' => 'Active',
            'employer_id' => $employerIds[2],
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Data Science Intern',
            'description' => 'Looking for a data science enthusiast to join our research team. You will work on machine learning projects, data analysis, and predictive modeling. Python and ML knowledge required.',
            'category' => 'Data Science',
            'city' => 'Casablanca',
            'pay_range' => '4000-7000 MAD/month',
            'contactEmail' => 'karim.mansouri@techsolutions.ma',
            'contactPhone' => '+212500000001',
            'status' => 'Active',
            'employer_id' => $employerIds[0],
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Digital Marketing Specialist',
            'description' => 'We need a creative digital marketing specialist to manage our online campaigns. Experience with SEO, social media marketing, and content creation is essential.',
            'category' => 'Marketing',
            'city' => 'Rabat',
            'pay_range' => '6000-10000 MAD/month',
            'contactEmail' => 'lina.belkacem@digitalagency.ma',
            'contactPhone' => '+212500000002',
            'status' => 'Active',
            'employer_id' => $employerIds[1],
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ];
    
    foreach ($jobs as $job) {
        DB::table('jobs')->insert($job);
        echo "✓ Created job: {$job['title']}\n";
    }
    
    // 4. Create Services
    echo "\nCreating Student Services:\n";
    $services = [
        [
            'title' => 'Web Development Services',
            'description' => 'Professional website development using modern technologies. I create responsive, fast, and secure websites for businesses and individuals.',
            'category' => 'Web Development',
            'city' => 'Casablanca',
            'pay' => '1000-5000 MAD/project',
            'availability' => 'Weekends, Evenings',
            'contact_email' => 'ahmed.benali@university.edu',
            'status' => 'Active',
            'student_id' => $studentIds[0],
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Mobile App Development',
            'description' => 'I develop cross-platform mobile apps using Flutter. Perfect for startups and businesses looking to launch mobile applications.',
            'category' => 'Mobile Development',
            'city' => 'Rabat',
            'pay' => '2000-8000 MAD/project',
            'availability' => 'Flexible',
            'contact_email' => 'fatima.zahra@university.edu',
            'status' => 'Active',
            'student_id' => $studentIds[1],
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'UI/UX Design Services',
            'description' => 'Beautiful and functional design services for websites and mobile apps. I specialize in user research, wireframing, and prototyping.',
            'category' => 'Design',
            'city' => 'Marrakech',
            'pay' => '500-3000 MAD/project',
            'availability' => 'Weekdays',
            'contact_email' => 'mohammed.alami@university.edu',
            'status' => 'Active',
            'student_id' => $studentIds[2],
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'title' => 'Data Analysis Services',
            'description' => 'Help businesses make sense of their data through analysis, visualization, and predictive modeling using Python and ML.',
            'category' => 'Data Science',
            'city' => 'Fez',
            'pay' => '1500-6000 MAD/project',
            'availability' => 'Weekends',
            'contact_email' => 'sara.amrani@university.edu',
            'status' => 'Active',
            'student_id' => $studentIds[3],
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ];
    
    foreach ($services as $service) {
        DB::table('services')->insert($service);
        echo "✓ Created service: {$service['title']}\n";
    }
    
    // Final counts
    $finalStudentCount = DB::table('students')->count();
    $finalEmployerCount = DB::table('employers')->count();
    $finalJobCount = DB::table('jobs')->count();
    $finalServiceCount = DB::table('services')->count();
    
    echo "\n✅ SUCCESS! Database seeded from zero!\n";
    echo "📊 Final counts:\n";
    echo "   Students: $finalStudentCount\n";
    echo "   Employers: $finalEmployerCount\n";
    echo "   Jobs: $finalJobCount\n";
    echo "   Services: $finalServiceCount\n";
    
    echo "\n🔑 Test Accounts:\n";
    echo "Student: ahmed.benali@university.edu / password123\n";
    echo "Employer: karim.mansouri@techsolutions.ma / password123\n";
    
    echo json_encode([
        'success' => true,
        'message' => 'Database seeded successfully from zero',
        'counts' => [
            'students' => $finalStudentCount,
            'employers' => $finalEmployerCount,
            'jobs' => $finalJobCount,
            'services' => $finalServiceCount
        ],
        'test_accounts' => [
            'student' => 'ahmed.benali@university.edu / password123',
            'employer' => 'karim.mansouri@techsolutions.ma / password123'
        ]
    ]);
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
