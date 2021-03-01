<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    protected $fillable = ['account_id', 'provider_user_id', 'provider'];

    public function user()
    {
        return $this->belongsTo('App\Models\Account');
    }
}
