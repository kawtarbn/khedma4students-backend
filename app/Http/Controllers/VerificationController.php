<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VerificationController extends Controller
{
    public function getVerificationCode(Request $request)
    {
        $email = $request->email ?? 'kawtarbenabdelmoumene@gmail.com';
        
        try {
            // Check if there's a verification code
            $resetRecord = DB::table('password_resets')
                ->where('email', $email)
                ->orderBy('created_at', 'desc')
                ->first();
            
            if ($resetRecord && $resetRecord->code_expires_at > now()) {
                return response()->json([
                    'success' => true,
                    'email' => $email,
                    'verification_code' => $resetRecord->verification_code,
                    'expires_at' => $resetRecord->code_expires_at,
                    'message' => 'Use this code to verify your email'
                ]);
            } else {
                // Generate new verification code
                $token = Str::random(60);
                $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                
                // Delete any existing tokens for this email
                DB::table('password_resets')->where('email', $email)->delete();
                
                // Create new password reset record with code
                DB::table('password_resets')->insert([
                    'email' => $email,
                    'token' => $token,
                    'verification_code' => $verificationCode,
                    'created_at' => now(),
                    'code_expires_at' => now()->addMinutes(30)
                ]);
                
                return response()->json([
                    'success' => true,
                    'email' => $email,
                    'verification_code' => $verificationCode,
                    'expires_at' => now()->addMinutes(30),
                    'message' => 'New verification code generated. Use this code to verify your email.'
                ]);
            }
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    
    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:employers,email'
        ]);
        
        try {
            // Generate new verification code
            $token = Str::random(60);
            $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Delete any existing tokens for this email
            DB::table('password_resets')->where('email', $request->email)->delete();
            
            // Create new password reset record with code
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $token,
                'verification_code' => $verificationCode,
                'created_at' => now(),
                'code_expires_at' => now()->addMinutes(30)
            ]);
            
            return response()->json([
                'success' => true,
                'message' => 'Verification code sent successfully',
                'verification_code' => $verificationCode, // For development - remove in production
                'expires_in' => 30
            ]);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
