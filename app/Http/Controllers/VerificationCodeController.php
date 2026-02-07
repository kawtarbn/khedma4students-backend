<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VerificationCodeController extends Controller
{
    public function getLatestVerificationCode(Request $request)
    {
        try {
            $email = $request->email;
            
            if (!$email) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email parameter is required'
                ], 400);
            }
            
            // Get the latest verification code for this email
            $verification = DB::table('password_resets')
                ->where('email', $email)
                ->where('code_expires_at', '>', Carbon::now())
                ->orderBy('created_at', 'desc')
                ->first();
            
            if (!$verification) {
                return response()->json([
                    'success' => false,
                    'message' => 'No valid verification code found for this email'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'email' => $email,
                'verification_code' => $verification->verification_code,
                'token' => $verification->token,
                'expires_at' => $verification->code_expires_at,
                'message' => 'Use this verification code to complete registration'
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Failed to retrieve verification code'
            ], 500);
        }
    }
    
    public function verifyWithCode(Request $request)
    {
        try {
            $email = $request->email;
            $code = $request->verification_code;
            
            if (!$email || !$code) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email and verification code are required'
                ], 400);
            }
            
            // Find the verification record
            $verification = DB::table('password_resets')
                ->where('email', $email)
                ->where('verification_code', $code)
                ->where('code_expires_at', '>', Carbon::now())
                ->first();
            
            if (!$verification) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid or expired verification code'
                ], 400);
            }
            
            // Update student email verification
            DB::table('students')
                ->where('email', $email)
                ->update([
                    'email_verified_at' => Carbon::now(),
                    'email_verification_token' => null
                ]);
            
            // Delete the verification record
            DB::table('password_resets')
                ->where('email', $email)
                ->where('verification_code', $code)
                ->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Email verified successfully!',
                'email' => $email
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'message' => 'Failed to verify email'
            ], 500);
        }
    }
}
