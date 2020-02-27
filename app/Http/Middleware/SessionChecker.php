<?php

namespace App\Http\Middleware;

use Closure;

class SessionChecker
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

        if($request->session()->get('teacher_data') == null){
            return redirect('/');
        }

        return $next($request);
    }
}
