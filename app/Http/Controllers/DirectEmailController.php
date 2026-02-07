<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DirectEmailController extends Controller
{
    public function testDirectEmail()
    {
        try {
            // Override mail configuration with hardcoded values
            config(['mail.default' => 'smtp']);
            config(['mail.mailers.smtp.host' => 'smtp.gmail.com']);
            config(['mail.mailers.smtp.port' => 587]);
            config(['mail.mailers.smtp.username' => 'khedma4students@gmail.com']);
            config(['mail.mailers.smtp.password' => 'vwgguxviwzyhcqck']);
            config(['mail.mailers.smtp.encryption' => 'tls']);
            config(['mail.from.address' => 'khedma4students@gmail.com']);
            config(['mail.from.name' => 'Khedma4Students']);
            
            Log::info('Testing direct email with hardcoded config');
            
            // Send test email
            Mail::raw('This is a test email from Khedma4Students backend.', function ($message) {
                $message->subject('Direct Email Test - Khedma4Students');
                $message->to('test@example.com');
            });
            
            return response()->json([
                'success' => true,
                'message' => 'Direct email sent successfully!',
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
            Log::error('Direct email test failed: ' . $e->getMessage());
            
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
    
    public function sendVerificationEmail(Request $request)
    {
        try {
            $email = $request->email;
            $verificationCode = $request->verification_code ?? '123456';
            
            // Override mail configuration with hardcoded values
            config(['mail.default' => 'smtp']);
            config(['mail.mailers.smtp.host' => 'smtp.gmail.com']);
            config(['mail.mailers.smtp.port' => 587]);
            config(['mail.mailers.smtp.username' => 'khedma4students@gmail.com']);
            config(['mail.mailers.smtp.password' => 'vwgguxviwzyhcqck']);
            config(['mail.mailers.smtp.encryption' => 'tls']);
            config(['mail.from.address' => 'khedma4students@gmail.com']);
            config(['mail.from.name' => 'Khedma4Students']);
            
            Log::info("Sending verification email to: $email with code: $verificationCode");
            
            // Send verification email
            Mail::raw("Your verification code is: $verificationCode", function ($message) use ($email) {
                $message->subject('Khedma4Students - Email Verification Code');
                $message->to($email);
            });
            
            return response()->json([
                'success' => true,
                'message' => 'Verification email sent successfully!',
                'email' => $email,
                'verification_code' => $verificationCode
            ]);
            
        } catch (\Exception $e) {
            Log::error('Verification email failed: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'email' => $request->email
            ], 500);
        }
    }
}
