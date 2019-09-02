<?php

namespace App\Policies;
use App\User_Type;

// use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HasActionAccess
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function admin($user){
        if(!is_null($user->user_type)){
            if(User_Type::find($user->user_type)->type === 'Administrator'){
                return true;
            }
            return false;
        }
        return false;
    }

    public function rco($user){
        if(!is_null($user->user_type)){
            if(User_Type::find($user->user_type)->type === 'RCO'){
                return true;
            }
            return false;
        }
        return false;
    }

    public function clerk($user){
        if(!is_null($user->user_type)){
            if(User_Type::find($user->user_type)->type === 'Data Clerk'){
                return true;
            }
            return false;
        }
        return false;
    }

    public function user($user){
        if(!is_null($user->user_type)){
            if(User_Type::find($user->user_type)->type === 'System User'){
                return true;
            }
            return false;
        }
        return false;
    }
}
