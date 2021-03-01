<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory, Notifiable;
    protected $primaryKey = 'account_id';

    public function account()
    {
        return $this->belongsTo('App\Models\Account');
    }
    public function courses()
    {
        return $this->belongsToMany('App\Models\Course', 'course_student', 'student_id', 'course_id')->withPivot('progress', 'section_id');
    }
    public function sections()
    {
        return $this->belongsToMany('App\Models\Section', 'section_student', 'student_id', 'section_id')->withPivot('highest_point', 'lesson_id');
    }
    public function topics()
    {
        return $this->belongsToMany('App\Models\Topic', 'favorite_topic');
    }
    public function follows()
    {
        return $this->belongsToMany('App\Models\Instructor', 'follows', 'student_id', 'instructor_id');
    }

    public function follow($instructor_id)
    {
        $this->follows()->attach($instructor_id);
        return $this;
    }

    public function unfollow($instructor_id)
    {
        $this->follows()->detach($instructor_id);
        return $this;
    }
    public function isFollowing($instructor_id)
    {
        return (boolean) $this->follows()->where('instructor_id', $instructor_id)->first(['account_id']);
    }
}
