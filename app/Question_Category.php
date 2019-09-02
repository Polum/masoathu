<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-11
 * Time: 4:23 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Question_Category extends Model
{
    protected $table = 'question_categories';

    protected $hidden = [

    ];

    protected $guarded = [];
}