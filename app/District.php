<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function districts(){
        return $this->hasMany('App\Constituency','district_id');
    }

    public function constituencies(){
        return $this->hasMany('App\Constituency','district_id');
    }
    
    public function response(){
        return $this->hasMany('App\ObserverResponse');
    }
}
