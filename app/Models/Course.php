<?php

namespace App\Models;
use App\Models\Question;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'syllabus', 'resources', 'course_date'];

    protected $casts = [
        'course_date' => 'datetime',
    ];
    public function questions()
{
    return $this->hasMany(Question::class);
}


}
