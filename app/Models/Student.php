<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'students';

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'university',
        'city',
        'phone',
        'skills',
        'description',
        'email_verified_at',
        'email_verification_token'
    ];

    protected $hidden = [
        'password',
        'email_verification_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
