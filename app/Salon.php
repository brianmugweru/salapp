<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{

    protected $fillable = [
        'name', 'longitude', 'latitude', 'opening_time', 'closing_time', 'image', 'user_id'
    ];

    public function styles()
    {
        return $this->hasMany('App\Style');
    }

    public function services()
    {
        return $this->hasMany('App\Service');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
