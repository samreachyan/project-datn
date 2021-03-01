<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function instructor()
    {
        return $this->belongsTo('App\Models\Instructor', 'instructor_id');
    }
    public function students()
    {
        return $this->belongsToMany('App\Models\Student', 'course_student', 'course_id', 'student_id')->withPivot('progress', 'section_id');
    }

    public function rates()
    {
        return $this->belongsToMany('App\Models\Student', 'course_student', 'course_id', 'student_id')
            ->selectRaw('course_student.progress as rate');
    }
    public function topics()
    {
        // return $this->belongsToMany('App\Models\Topic', 'course_topic', 'course_id', 'topic_id');
        return $this->belongsToMany('App\Models\Topic');
    }
    public function sections()
    {
        return $this->hasMany('App\Models\Section');
    }
}
