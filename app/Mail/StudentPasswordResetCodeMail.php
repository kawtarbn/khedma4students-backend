<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentPasswordResetCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $verificationCode;
    public $token;

    public function __construct($student, $verificationCode, $token)
    {
        $this->student = $student;
        $this->verificationCode = $verificationCode;
        $this->token = $token;
    }

    public function build()
    {
        return $this->view('emails.student-password-reset-code')
            ->subject('Password Reset Code - Khedma4Students')
            ->with([
                'student' => $this->student,
                'verificationCode' => $this->verificationCode,
                'token' => $this->token,
                'resetUrl' => config('frontend.url') . '/reset-password?email=' . $this->student->email
            ]);
    }
}
