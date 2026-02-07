<?php

// Fix missing student IDs (create students 1-25)
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: application/json');

try {
    echo "=== FIXING STUDENT IDs 1-25 ===\n\n";
    
    // Check current students
    $currentStudents = DB::table('students')->pluck('id')->toArray();
    echo "Current student IDs: " . implode(', ', $currentStudents) . "\n\n";
    
    // Create missing students (IDs 1-25)
    $missingIds = [];
    for ($i = 1; $i <= 25; $i++) {
        if (!in_array($i, $currentStudents)) {
            $missingIds[] = $i;
        }
    }
    
    echo "Missing student IDs: " . implode(', ', $missingIds) . "\n\n";
    
    if (!empty($missingIds)) {
        $sampleNames = [
            'Yassine Benzakour', 'Sara Amrani', 'Omar Khaled', 'Nadia Farsi',
            'Karim Mansouri', 'Lina Belkacem', 'Mehdi Zoubair', 'Imane Rhali',
            'Adil El Mansouri', 'Hajar Boudali', 'Walid Kabbaj', 'Meryem Ouafi',
            'Anas Selmani', 'Khadija Raki', 'Brahim El Alami', 'Samira Zahidi',
            'Tariq Jamali', 'Test Student 20', 'Test Student 21', 'Test Student 22',
            'Test Student 23', 'Test Student 24', 'Test Student 25'
        ];
        
        $universities = [
            'University of Casablanca', 'University of Rabat', 'University of Marrakech',
            'University of Fez', 'University of Tangier', 'University of Agadir',
            'University of Meknes', 'University of Oujda', 'University of El Jadida',
            'University of Technology'
        ];
        
        $skills = [
            'Web Development, JavaScript, React', 'Mobile Development, Flutter', 
            'Data Science, Python, Machine Learning', 'UI/UX Design, Figma, Adobe XD',
            'Digital Marketing, SEO, Social Media', 'Backend Development, Node.js, Express',
            'Full Stack Development, Laravel, Vue.js', 'DevOps, Docker, Kubernetes',
            'Game Development, Unity, C#', 'Blockchain Development, Solidity, Web3.js',
            'Web Development, PHP, Laravel'
        ];
        
        foreach ($missingIds as $index => $id) {
            $nameIndex = min($index, count($sampleNames) - 1);
            $univIndex = array_rand($universities);
            $skillsIndex = array_rand($skills);
            
            $student = [
                'id' => $id,
                'full_name' => $sampleNames[$nameIndex],
                'email' => 'student' . $id . '@university.edu',
                'password' => Hash::make('password123'),
                'university' => $universities[$univIndex],
                'city' => 'Casablanca',
                'phone' => '+212600' . str_pad($id, 6, '0', STR_PAD_LEFT),
                'skills' => $skills[$skillsIndex],
                'description' => 'Computer Science student passionate about technology and innovation',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            DB::table('students')->insert($student);
            echo "✓ Created student ID {$id}: {$student['full_name']}\n";
        }
    }
    
    // Show final result
    $allStudents = DB::table('students')->orderBy('id')->get();
    echo "\n✅ SUCCESS! Total students: " . $allStudents->count() . "\n";
    echo "Available student IDs: " . implode(', ', $allStudents->pluck('id')->toArray()) . "\n";
    
    echo "\n🔑 Test Accounts:\n";
    echo "Student 7: student7@university.edu / password123\n";
    echo "Student 1: student1@university.edu / password123\n";
    
    echo json_encode([
        'success' => true,
        'message' => 'Student IDs 1-25 created successfully',
        'total_students' => $allStudents->count(),
        'student_ids' => $allStudents->pluck('id')->toArray(),
        'test_accounts' => [
            'student_7' => 'student7@university.edu / password123',
            'student_1' => 'student1@university.edu / password123'
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
