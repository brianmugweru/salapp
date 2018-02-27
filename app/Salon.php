<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Salon extends Model
{
    protected $fillable = [
        'name', 'longitude', 'latitude', 'opening_time', 'closing_time', 'image', 'user_id','rank'
    ];

    protected $casts = [
        'opening_time'=>'',
        'closing_time'=>''
    ];

    public function setOpeningTimeAttribute($time)
    {
        $this->attributes['opening_time'] = Carbon::parse($time)->toTimeString();
    }
    public function setClosingTimeAttribute($time)
    {
        $this->attributes['closing_time'] = Carbon::parse($time)->toTimeString();
    }

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
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeSearch($query ,$salon)
    {
        return $query->where('name','LIKE', '%'.$salon.'%');
    }

    public function addRank()
    {
        $this->rank++;

        $this->save();
    }

    public function reduceRank()
    {
        $this->rank == 0 ? $this->rank = 0 : $this->rank--;

        $this->save();
    }
}
