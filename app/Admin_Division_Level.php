<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-07
 * Time: 2:43 AM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Admin_Division_Level extends Model
{
    //use SoftDeletes;

    protected $table = 'admin_division_levels';

    protected $hidden = [

    ];

    protected $guarded = [];


}