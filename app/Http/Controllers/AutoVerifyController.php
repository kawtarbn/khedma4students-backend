<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AutoVerifyController extends Controller
{
    public function autoVerifyEmail(Request $request)
    {
        try {
            $email = $request->email;
            
            if (!$email) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email parameter is required'
                ], 400);
            }
            
            // Find the student
            $student = Student::where('email', $email)->first();
            
            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found with this email'
                ], 404);
            }
            
            // Auto-verify the student
            $student->update([
                'email_verified_at' => Carbon::now(),
                'email_verification_token' => null
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Email automatically verified successfully!',
                'student' => $student,
                'note' => 'You can now login with your credentials'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Failed to auto-verify email'
            ], 500);
        }
    }
}
