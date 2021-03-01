<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Enums\UserRole;

    class Account extends Authenticatable
{
    use HasFactory, Notifiable;

    public function user()
    {
        $role = $this->role;
        switch ($role) {
            case UserRole::Student:{
                return $this->hasOne('App\Models\Student');
            }
            case UserRole::Instructor:{
                return $this->hasOne('App\Models\Instructor');
            }
            case UserRole::Admin:{
                return $this->hasOne('App\Models\Admin');
            }
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Scope a query to only include users of a given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOfRole($query, $type)
    {
        return $query->where('role', $type);
    }
}
