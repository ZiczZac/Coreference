<?php

namespace App\Http\Middleware;

use Closure;

class RevisorMiddleware
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
        if($request->account_type != 3){
            return redirect('home');
        }
        return $next($request);
    }
}
