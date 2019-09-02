<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Constituency extends Model
{
    public function districts(){
        return $this->belongsTo('App\District','district_id');
    }
    public function wards(){
        return $this->hasMany('App\Ward','constituency_id');
    }
    
    public function response(){
        return $this->hasMany('App\ObserverResponse');
    }

    public function district(){
        return $this->belongsTo('App\District');
    }
}
