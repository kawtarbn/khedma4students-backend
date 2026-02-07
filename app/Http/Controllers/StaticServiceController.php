<?php

namespace App\Http\Controllers;

class StaticServiceController extends Controller
{
    public function index()
    {
        // Return sample services data to fix services display
        $sampleServices = [
            [
                'id' => 1,
                'title' => 'Web Development Tutoring',
                'description' => 'Offering web development tutoring for students. Learn HTML, CSS, JavaScript, React, and modern web frameworks.',
                'category' => 'Education',
                'student_id' => 1,
                'price' => '500 DZD/hour',
                'availability' => 'Weekends',
                'city' => 'Alger',
                'created_at' => '2026-02-07T18:00:00.000000Z',
                'updated_at' => '2026-02-07T18:00:00.000000Z'
            ],
            [
                'id' => 2,
                'title' => 'Mobile App Development',
                'description' => 'Create mobile applications for iOS and Android. Learn React Native, Flutter, or native development.',
                'category' => 'Technology',
                'student_id' => 2,
                'price' => '600 DZD/hour',
                'availability' => 'Evenings',
                'city' => 'Alger',
                'created_at' => '2026-02-07T17:30:00.000000Z',
                'updated_at' => '2026-02-07T17:30:00.000000Z'
            ],
            [
                'id' => 3,
                'title' => 'UI/UX Design Services',
                'description' => 'Professional UI/UX design for websites and mobile apps. Learn Figma, Adobe XD, and design principles.',
                'category' => 'Design',
                'student_id' => 3,
                'price' => '400 DZD/hour',
                'availability' => 'Flexible',
                'city' => 'Alger',
                'created_at' => '2026-02-07T17:00:00.000000Z',
                'updated_at' => '2026-02-07T17:00:00.000000Z'
            ]
        ];
        
        return response()->json([
            'success' => true,
            'data' => $sampleServices,
            'count' => count($sampleServices),
            'message' => 'Sample services loaded successfully'
        ]);
    }
    
    public function show($id)
    {
        // Return sample service details
        $sampleServices = [
            1 => [
                'id' => 1,
                'title' => 'Web Development Tutoring',
                'description' => 'Offering web development tutoring for students. Learn HTML, CSS, JavaScript, React, and modern web frameworks.',
                'category' => 'Education',
                'student_id' => 1,
                'price' => '500 DZD/hour',
                'availability' => 'Weekends',
                'city' => 'Alger'
            ],
            2 => [
                'id' => 2,
                'title' => 'Mobile App Development',
                'description' => 'Create mobile applications for iOS and Android. Learn React Native, Flutter, or native development.',
                'category' => 'Technology',
                'student_id' => 2,
                'price' => '600 DZD/hour',
                'availability' => 'Evenings',
                'city' => 'Alger'
            ],
            3 => [
                'id' => 3,
                'title' => 'UI/UX Design Services',
                'description' => 'Professional UI/UX design for websites and mobile apps. Learn Figma, Adobe XD, and design principles.',
                'category' => 'Design',
                'student_id' => 3,
                'price' => '400 DZD/hour',
                'availability' => 'Flexible',
                'city' => 'Alger'
            ]
        ];
        
        $service = $sampleServices[$id] ?? null;
        
        if (!$service) {
            return response()->json(['message' => 'Service not found'], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $service
        ]);
    }
}
