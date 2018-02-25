<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salon extends Model
{

    protected $fillable = [
        'name', 'longitude', 'latitude', 'opening_time', 'closing_time', 'image', 'user_id','rank'
    ];

    public function styles()
    {
        return $this->hasMany(Style::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    public function addStyle($style)
    {
        $this->styles->create([]);
    }
    public function addService($service)
    {
    }
    public function addRank()
    {
        $this->rank++;

        $this->save();
    }

    public function reduceRank()
    {
        // reduce rank according to scheduler after specific time;

        if($this->rank != 0)
        {
            $this->rank--;

            $this->save();
        }
        else
        {
            $this->rank = 0;

            $this->save();
        }
    }
}
