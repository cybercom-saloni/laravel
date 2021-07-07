<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;

class CheckUserLoginStatus
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
            
            return $next($request);


    }
}
