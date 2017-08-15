<?php

namespace app\Http\Middleware;

use Auth;
use Closure;

class VerifySession
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
        if(Auth::check()) {
            return redirect('backdoor/profile');
        }
        return $next($request);
    }
}
