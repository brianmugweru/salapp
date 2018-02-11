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

    public function salon(){
        return $this->hasMany('App\Salon');
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

    public function addSalon(Salon $salon)
    {
        $this->salon()->save($salon);
    }
}
