<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployerEmailVerificationCodeMail extends Mailable
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
        return $this->view('emails.employer-email-verification-code')
            ->subject('Verify Your Email - Khedma4Students')
            ->with([
                'employer' => $this->employer,
                'verificationCode' => $this->verificationCode,
                'token' => $this->token,
                'verificationUrl' => config('frontend.url') . '/employer-verify-email?token=' . $this->token . '&email=' . $this->employer->email
            ]);
    }
}
