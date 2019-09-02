<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            if($user->user_type == 3){
                return redirect('/observer-reports');
            }
            else if($user->user_type == 4){
                return redirect('/rco');
            }
            else if($user->user_type == 5){
                return redirect('/zodiak');
            }
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
