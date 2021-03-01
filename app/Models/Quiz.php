<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }
    public function answers()
    {
        return $this->hasMany('App\Models\Answer');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($quiz) {
            $quiz->answers()->delete();
        });
    }
}
