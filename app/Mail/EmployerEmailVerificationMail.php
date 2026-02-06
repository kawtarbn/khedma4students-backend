<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployerEmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employer;
    public $token;

    public function __construct($employer, $token)
    {
        $this->employer = $employer;
        $this->token = $token;
    }

    public function build()
    {
        return $this->markdown('emails.employer-email-verification')
            ->subject('Verify Your Email - Khedma4Students')
            ->with([
                'employer' => $this->employer,
                'token' => $this->token,
                'verificationUrl' => url('/employer-verify-email?token=' . $this->token)
            ]);
    }
}
