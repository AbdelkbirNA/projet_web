<?php

namespace App\Models;
use App\Models\Question;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

protected $fillable = [
    'title',
    'description',
    'syllabus',
    'course_date',
    'resources',
    'user_id', // 👈 AJOUTEZ CECI
    'type',    // 👈 à ne pas oublier puisque vous le passez aussi
];

    protected $casts = [
        'course_date' => 'datetime',
    ];
    public function questions()
{
    return $this->hasMany(Question::class);
}


}
