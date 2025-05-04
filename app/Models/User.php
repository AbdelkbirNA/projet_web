<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'user_type', 'cne', 'matricule'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function publications()
{
    return $this->hasMany(Publication::class, 'user_id'); // Spécifiez explicitement la clé étrangère
}

    public function isProfessor()
    {
        return strtolower($this->user_type) === 'professor';
    }

    public function isStudent()
    {
        return strtolower($this->user_type) === 'student';
    }
}