<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Session::has('loginid') && ($request->path()=='user/login') && $request->path()=='user/signup')
        {
            return redirect('/user/login')->with('error',"login first");
        }

        return $next($request);
    }
}
