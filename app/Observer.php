<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-11
 * Time: 6:24 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Observer extends Model
{
    protected $table = 'observers';

    protected $hidden = [

    ];

    protected $guarded = [];
}