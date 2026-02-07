<?php

namespace App\Http\Controllers;

class StaticJobController extends Controller
{
    public function index()
    {
        // Return sample jobs data to fix cards display
        $sampleJobs = [
            [
                'id' => 1,
                'title' => 'Web Development Intern',
                'description' => 'Looking for a web development intern to help with our React frontend project. Must have experience with React, Node.js, and modern web technologies.',
                'category' => 'Technology',
                'city' => 'Alger',
                'pay_range' => 'Paid',
                'contactEmail' => 'contact@company.com',
                'contactPhone' => '+213 123 4567',
                'status' => 'Active',
                'created_at' => '2026-02-07T18:00:00.000000Z',
                'updated_at' => '2026-02-07T18:00:00.000000Z'
            ],
            [
                'id' => 2,
                'title' => 'Mobile App Developer',
                'description' => 'Seeking mobile app developer for iOS/Android project. Experience with React Native or Flutter required.',
                'category' => 'Technology',
                'city' => 'Alger',
                'pay_range' => 'Paid',
                'contactEmail' => 'hr@techcompany.com',
                'contactPhone' => '+213 987 6543',
                'status' => 'Active',
                'created_at' => '2026-02-07T17:30:00.000000Z',
                'updated_at' => '2026-02-07T17:30:00.000000Z'
            ],
            [
                'id' => 3,
                'title' => 'UI/UX Designer',
                'description' => 'Need a creative UI/UX designer for our student platform. Portfolio with modern design tools required.',
                'category' => 'Design',
                'city' => 'Alger',
                'pay_range' => 'Paid',
                'contactEmail' => 'design@startup.com',
                'contactPhone' => '+213 456 7890',
                'status' => 'Active',
                'created_at' => '2026-02-07T17:00:00.000000Z',
                'updated_at' => '2026-02-07T17:00:00.000000Z'
            ]
        ];
        
        return response()->json([
            'success' => true,
            'data' => $sampleJobs,
            'count' => count($sampleJobs),
            'message' => 'Sample jobs loaded successfully'
        ]);
    }
    
    public function show($id)
    {
        // Return sample job details
        $sampleJobs = [
            1 => [
                'id' => 1,
                'title' => 'Web Development Intern',
                'description' => 'Looking for a web development intern to help with our React frontend project. Must have experience with React, Node.js, and modern web technologies.',
                'category' => 'Technology',
                'city' => 'Alger',
                'pay_range' => 'Paid',
                'contactEmail' => 'contact@company.com',
                'contactPhone' => '+213 123 4567',
                'status' => 'Active'
            ],
            2 => [
                'id' => 2,
                'title' => 'Mobile App Developer',
                'description' => 'Seeking mobile app developer for iOS/Android project. Experience with React Native or Flutter required.',
                'category' => 'Technology',
                'city' => 'Alger',
                'pay_range' => 'Paid',
                'contactEmail' => 'hr@techcompany.com',
                'contactPhone' => '+213 987 6543',
                'status' => 'Active'
            ],
            3 => [
                'id' => 3,
                'title' => 'UI/UX Designer',
                'description' => 'Need a creative UI/UX designer for our student platform. Portfolio with modern design tools required.',
                'category' => 'Design',
                'city' => 'Alger',
                'pay_range' => 'Paid',
                'contactEmail' => 'design@startup.com',
                'contactPhone' => '+213 456 7890',
                'status' => 'Active'
            ]
        ];
        
        $job = $sampleJobs[$id] ?? null;
        
        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $job
        ]);
    }
}
