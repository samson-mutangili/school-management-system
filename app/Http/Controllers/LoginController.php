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

            //valid staff
            $valid_staff = DB::table('non_teaching_staff')
                                ->where('email', $email)
                                ->get();

            //select from non teaching staff
            $non_teaching_staff = DB::table('non_teaching_staff')
                    ->where('email', $email)
                    ->where('id_no', $password)
                    ->get();      
            
        }

        

        if($teachers->isEmpty()){

            if(!$valid_user->isEmpty() ){
                $request->session()->flash('invalid_password', 'You entered wrong password!!');
                $request->session()->flash('email', $email);
                return redirect('/signin');
            }
        } 

       if($teachers->isEmpty()){
        if($non_teaching_staff->isEmpty()){
            if(!$valid_staff->isEmpty()){
                $request->session()->flash('invalid_password', 'You entered wrong password!!');
                $request->session()->flash('email', $email);
                return redirect('/signin');
            }
        }
       }

        if($teachers->isEmpty() && $non_teaching_staff->isEmpty()){
            if($valid_user->isEmpty() && $valid_staff->isEmpty()){
                $request->session()->flash('invalid_user', 'User with that email does not exist in the system!!');
                $request->session()->flash('email', $email);

                return redirect('/signin');
            }
        }



        //redirect to teachers dashboard
        
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

            $is_boardingMaster = false;
            if(!$teacher_roles->isEmpty()){
                foreach($teacher_roles as $roles){
                    if($roles->special_role == "Boarding master"){
                        $is_boardingMaster = true;
                    }
                }
            }

            if($is_boardingMaster){
                $request->session()->put('is_boardingMaster', true);
            }

            //get the teacher teaching classes
            $teaching_classes = DB::table('teacher_classes')
                                ->where('teacher_id', $id)
                                ->get();

            //put the teaching classes in session
            $request->session()->put('teaching_classes', $teaching_classes);

           
            
            return redirect('/addTeacher');
        }


        //redirect to non teaching staff portal
        if(!$non_teaching_staff->isEmpty()){
           
            
            //get the staff id
            $non_teaching_staff_id;
            foreach($non_teaching_staff as $non_staff ){
                $non_teaching_staff_id = $non_staff->id;
            }

            //put the staff details in a session
            $request->session()->put('staff_details', $non_teaching_staff);
            $request->session()->put('non_teaching_staff_id', $non_teaching_staff_id);

            //check the category of the staff
            $category;
            foreach($non_teaching_staff as $staff){
                Global $category;
                $category = $staff->category;
            }

            //put the category in a session
            $request->session()->put('staff_category', $category);
            

            if($category == "bursar"){
                return redirect('/finance_department');
            } else{
                $request->session()->flash('invalid_password', 'You are not authorised to perform important functionalities');
                $request->session()->flash('email', $email);
                return redirect('/signin');
            }


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
