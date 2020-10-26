<?php

namespace App\Http\Middleware;

use Closure;

class MarksEntryChecker
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
        if($request->session()->get('username') == null){
            return redirect('/');
        }

        if(!$request->session()->get('is_teacher')){
            return redirect('/');
        }
        return $next($request);
    }
}
