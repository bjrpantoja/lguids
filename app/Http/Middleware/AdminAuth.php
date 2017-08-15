<?php

namespace app\Http\Middleware;

use Auth;
use Closure;

class AdminAuth
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
        if(Auth::user()->is_admin == 1) {
        	return $next($request);
            
        }
        return redirect(\URL::previous())->with('unauthorize', 'You do not have the privilege to access this page.');
    }
}