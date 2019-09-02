<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    protected $table = 'user_details';

    protected $fillable = ['district_id', 'user_id', 'phone_number'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function district(){
        return $this->belongsTo('App\District');
    }
}
