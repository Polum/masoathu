<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ObserverResponse extends Model
{
    
    protected $fillable = ['text', 'number', 'question_id', 'cashedId', 'region_id', 'district_id', 'constituency_id', 'ward_id', 'centre_id', 'correct_response', 'status', 'seen'];

    public function question()
    {
        return $this->belongsTo('App\ObserverChecklist', 'question_id');
    }
    
    public function district()
    {
        return $this->belongsTo('App\District');
    }
    
    public function region()
    {
        return $this->belongsTo('App\Region');
    }
    
    public function constituency()
    {
        return $this->belongsTo('App\Constituency');
    }
    
    public function ward()
    {
        return $this->belongsTo('App\Ward');
    }
    
    public function centre()
    {
        return $this->belongsTo('App\Centre');
    }

}
