<?php

namespace App\Http\Middleware;

use Closure;

class Principal_DPChecker
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

        if($request->session()->get('is_principal') || $request->session()->get('is_deputy_principal')){
            return $next($request);
        } else{
            return redirect('/');
        }
    }
}
