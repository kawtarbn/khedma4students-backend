<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmployerPasswordResetMail extends Mailable
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
        return $this->markdown('emails.employer-password-reset')
            ->subject('Reset Your Password - Khedma4Students')
            ->with([
                'employer' => $this->employer,
                'token' => $this->token,
                'resetUrl' => url('/employer-reset-password?token=' . $this->token . '&email=' . $this->employer->email)
            ]);
    }
}
