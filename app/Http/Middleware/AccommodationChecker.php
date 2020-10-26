<?php

namespace App\Http\Middleware;

use Closure;

class AccommodationChecker
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

        if($request->session()->get('teacher_id') == null){
            return redirect('/');
        }

        if(!$request->session()->get('is_boardingMaster')){
            return redirect('/');
        }
       

        return $next($request);
    }
}
