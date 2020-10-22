<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import the model
use App\User;
use App\Teacher;
use Illuminate\Support\Facades\DB;

class ForgotPassword extends Controller
{
    public $user_email = "";

    public function submit(Request $request){

    //get the email from the form
    $email = $request->input('email');
    $user_email = $email;

    //select the user from the database depending on the email
    $user_details = Teacher::where('email', $email)->get();

    //generate a random number
    $token = $this->generateToken();
    
    //check if there is a user
    if( !$user_details->isEmpty()){
        //create a flash session and put a token data into it
        $request->session()->put('token', $token);

        //send email inorder for the user to get the token

        //return to home page
        return view('inputToken', ['user_email'=>$user_email]);

    } else{

        $request->session()->flash('no_user', 'User with that email address does not exist!!');
        $request->session()->flash('email', $email);
        return redirect('/forgotPassword');
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

        //get the token from the DB::
        $get_token = DB::table('password_resets')->where('email', $user_email)->get();

        if(!$get_token->isEmpty()){
            foreach($get_token as $code){
                $correct_token = $code->token;
            }

            //get the data from the user
            $user_token = $request->input('code');

            if($correct_token == $user_token){
                return view('updatePassword', ['user_email'=>$user_email]);
            } else {

                return view('inputToken', ['invalid_token'=>"You entered invalid code!!",  'user_email'=>$user_email]);
            }

        } else{
            return view('inputToken', ['invalid_token'=>"User does not exist! contact admin for more information!",  'user_email'=>$user_email]);

        }
        

    }
}
