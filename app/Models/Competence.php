<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'nom',
        'niveau',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
