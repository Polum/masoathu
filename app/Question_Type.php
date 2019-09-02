<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-12
 * Time: 7:34 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Question_Type extends Model
{
    protected $table = 'question_types';

    protected $hidden = [

    ];

    protected $guarded = [];
}