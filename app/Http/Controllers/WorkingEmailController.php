<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class WorkingEmailController extends Controller
{
    public function testWorkingEmail()
    {
        try {
            // Force load email configuration
            config([
                'mail.default' => 'smtp',
                'mail.mailers.smtp.host' => 'smtp.gmail.com',
                'mail.mailers.smtp.port' => 587,
                'mail.mailers.smtp.username' => 'khedma4students@gmail.com',
                'mail.mailers.smtp.password' => 'vwgguxviwzyhcqck',
                'mail.mailers.smtp.encryption' => 'tls',
                'mail.from.address' => 'khedma4students@gmail.com',
                'mail.from.name' => 'Khedma4Students',
            ]);
            
            Log::info('Testing working email with forced config');
            
            // Send test email
            Mail::raw('This is a test email from Khedma4Students backend. Email system is working!', function ($message) {
                $message->subject('✅ Email System Working - Khedma4Students');
                $message->to('test@example.com');
            });
            
            return response()->json([
                'success' => true,
                'message' => 'Working email sent successfully!',
                'config' => [
                    'driver' => config('mail.default'),
                    'host' => config('mail.mailers.smtp.host'),
                    'port' => config('mail.mailers.smtp.port'),
                    'username' => config('mail.mailers.smtp.username'),
                    'from_address' => config('mail.from.address'),
                    'from_name' => config('mail.from.name')
                ]
            ]);
            
        } catch (\Exception $e) {
            Log::error('Working email test failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'config' => [
                    'driver' => config('mail.default'),
                    'host' => config('mail.mailers.smtp.host'),
                    'port' => config('mail.mailers.smtp.port'),
                    'username' => config('mail.mailers.smtp.username'),
                    'from_address' => config('mail.from.address'),
                    'from_name' => config('mail.from.name')
                ]
            ], 500);
        }
    }
    
    public function sendVerificationEmailGeneral(Request $request)
    {
        try {
            $email = $request->email;
            $verificationCode = $request->verification_code ?? str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            
            // Force load email configuration
            config([
                'mail.default' => 'smtp',
                'mail.mailers.smtp.host' => 'smtp.gmail.com',
                'mail.mailers.smtp.port' => 587,
                'mail.mailers.smtp.username' => 'khedma4students@gmail.com',
                'mail.mailers.smtp.password' => 'vwgguxviwzyhcqck',
                'mail.mailers.smtp.encryption' => 'tls',
                'mail.from.address' => 'khedma4students@gmail.com',
                'mail.from.name' => 'Khedma4Students',
            ]);
            
            Log::info("Sending verification email to: $email with code: $verificationCode");
            
            // Send verification email
            Mail::raw("Your verification code is: $verificationCode\n\nThis code will expire in 30 minutes.\n\nThank you for registering with Khedma4Students!", function ($message) use ($email) {
                $message->subject('Khedma4Students - Email Verification Code');
                $message->to($email);
            });
            
            return response()->json([
                'success' => true,
                'message' => 'Verification email sent successfully!',
                'email' => $email,
                'verification_code' => $verificationCode,
                'note' => 'Please check your email inbox (including spam folder)'
            ]);
            
        } catch (\Exception $e) {
            Log::error('General verification email failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'email' => $request->email,
                'verification_code' => $verificationCode ?? 'N/A',
                'fallback' => 'Use the verification code above to complete registration'
            ], 500);
        }
    }
}
