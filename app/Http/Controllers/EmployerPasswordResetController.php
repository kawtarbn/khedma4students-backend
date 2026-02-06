<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;

class EmployerPasswordResetController extends Controller
{
    // Send password reset link with verification code
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:employers,email'
        ]);

        $token = Str::random(60);
        $verificationCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Get employer for email
        $employer = Employer::where('email', $request->email)->first();
        
        // Delete any existing tokens for this email
        DB::table('password_resets')->where('email', $request->email)->delete();
        
        // Create new password reset record with code
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'verification_code' => $verificationCode,
            'created_at' => Carbon::now(),
            'code_expires_at' => Carbon::now()->addMinutes(30)
        ]);

        // Send email with verification code
        $resetUrl = config('frontend.url') . '/employer-reset-password?email=' . $request->email;
        
        // Log the email content for development
        \Log::info('Employer password reset code sent', [
            'email' => $request->email,
            'verification_code' => $verificationCode,
            'token' => $token,
            'reset_url' => $resetUrl,
            'employer' => $employer->toArray()
        ]);
        
        // Try to send email, fallback to development mode
        try {
            Mail::to($request->email)->send(new \App\Mail\EmployerPasswordResetCodeMail($employer, $verificationCode, $token));
            
            return response()->json([
                'message' => 'Password reset code sent to your email',
                'reset_url' => $resetUrl
            ]);
        } catch (\Exception $e) {
            // Development mode - show all info
            return response()->json([
                'message' => 'Password reset code prepared',
                'email' => $request->email,
                'verification_code' => $verificationCode,
                'token' => $token,
                'reset_url' => $resetUrl,
                'note' => 'Email service not configured - use the verification code above',
                'debug' => 'Code logged to Laravel logs'
            ]);
        }
    }

    // Reset password with verification code
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:employers,email',
            'verification_code' => 'required|digits:6',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ], [
            'password.regex' => 'Password must be at least 8 characters and contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
        ]);

        // Check if verification code exists and is valid (within 30 minutes)
        $resetRecord = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('verification_code', $request->verification_code)
            ->where('code_expires_at', '>', Carbon::now())
            ->first();

        if (!$resetRecord) {
            return response()->json(['message' => 'Invalid or expired verification code'], 400);
        }

        // Update password
        $employer = Employer::where('email', $request->email)->first();
        $employer->password = Hash::make($request->password);
        $employer->save();

        // Delete the reset record
        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Password reset successfully']);
    }

    // Alternative method: Reset with token (for backward compatibility)
    public function resetPasswordWithToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:employers,email',
            'token' => 'required',
            'password' => 'required|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ], [
            'password.regex' => 'Password must be at least 8 characters and contain at least one uppercase letter, one lowercase letter, one number, and one special character.'
        ]);

        // Check if token exists and is valid (within 60 minutes)
        $resetRecord = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->where('created_at', '>', Carbon::now()->subMinutes(60))
            ->first();

        if (!$resetRecord) {
            return response()->json(['message' => 'Invalid or expired token'], 400);
        }

        // Update password
        $employer = Employer::where('email', $request->email)->first();
        $employer->password = Hash::make($request->password);
        $employer->save();

        // Delete the reset token
        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Password reset successfully']);
    }

    // Send email verification
    public function sendEmailVerification(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:employers,email'
        ]);

        $employer = Employer::where('email', $request->email)->first();
        
        if ($employer->email_verified_at) {
            return response()->json(['message' => 'Email already verified'], 200);
        }

        $token = Str::random(60);
        $employer->email_verification_token = $token;
        $employer->save();

        // Send verification email (for now, return token for development)
        // In production, you would send an actual email here
        return response()->json([
            'message' => 'Verification email sent',
            'token' => $token // Remove this in production
        ]);
    }

    // Verify email with verification code
    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verification_code' => 'required|digits:6'
        ]);

        // Check if verification code exists and is valid (within 30 minutes)
        $resetRecord = DB::table('password_resets')
            ->where('email', $request->email)
            ->where('verification_code', $request->verification_code)
            ->where('code_expires_at', '>', Carbon::now())
            ->first();

        if (!$resetRecord) {
            return response()->json(['message' => 'Invalid or expired verification code'], 400);
        }

        // Find employer by email
        $employer = Employer::where('email', $request->email)->first();

        if (!$employer) {
            return response()->json(['message' => 'Employer not found'], 404);
        }

        // Mark email as verified
        $employer->email_verified_at = Carbon::now();
        $employer->email_verification_token = null;
        $employer->save();

        // Delete the verification record
        DB::table('password_resets')->where('email', $request->email)->delete();

        return response()->json(['message' => 'Email verified successfully']);
    }

    // Alternative method: Verify email with token (for backward compatibility)
    public function verifyEmailWithToken(Request $request)
    {
        $request->validate([
            'token' => 'required'
        ]);

        $employer = Employer::where('email_verification_token', $request->token)->first();

        if (!$employer) {
            return response()->json(['message' => 'Invalid verification token'], 400);
        }

        $employer->email_verified_at = Carbon::now();
        $employer->email_verification_token = null;
        $employer->save();

        return response()->json(['message' => 'Email verified successfully']);
    }

    // Resend verification email
    public function resendVerification(Request $request)
    {
        return $this->sendEmailVerification($request);
    }
}
