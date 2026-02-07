<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\RequestModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class OnDemandVerificationController extends Controller
{
    public function generateNewCode(Request $request)
    {
        try {
            $email = $request->input('email');
            
            // Check if student exists
            $student = Student::where('email', $email)->first();
            
            if (!$student) {
                return response()->json([
                    'success' => false,
                    'message' => 'Student not found with this email'
                ], 404);
            }
            
            // Generate new verification code
            $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $verificationToken = Str::random(60);
            
            // Update student with new verification token
            $student->email_verification_token = $verificationToken;
            $student->email_verified_at = null; // Reset verification status
            $student->save();
            
            // Store new verification code
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $verificationToken,
                'verification_code' => $verificationCode,
                'created_at' => Carbon::now(),
                'code_expires_at' => Carbon::now()->addMinutes(30),
            ]);
            
            // Send new verification email
            try {
                Mail::to($email)->send(new \App\Mail\StudentEmailVerificationCodeMail($student, $verificationCode, $verificationToken));
                
                return response()->json([
                    'success' => true,
                    'message' => 'New verification code generated and sent!',
                    'student' => $student,
                    'verification_code' => $verificationCode,
                    'verification_token' => $verificationToken,
                    'expires_at' => Carbon::now()->addMinutes(30)->format('Y-m-d H:i:s'),
                    'note' => 'New code generated for email verification'
                ], 201);
                
            } catch (\Exception $e) {
                // Development mode - return verification code
                return response()->json([
                    'success' => true,
                    'message' => 'New verification code generated!',
                    'student' => $student,
                    'verification_code' => $verificationCode,
                    'verification_token' => $verificationToken,
                    'expires_at' => Carbon::now()->addMinutes(30)->format('Y-m-d H:i:s'),
                    'note' => 'Email service not configured - use the verification code above'
                ], 201);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function getLatestCode(Request $request)
    {
        try {
            $email = $request->input('email');
            
            // Get latest verification code for this email
            $latestCode = DB::table('password_resets')
                ->where('email', $email)
                ->orderBy('created_at', 'desc')
                ->first();
            
            if (!$latestCode) {
                return response()->json([
                    'success' => false,
                    'message' => 'No verification code found for this email'
                ], 404);
            }
            
            // Check if code is still valid
            $isValid = Carbon::now()->lt($latestCode->code_expires_at);
            
            return response()->json([
                'success' => true,
                'email' => $email,
                'verification_code' => $latestCode->verification_code,
                'verification_token' => $latestCode->token,
                'created_at' => $latestCode->created_at,
                'expires_at' => $latestCode->code_expires_at,
                'is_valid' => $isValid,
                'message' => $isValid ? 'Code is valid' : 'Code has expired'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
