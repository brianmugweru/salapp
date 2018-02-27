<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $fillable = [
        'name', 'time_taken', 'image', 'salon_id'
    ];
    public function salon(){
        return $this->belongsTo(Salon::class);
    }
    /*protected $appends = [
        'link'
    ];
    public function linkAttribute(){
        return $this->image;   
    }*/
}
