<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentPasswordResetMail extends Mailable
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
        return $this->markdown('emails.student-password-reset')
            ->subject('Reset Your Password - Khedma4Students')
            ->with([
                'student' => $this->student,
                'token' => $this->token,
                'resetUrl' => url('/reset-password?token=' . $this->token . '&email=' . $this->student->email)
            ]);
    }
}
