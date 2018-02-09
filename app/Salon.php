<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{
    public function styles()
    {
        return $this->hasMany('App\Style');
    }

    public function services()
    {
        return $this->hasMany('App\Service')
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
