<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    public function students()
    {
        return $this->belongsToMany('App\Models\Student', 'favorite_topic');
    }
    public function courses()
    {
        // return $this->belongsToMany('App\Models\Course', 'course_topic', 'topic_id', 'course_id');
        return $this->belongsToMany('App\Models\Course');
    }
}
