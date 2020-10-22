<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use Illuminate\Support\Facades\DB;

class ResetPasswordSendMailController extends Controller
{
    //
    public function sendEmailToUser(Request $request){

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

            

            $response = null;
            system("ping -c 1 google.com", $response);
            if($response == 0)
            {
                // there is internet connection
                //send email inorder for the user to get the token
                \Mail::to($user_email)->send(new \App\Mail\ResetPasswordMail($token));
                
                //insert the token to db
                $insert_token = DB::table('password_resets')
                                ->insert([
                                    'email'=>$user_email,
                                    'token'=>$token
                                ]);
                                
                //return to home page
                return view('inputToken', ['user_email'=>$user_email]);
            } else{
                //no internet connection
                $request->session()->flash('no_internet', 'Failed to connect! Please ensure that you are connected to internet in order to send the password reset token!');
                return redirect('/forgotPassword');
            }

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
}
