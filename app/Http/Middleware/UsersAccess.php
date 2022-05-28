<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class UsersAccess
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
      if (Auth::user() &&  Auth::user()->is_supper_admin == 0) {
            return $next($request);
       }
       return redirect('admin')->with('error','You have supper admin access.');
    }
}
