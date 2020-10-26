<?php

namespace App\Http\Middleware;

use Closure;

class ResultSlipsChecker
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

        if($request->session()->get('is_principal') || $request->session()->get('is_deputy_principal') || $request->session()->get('is_in_examination_and_student_admission') ){
            return $next($request);
        } else{
            return redirect('/');
        }
        
    }
}
