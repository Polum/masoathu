<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-11
 * Time: 5:00 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $hidden = [

    ];

    protected $guarded = [];
}