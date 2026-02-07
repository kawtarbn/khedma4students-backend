<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TestProfileController extends Controller
{
    public function testProfileSave()
    {
        try {
            // Test creating a student with all profile fields
            $student = Student::create([
                'full_name' => 'Test Profile Student',
                'email' => 'profile.test@example.com',
                'password' => Hash::make('password123'),
                'university' => 'Test University',
                'city' => 'Test City',
                'phone' => '123-456-7890',
                'skills' => 'Web Development, React, Node.js, PHP, Laravel',
                'description' => 'Passionate computer science student with strong skills in web development and mobile applications.',
                'email_verification_token' => 'test-token-' . time(),
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Profile test successful!',
                'student' => $student,
                'fields_saved' => [
                    'phone' => $student->phone,
                    'skills' => $student->skills,
                    'description' => $student->description
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Profile test failed'
            ], 500);
        }
    }
    
    public function getLatestStudent()
    {
        try {
            $student = Student::orderBy('created_at', 'desc')->first();
            
            if (!$student) {
                return response()->json(['message' => 'No students found'], 404);
            }
            
            return response()->json([
                'success' => true,
                'student' => $student,
                'profile_fields' => [
                    'phone' => $student->phone,
                    'skills' => $student->skills,
                    'description' => $student->description
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
