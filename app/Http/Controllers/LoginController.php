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
       $email = $request->input('email');
       $password = $request->input('password');

       $valid_user = DB::table('teachers')
                        ->where('email', $email)
                        ->get();
        

       $teachers = DB::table('teachers')
                    ->where('email', $email)
                    ->where('password', $password)
                    ->get();

        if($teachers->isEmpty()){
            if(!$valid_user->isEmpty()){
                $request->session()->flash('invalid_password', 'You entered wrong password!!');
                $request->session()->flash('email', $email);
                return redirect('/signin');
            } else{
                $request->session()->flash('invalid_user', 'User with that email does not exist in the system!!');
                $request->session()->flash('email', $email);

                return redirect('/signin');
            }
        }

        
        if(!$teachers->isEmpty()){

            $id;
        foreach($teachers as $teacher ){
            $id = $teacher->id;
        }

        //add the user details to a session
        $request->session()->put('teacher_details', $teachers);

        //get the specific roles of the teacher
        $teacher_roles = DB::table('roles_and_responsibilities')
                           ->where('teacher_id', $id)
                           ->get();

        //get the teacher teaching classes
        $teaching_classes = DB::table('teacher_classes')
                              ->where('teacher_id', $id)
                              ->get();

        //put the teaching classes in session
        $request->session()->put('teaching_classes', $teaching_classes);


            return redirect('/addTeacher');
        }
           




    }

    public function resetPassword(Request $request){

        //get the email from the user
        $email = $request->input('email');

        //get the password from the form
        $password = $request->input('password');

        //update the password 
        $query = DB::table('teachers')
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
