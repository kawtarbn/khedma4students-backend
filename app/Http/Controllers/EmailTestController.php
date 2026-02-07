<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailTestController extends Controller
{
    public function testEmail(Request $request)
    {
        try {
            $email = $request->input('email', 'test@example.com');
            $subject = 'Email Test - ' . date('Y-m-d H:i:s');
            $message = 'This is a test email from Khedma4Students backend at ' . date('Y-m-d H:i:s');
            
            // Test basic mail function
            Mail::raw($message, function ($message) use ($subject) {
                $message->subject($subject);
                $message->to($email);
            });
            
            return response()->json([
                'success' => true,
                'message' => 'Test email sent successfully',
                'email' => $email,
                'subject' => $subject,
                'message' => $message,
                'timestamp' => now()->format('Y-m-d H:i:s'),
                'mail_config' => [
                    'driver' => config('mail.default'),
                    'host' => config('mail.host'),
                    'port' => config('mail.port'),
                    'username' => config('mail.username'),
                    'encryption' => config('mail.encryption'),
                    'from_address' => config('mail.from.address'),
                    'from_name' => config('mail.from.name')
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'error_details' => [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ],
                'mail_config' => [
                    'driver' => config('mail.default'),
                    'host' => config('mail.host'),
                    'port' => config('mail.port'),
                    'username' => config('mail.username'),
                    'encryption' => config('mail.encryption'),
                    'from_address' => config('mail.from.address'),
                    'from_name' => config('mail.from.name')
                ]
            ], 500);
        }
    }
    
    public function checkMailConfig()
    {
        return response()->json([
            'mail_driver' => config('mail.default'),
            'mail_host' => config('mail.host'),
            'mail_port' => config('mail.port'),
            'mail_username' => config('mail.username'),
            'mail_encryption' => config('mail.encryption'),
            'mail_from_address' => config('mail.from.address'),
            'mail_from_name' => config('mail.from.name'),
            'environment_variables' => [
                'MAIL_MAILER' => env('MAIL_MAILER'),
                'MAIL_HOST' => env('MAIL_HOST'),
                'MAIL_PORT' => env('MAIL_PORT'),
                'MAIL_USERNAME' => env('MAIL_USERNAME'),
                'MAIL_PASSWORD' => env('MAIL_PASSWORD') ? '***HIDDEN***' : 'NOT_SET',
                'MAIL_ENCRYPTION' => env('MAIL_ENCRYPTION'),
                'MAIL_FROM_ADDRESS' => env('MAIL_FROM_ADDRESS'),
                'MAIL_FROM_NAME' => env('MAIL_FROM_NAME'),
            ],
            'app_env' => env('APP_ENV'),
            'app_debug' => env('APP_DEBUG'),
            'timestamp' => now()->format('Y-m-d H:i:s')
        ]);
    }
}
