<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User_Type;

class ClerkAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if(!is_null($user->user_type)){
            if(User_Type::find($user->user_type)->type === 'Data Clerk'){
                return $next($request);
            }
            return redirect('/');
        }
        return redirect('/');  
    }
}
