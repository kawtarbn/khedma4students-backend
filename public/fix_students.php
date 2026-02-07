<?php

// Fix student IDs by creating missing students
require_once __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

header('Content-Type: application/json');

try {
    echo "=== FIXING STUDENT IDs ===\n\n";
    
    // Check current students
    $currentStudents = DB::table('students')->get();
    echo "Current students:\n";
    foreach ($currentStudents as $student) {
        echo "ID: {$student->id} - {$student->full_name} ({$student->email})\n";
    }
    echo "\n";
    
    // Create missing students (IDs 1-17)
    $missingStudents = [];
    for ($i = 1; $i <= 17; $i++) {
        $exists = DB::table('students')->where('id', $i)->exists();
        if (!$exists) {
            $missingStudents[] = $i;
        }
    }
    
    echo "Missing student IDs: " . implode(', ', $missingStudents) . "\n\n";
    
    if (!empty($missingStudents)) {
        echo "Creating missing students...\n";
        
        $sampleNames = [
            'Yassine Benzakour', 'Sara Amrani', 'Omar Khaled', 'Nadia Farsi',
            'Karim Mansouri', 'Lina Belkacem', 'Mehdi Zoubair', 'Imane Rhali',
            'Adil El Mansouri', 'Hajar Boudali', 'Walid Kabbaj', 'Meryem Ouafi',
            'Anas Selmani', 'Khadija Raki', 'Brahim El Alami', 'Samira Zahidi',
            'Tariq Jamali'
        ];
        
        $universities = [
            'University of Casablanca', 'University of Rabat', 'University of Marrakech',
            'University of Fez', 'University of Tangier', 'University of Agadir',
            'University of Meknes', 'University of Oujda', 'University of El Jadida'
        ];
        
        $skills = [
            'Web Development, JavaScript, React', 'Mobile Development, Flutter', 
            'Data Science, Python, Machine Learning', 'UI/UX Design, Figma, Adobe XD',
            'Digital Marketing, SEO, Social Media', 'Backend Development, Node.js, Express',
            'Full Stack Development, Laravel, Vue.js', 'DevOps, Docker, Kubernetes',
            'Game Development, Unity, C#', 'Blockchain Development, Solidity, Web3.js'
        ];
        
        foreach ($missingStudents as $index => $id) {
            $nameIndex = array_rand($sampleNames);
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
    
    // Create some additional students (IDs 20-25)
    echo "\nCreating additional students...\n";
    for ($i = 20; $i <= 25; $i++) {
        $exists = DB::table('students')->where('id', $i)->exists();
        if (!$exists) {
            $student = [
                'id' => $i,
                'full_name' => 'Test Student ' . $i,
                'email' => 'test' . $i . '@university.edu',
                'password' => Hash::make('password123'),
                'university' => 'University of Technology',
                'city' => 'Casablanca',
                'phone' => '+212600' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'skills' => 'Web Development, PHP, Laravel',
                'description' => 'Test student for development purposes',
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
            DB::table('students')->insert($student);
            echo "✓ Created student ID {$i}: {$student['full_name']}\n";
        }
    }
    
    // Final count
    $finalCount = DB::table('students')->count();
    echo "\n✅ SUCCESS! Total students: $finalCount\n";
    
    // Show all students
    $allStudents = DB::table('students')->orderBy('id')->get();
    echo "\nAll students in database:\n";
    foreach ($allStudents as $student) {
        echo "ID: {$student->id} - {$student->full_name} ({$student->email})\n";
    }
    
    echo json_encode([
        'success' => true,
        'message' => 'Student IDs fixed successfully',
        'total_students' => $finalCount,
        'student_ids' => $allStudents->pluck('id')->toArray()
    ]);
    
} catch (Exception $e) {
    echo "❌ ERROR: " . $e->getMessage() . "\n";
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>
