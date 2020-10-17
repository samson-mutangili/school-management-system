<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //

    public function logout(Request $request){

        //clear all the data from the session
        $request->session()->flush();

        //redirect to home page
       return redirect('/');
    }
}
