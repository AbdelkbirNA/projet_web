<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'titre',
        'etablissement',
        'date_debut',
        'date_fin',
        'description',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
