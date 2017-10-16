<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Log;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $role2=null, $role3=null)
    {
        $roles = [$role, $role2, $role3];

        if(Auth::check()) {
          foreach($roles as $role) {
            if($role!=null && Auth::user()->role == $role) {
              return $next($request);
            }
          }
        }
      
        return redirect('/login');
    }
}
