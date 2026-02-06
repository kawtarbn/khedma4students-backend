<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HiringRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'employer_id',
        'service_id',
        'employer_name',
        'employer_email',
        'employer_phone',
        'message',
        'service_title',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function service()
    {
        return $this->belongsTo(RequestModel::class, 'service_id');
    }
}
