<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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

        }else if(auth()->user()->hasRole('parent')){

            return redirect('/home');
        }

        return $next($request);
    }
}
