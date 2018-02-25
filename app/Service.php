<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'time_taken', 'image', 'salon_id'
    ];
    public function salon()
    {
        return $this->belongsTo(Salon::class);
    }
}
