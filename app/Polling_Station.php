<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-08
 * Time: 4:46 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Polling_Station extends Model
{
    protected $table = 'polling_stations';

    protected $hidden = [

    ];

    protected $guarded = [];

    public function administrativeDivisions(){
        return $this->belongsTo('App\Admin_Division','parent_id');
    }


}