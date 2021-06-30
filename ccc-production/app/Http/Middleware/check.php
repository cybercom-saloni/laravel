<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class check
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
        // echo 'in middleware';
        // if($request->age && $request->age < 10)
        // {
        //     return redirect('error');
        // }
        // // echo '12123'.session('loginname');
        return $next($request);
    }
}
