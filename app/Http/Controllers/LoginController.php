<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import the user model
use App\User;

use Illuminate\Support\Facades\DB;


class LoginController extends Controller
{
    //

    //function that determines the type of user and redirects to the correct page
    public function submitDetails(Request $request){

       //get the details from the form
       $user_category = $request->input('user_category');
       $email = $request->input('email');
       $password = $request->input('password');

       

       $user_exists = DB::table('users')
                    ->where('email', $email)
                    ->get();

        //add the user details to a session
        $request->session()->put('user', $user_exists);
        $user_data = $request->session()->get('user');

        foreach($user_exists as $user){
            if($user->category == 'examination'){
                return view('add_student', ['user_first_name'=>$user->first_name]);
            }        
            

        }
           
            
      
        echo $user_exists .'<br><br>';
       echo 'user category: '.$user_category.'<br>';
       echo 'user email is: '.$email.'<br>';
       echo 'Password is: '.$password.'<br>';





    }

    public function resetPassword(Request $request){

        //get the email from the user
        $email = $request->input('email');

        //get the password from the form
        $password = $request->input('password');

        //update the password 
        $query = DB::table('users')
                ->where('email', $email)
                ->update([
                    'password'=>$password
                ]);

        if($query > 0){

            echo $email . '<br>';
            echo 'your password has been updated';

        } else {
            echo $email . '<br>';
            echo 'your password has not been updated';
        }

    }


}
