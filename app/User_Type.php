<?php
/**
 * Created by PhpStorm.
 * User: hp
 * Date: 2018-08-09
 * Time: 2:10 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class User_Type extends Model
{
    protected $table = 'user_types';

    protected $fillable = ['type'];

    protected $hidden = [

    ];

    protected $guarded = [];

    public function users(){
        return $this->hasMany('App\User');
    }
}