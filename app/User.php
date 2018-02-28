<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function salons()
    {
        return $this->hasMany(Salon::class);
    }

    public function salonLikes()
    {
        return $this->belongsToMany(Salon::class,'likes');
    }

    public static $rules = [
        'name' => 'required',
        'email'=>'required|email',
        'password'=>'required|confirmed'
    ];

    public static $sessionrules = [
        'email'=>'required|email',
        'password'=>'required'
    ];
}
