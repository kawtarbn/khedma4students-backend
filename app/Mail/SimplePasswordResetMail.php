<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SimplePasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;
    public $userType;

    public function __construct($user, $token, $userType = 'student')
    {
        $this->user = $user;
        $this->token = $token;
        $this->userType = $userType;
    }

    public function build()
    {
        $resetUrl = $this->userType === 'student' 
            ? url('/reset-password?token=' . $this->token . '&email=' . $this->user->email)
            : url('/employer-reset-password?token=' . $this->token . '&email=' . $this->user->email);

        return $this->view('emails.simple-password-reset')
            ->subject('Reset Your Password - Khedma4Students')
            ->with([
                'user' => $this->user,
                'token' => $this->token,
                'resetUrl' => $resetUrl,
                'userType' => $this->userType
            ]);
    }
}
