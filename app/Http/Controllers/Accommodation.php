<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dormitory;

class Accommodation extends Controller
{
    //
    //function that displays the dashboard
    public function dashboard(){

        return view('accommodation_dashboard');

    }

    public function showDormitories(){

        //get the available dormitories
        $dormitories = Dormitory::all();

        return view('dormitories', ['dormitories'=>$dormitories]);
    }
}
