<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    protected $fillables = ['name','constituency_id','code'];

    public function centres()
    {
        return $this->hasMany('App\Centre', 'ward_id');
    }

    public function constituency()
    {
        return $this->belongsTo('App\Constituency', 'constituency_id');
    }
    
    public function response(){
        return $this->hasMany('App\ObserverResponse');
    }
}
