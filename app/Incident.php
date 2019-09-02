<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-10
 * Time: 7:30 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Incident extends Model
{
    protected $table = 'incident_categories';

    protected $hidden = [

    ];

    protected $guarded = [];
}