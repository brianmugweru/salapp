<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    public function salon(){
        return $this->belongsTo('App\Salon');
    }
}
