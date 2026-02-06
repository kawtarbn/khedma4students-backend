<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Employer extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'full_name', 'email', 'password', 'company', 'city',
        'contact_person', 'phone', 'location', 'description',
        'email_verified_at', 'email_verification_token'
    ];

    protected $hidden = ['password', 'email_verification_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}