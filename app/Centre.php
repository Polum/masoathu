<?php

namespace App;
use App\Ward;

use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    
    public function ward()
    {
        return $this->belongsTo('App\Ward');
    }
    
    public function response(){
        return $this->hasMany('App\ObserverResponse');
    }
}
