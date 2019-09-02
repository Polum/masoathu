<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 12/4/18
 * Time: 4:36 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Correct_SMS extends Model
{
    protected $table = 'correct_sms_new';

    protected $hidden = [

    ];

    protected $guarded = [];

    public function registrationCenter(){
        return $this->belongsTo('App\Polling_Station','center_id');
    }

    public function originalSms(){
        return $this->belongsTo('App\Sms','sms_id');
    }
}