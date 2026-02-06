<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentEmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $token;

    public function __construct($student, $token)
    {
        $this->student = $student;
        $this->token = $token;
    }

    public function build()
    {
        return $this->markdown('emails.student-email-verification')
            ->subject('Verify Your Email - Khedma4Students')
            ->with([
                'student' => $this->student,
                'token' => $this->token,
                'verificationUrl' => url('/verify-email?token=' . $this->token)
            ]);
    }
}
