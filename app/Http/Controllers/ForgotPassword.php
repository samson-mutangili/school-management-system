<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import the model
use App\User;
use Illuminate\Support\Facades\DB;

class ForgotPassword extends Controller
{
    public $user_email = "";

    public function submit(Request $request){

    //get the email from the form
    $email = $request->input('email');
    $user_email = $email;

    //select the user from the database depending on the email
    $user_details = User::where('email', $email)->get();

    //generate a random number
    $token = $this->generateToken();
    
    //check if there is a user
    if( !$user_details->isEmpty()){
        //create a flash session and put a token data into it
        $request->session()->put('token', $token);

        //send email inorder for the user to get the token

        //return to home page
        return view('input_token', ['user_email'=>$user_email]);

    } else{
        return view('forgot_password', ['no_user'=>"User with that email address does not exist!!", 'email'=>$email]);
    }
 

    }

    

     //function that generates a specific token
     public function generateToken(){
        //generate a random number
        $token = rand(10000, 999999);

        //check if token was already generated
        $token_exists = DB::table('password_resets')
                        ->where('token', $token)
                        ->get();
        if( !$token_exists->isEmpty()){
            generateToken();
        } else{
            return $token;
        }

    }


    public function reset_password(Request $request){

        //get data from the flash session
        $token = $request->session()->get('token');
        $user_email = $request->input('email');
        //get the data from the user
        $code = $request->input('code');

        if($token == $code){
            return view('update_password', ['user_email'=>$user_email]);
        } else {

            return view('input_token', ['invalid_token'=>"You entered invalid code!!", 'token2'=>$token, 'user_email'=>$user_email]);
        }

    }
}
