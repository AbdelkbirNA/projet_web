<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class publication extends Model
{
    use HasFactory;



    protected $fillable = [
        'titre_pub',
        'year',
        'image',
        'description'
    ];
    protected $casts = [
        'year' => 'date',
    ];
}
