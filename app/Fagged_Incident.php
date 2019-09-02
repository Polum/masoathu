<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fagged_Incident extends Model
{
	
    protected $table = 'flagged_incident';

    protected $hidden = [

    ];

    protected $guarded = [];

    public function report(){
        return $this->belongsTo('App\Sms','incident_id');
    }
}
