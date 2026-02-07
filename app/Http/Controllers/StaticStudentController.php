<?php

namespace App\Http\Controllers;

class StaticStudentController extends Controller
{
    public function getStudentServices($id)
    {
        // Return sample services for student
        $sampleServices = [
            [
                'id' => 1,
                'title' => 'Web Development Tutoring',
                'description' => 'Offering web development tutoring for students. Learn HTML, CSS, JavaScript, React, and modern web frameworks.',
                'category' => 'Education',
                'student_id' => $id,
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
                'student_id' => $id,
                'price' => '600 DZD/hour',
                'availability' => 'Evenings',
                'city' => 'Alger',
                'created_at' => '2026-02-07T17:30:00.000000Z',
                'updated_at' => '2026-02-07T17:30:00.000000Z'
            ]
        ];
        
        return response()->json([
            'success' => true,
            'data' => $sampleServices,
            'count' => count($sampleServices),
            'message' => 'Student services loaded successfully'
        ]);
    }
    
    public function getStudentApplications($id)
    {
        // Return sample applications for student
        $sampleApplications = [
            [
                'id' => 1,
                'job_id' => 1,
                'student_id' => $id,
                'status' => 'Applied',
                'applied_at' => '2026-02-07T18:00:00.000000Z',
                'job_title' => 'Web Development Intern',
                'company' => 'Tech Company',
                'city' => 'Alger'
            ],
            [
                'id' => 2,
                'job_id' => 2,
                'student_id' => $id,
                'status' => 'Under Review',
                'applied_at' => '2026-02-07T17:30:00.000000Z',
                'job_title' => 'Mobile App Developer',
                'company' => 'Startup Inc',
                'city' => 'Alger'
            ]
        ];
        
        return response()->json([
            'success' => true,
            'data' => $sampleApplications,
            'count' => count($sampleApplications),
            'message' => 'Student applications loaded successfully'
        ]);
    }
    
    public function getStudentServiceApplications($studentId)
    {
        // Return sample service applications for student
        $sampleServiceApplications = [
            [
                'id' => 1,
                'service_id' => 1,
                'student_id' => $studentId,
                'employer_name' => 'Company A',
                'status' => 'Pending',
                'created_at' => '2026-02-07T18:00:00.000000Z',
                'service_title' => 'Web Development Tutoring'
            ]
        ];
        
        return response()->json([
            'success' => true,
            'data' => $sampleServiceApplications,
            'count' => count($sampleServiceApplications),
            'message' => 'Student service applications loaded successfully'
        ]);
    }
}
