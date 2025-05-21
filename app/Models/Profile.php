<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
public function publications()
{
    return $this->hasMany(\App\Models\Publication::class, 'user_id', 'user_id');
}
    protected $fillable = [
        'user_id',
        'photo',
        'nom',
        'prenom',
        'statut',
        'email',
        'telephone',
        'adresse',
        'specialite',
        'reseaux_sociaux',
        'biographie',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function formations()
    {
        return $this->hasMany(Formation::class);
    }

    public function competences()
    {
        return $this->hasMany(Competence::class);
    }
}
