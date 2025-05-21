<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'professor_email',
        'subject',
        'message',
        'attachment_path'
    ];

    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
} 