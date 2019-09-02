<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-09
 * Time: 2:10 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    protected $table = 'sms';

    protected $hidden = [

    ];

    protected $guarded = [];
}