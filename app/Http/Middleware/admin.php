<?php

namespace App\Http\Middleware;

use Closure;
use Session;


class admin
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
        if (Session::get('admin_user_id')) {

               return $next($request);
        }
		
		return redirect('/admin/login');
    }
}
