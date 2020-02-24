<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import model
use App\User;

class DummyData extends Controller
{
    //

    function insertUser(){

        //make a new object of model 
        $user = new User;
        //insert data to the table

        $user->first_name = 'Samson';
        $user->middle_name = 'Kimole';
        $user->last_name = 'Mutangili';
        $user->phone_no = '0718422812';
        $user->email = 'samsonkimole@gmail.com';
        $user->password = '123456';
        $user->id_no = 33044360;
        $user->gender = 'M';
        $user->category = 'deputy principal';
        $user->responsibilities = 'discipline and communication';
        $user->save();

        echo 'user details have been inserted successfully';


    }
}
