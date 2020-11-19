<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Config;
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
			
			 // IF DOUBLE AUTHENTICATION IS OFF : ANALYST/ADMIN/USER/USER_ADMIN 
			 return redirect(redirect_route_name());
           // return redirect('/users');
        }

        return $next($request);
    }
}
