<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployerPasswordResetCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employer;
    public $verificationCode;
    public $token;

    public function __construct($employer, $verificationCode, $token)
    {
        $this->employer = $employer;
        $this->verificationCode = $verificationCode;
        $this->token = $token;
    }

    public function build()
    {
        return $this->view('emails.employer-password-reset-code')
            ->subject('Password Reset Code - Khedma4Students')
            ->with([
                'employer' => $this->employer,
                'verificationCode' => $this->verificationCode,
                'token' => $this->token,
                'resetUrl' => config('frontend.url') . '/employer-reset-password?email=' . $this->employer->email
            ]);
    }
}
