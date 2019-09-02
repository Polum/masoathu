<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegionCluster extends Model
{
    protected $fillables = ['user_id', 'cluster'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
