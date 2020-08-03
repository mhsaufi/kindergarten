<?php

namespace App\Http\Middleware;

use Closure;

class CheckParent
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
        if(auth()->user()->hasRole('teacher')){

            return redirect('/panel');
        }else if(auth()->user()->hasRole('admin')){

            return redirect('/dashboard');
        }

        return $next($request);  
    }
}
