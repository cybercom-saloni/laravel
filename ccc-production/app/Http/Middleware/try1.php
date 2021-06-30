<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class try1
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
        // if ($request->name)
        // {
        //     echo 'middleware applied';
        // }
        $ip = 1234;
        if($ip =='::1')
        {
            echo 'j';
            return redirect('/error');
        }
        return $next($request);
    }
}
