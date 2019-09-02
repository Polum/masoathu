<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-07
 * Time: 9:39 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
class Admin_Division extends Model
{
    protected $table = 'admin_divisions';

    protected $hidden = [

    ];

    protected $guarded = [];
    public function administrativeDivisionsParent(){
        return $this->belongsTo('App\Admin_Division','parent_id');
    }

    public function administrativeDivisionsLevel(){
        return $this->belongsTo('App\Admin_Division_Level','level_id');
    }

    public function lowerAdmin(){
        return $this->hasMany('App\Admin_Division','parent_id');
    }
}