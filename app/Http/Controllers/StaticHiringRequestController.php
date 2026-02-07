<?php

namespace App\Http\Controllers;

class StaticHiringRequestController extends Controller
{
    public function getStudentHiringRequests($studentId)
    {
        // Return sample hiring requests for student
        $sampleHiringRequests = [
            [
                'id' => 1,
                'employer_id' => 1,
                'student_id' => $studentId,
                'title' => 'Part-time Web Developer',
                'description' => 'Looking for a part-time web developer to help with our ongoing projects.',
                'category' => 'Technology',
                'city' => 'Alger',
                'status' => 'Pending',
                'created_at' => '2026-02-07T18:00:00.000000Z',
                'updated_at' => '2026-02-07T18:00:00.000000Z',
                'employer_name' => 'Tech Solutions',
                'contact_email' => 'contact@techsolutions.com'
            ],
            [
                'id' => 2,
                'employer_id' => 2,
                'student_id' => $studentId,
                'title' => 'Freelance UI/UX Designer',
                'description' => 'Need a UI/UX designer for a mobile app project.',
                'category' => 'Design',
                'city' => 'Alger',
                'status' => 'Accepted',
                'created_at' => '2026-02-07T17:30:00.000000Z',
                'updated_at' => '2026-02-07T17:30:00.000000Z',
                'employer_name' => 'Design Studio',
                'contact_email' => 'hello@designstudio.com'
            ]
        ];
        
        return response()->json([
            'success' => true,
            'data' => $sampleHiringRequests,
            'count' => count($sampleHiringRequests),
            'message' => 'Student hiring requests loaded successfully'
        ]);
    }
}
