<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StudentEmailVerificationCodeMail extends Mailable
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
        return $this->view('emails.student-email-verification-code')
            ->subject('Verify Your Email - Khedma4Students')
            ->with([
                'student' => $this->student,
                'verificationCode' => $this->verificationCode,
                'token' => $this->token,
                'verificationUrl' => config('frontend.url') . '/verify-email?token=' . $this->token . '&email=' . $this->student->email
            ]);
    }
}
