<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Connect extends Model
{
    use HasFactory;
    public function instructor()
    {
        return $this->belongsToMany('App\Models\Instructor');
    }
}
