<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Booking extends Pivot
{
    public $table = 'bookings';

    protected $fillable = ['user_id', 'salon_id','time','style'];

    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
