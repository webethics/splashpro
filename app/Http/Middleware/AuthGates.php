<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Gate;

class AuthGates
{
    public function handle($request, Closure $next)
    {
        $user = \Auth::user();
        if (!app()->runningInConsole() && $user) {
            $roles = Role::all();
			
             foreach ($roles as $key=> $role) {

                   // $roles1[] = $role->id;
				  // pr( $role);
			//echo $role->slug.'=='. $role->id;
				 Gate::define($role->slug, function ($user)  use ($role) {
					return $user->role_id == $role->id;
				});
			
			
					
					
                
            } 
		//	pr($roles1);
			//die;
		//foreach ($roles1 as $title => $roles) {
			
		//echo $title; die;
			//pr($user->user_role);
			
				
		
			
       // }
		
		
            /* foreach ($permissionsArray as $title => $roles) {
				
                Gate::define($title, function (\App\User $user) use ($roles) {
					
                    return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
                });
            } */
        }

        return $next($request);
    }
}
