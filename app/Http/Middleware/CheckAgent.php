<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth as Auth;

class CheckAgent
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
	    if($_SERVER ['HTTP_USER_AGENT'] !== 'LuaSocket 3.0-rc1')
	    {
		    return abort(404);
	    }
        return $next($request);
    }
}
