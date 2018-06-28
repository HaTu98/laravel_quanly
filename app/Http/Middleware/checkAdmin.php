<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class checkAdmin
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
        if ( session::get('user.role') != 1) {
            return redirect('/home');
        }
        return $next($request);
    }
}
