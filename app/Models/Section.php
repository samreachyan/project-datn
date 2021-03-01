<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
    public function lessons()
    {
        return $this->hasMany('App\Models\Lesson');
    }
    public function quizzes()
    {
        return $this->hasMany('App\Models\Quiz');
    }
    public function students()
    {
        return $this->belongsToMany('App\Models\Student', 'section_student', 'section_id', 'student_id')->withPivot('highest_point', 'lesson_id');
    }
}
