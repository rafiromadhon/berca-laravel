<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Login as Middleware;
use Illuminate\Http\Request;

class Login
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
        if (!$request->session()->get('login') == TRUE) {
            return redirect('login');
        }

        return $next($request);
    }
}
