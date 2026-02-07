<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateStudentController extends Controller
{
    public function createStudent2()
    {
        try {
            // Check if student ID 2 already exists
            $existingStudent = Student::find(2);
            if ($existingStudent) {
                return response()->json([
                    'success' => true,
                    'message' => 'Student ID 2 already exists',
                    'student' => $existingStudent
                ]);
            }
            
            // Create student with ID 2
            $student = Student::create([
                'id' => 2,
                'full_name' => 'Dashboard Test Student',
                'email' => 'dashboard.test@example.com',
                'password' => Hash::make('password123'),
                'university' => 'Test University',
                'city' => 'Test City',
                'phone' => '555-123-4567',
                'skills' => 'JavaScript, React, Node.js, PHP, Laravel',
                'description' => 'Test student for dashboard functionality. This student has complete profile information for testing the student dashboard.',
                'email_verification_token' => 'dashboard-test-token-' . time(),
                'email_verified_at' => now(), // Auto-verify for testing
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Student ID 2 created successfully!',
                'student' => $student,
                'note' => 'This student can now be used for dashboard testing'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Failed to create student ID 2'
            ], 500);
        }
    }
}
