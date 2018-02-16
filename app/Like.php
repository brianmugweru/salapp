<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Like extends Pivot
{
    public $table = 'likes';

    protected $fillable = ['user_id', 'salon_id'];

    public function salon(){
        return $this->belongsTo('App\Salon');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
