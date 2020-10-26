<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import the user model
use Illuminate\Support\Facades\Hash;
use App\User;

use Illuminate\Support\Facades\DB;



class LoginController extends Controller
{
    //

    public $username;

    //function that determines the type of user and redirects to the correct page
    public function submitDetails(Request $request){

        
       //get the details from the form
       $email = $request->input('email');
       $password = $request->input('password');

       if($email == "admin@admin.com"){
           //user is admin
            $user = User::where('email', $email)->get();

            foreach($user as $adm){
                if(Hash::check($password, $adm->password)){
                    $request->session()->put('is_admin', true);
                    $request->session()->put('username', 'admin');
                    return redirect('/admin/dashboard');

                } else{
                    $request->session()->flash('invalid_password', 'You entered wrong password!!');
                    $request->session()->flash('email', $email);
                    return redirect('/signin');
                }
            }
       }

       $valid_user = DB::table('teachers')
                        ->where('email', $email)
                        ->get();
        

       $teachers = DB::table('teachers')
                    ->where('email', $email)
                    ->get();

         


        if($teachers->isEmpty()){

            //valid staff
            $valid_staff = DB::table('non_teaching_staff')
                                ->where('email', $email)
                                ->get();

            //select from non teaching staff
            $non_teaching_staff = DB::table('non_teaching_staff')
                                    ->where('email', $email)
                                    ->get();      
            
        }

        

        if(!$teachers->isEmpty()){

            if(!$valid_user->isEmpty() ){
                foreach($valid_user as $user){
                    if(!(Hash::check($password, $user->password))){
                        $request->session()->flash('invalid_password', 'You entered wrong password!!');
                        $request->session()->flash('email', $email);
                        return redirect('/signin');
                    }
                }
                
            }
        } 

       if($teachers->isEmpty()){
        if(!$non_teaching_staff->isEmpty()){
            if(!$valid_staff->isEmpty()){
                foreach($non_teaching_staff as $user){
                    if(!(Hash::check($password, $user->password))){
                        $request->session()->flash('invalid_password', 'You entered wrong password!!');
                        $request->session()->flash('email', $email);
                        return redirect('/signin');
                    }
                }               
                
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
                $username = $teacher->first_name; 
                $profile_pic = $teacher->profile_pic;               
            }

            $request->session()->put('profile_pic', $profile_pic);
            //add the user details to a session
            $request->session()->put('teacher_details', $teachers);
            $request->session()->put('username', $username);

            //get the specific roles of the teacher
            $teacher_roles = DB::table('roles_and_responsibilities')
                            ->where('teacher_id', $id)
                            ->get();

            $is_boardingMaster = false;
            $is_in_examination_and_student_admission = false;
            if(!$teacher_roles->isEmpty()){
                foreach($teacher_roles as $roles){
                    if($roles->special_role == "Boarding master"){
                        $is_boardingMaster = true;
                    }
                    if($roles->special_role == "Examination and student admission"){
                        $is_in_examination_and_student_admission = true;
                    }
                }
            }

            if($is_boardingMaster){
                $request->session()->put('is_boardingMaster', true);
            }

            if($is_in_examination_and_student_admission){
                $request->session()->put('is_in_examination_and_student_admission', true);
            }

            //get the teacher teaching classes
            $teaching_classes = DB::table('teacher_classes')
                                ->where('teacher_id', $id)
                                ->get();

            //put the teaching classes in session
            $request->session()->put('teaching_classes', $teaching_classes);
            $request->session()->put('is_teacher', true);

            //put the teacher id in session 
            $request->session()->put('teacher_id', $id);   
            
            if(!$teacher_roles->isEmpty()){
                foreach($teacher_roles as $roles){
                    if($roles->special_role == "Principal"){
                        $request->session()->put('is_principal', true);
                        return redirect('/admin/dashboard');
                    }
                    if($roles->special_role == "Deputy principal"){
                        $request->session()->put('is_deputy_principal', true);
                        return redirect('/admin/dashboard');
                    }
                }
            }
            
            if($is_boardingMaster){
                return redirect('/accommodation_facility/dashboard');
            }

            $request->session()->put('is_normal_teacher', true);
            return redirect('/teachers/dashboard');
        }


        //redirect to non teaching staff portal
        if(!$non_teaching_staff->isEmpty()){
           
            

            //get the staff id
            $non_teaching_staff_id;
            foreach($non_teaching_staff as $non_staff ){
                $non_teaching_staff_id = $non_staff->id;
                $username = $non_staff->first_name;
                $profile_pic = $non_staff->profile_pic;
            }
            $request->session()->put('profile_pic', $profile_pic);

            //put the staff details in a session
            $request->session()->put('staff_details', $non_teaching_staff);
            $request->session()->put('username', $username);
            $request->session()->put('non_teaching_staff_id', $non_teaching_staff_id);
            $request->session()->put('is_non_teaching_staff', true);

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

        //delete the password reset token
        $delete_token = DB::table('password_resets')
                          ->where('email', $email)
                          ->delete();


       //redirect to login
       if($query == 1){
           //set message
           $request->session()->flash('password_reset_successfully', 'password has been reset successfully. You can use your email and the new password to log in!');
           return redirect('/signin');
       } else{
           //set error message
           $request->session()->flash('password_reset_failed', 'Failed to reset password! Please contact admin for more information!');
           return redirect('/signin');
       }

    }


}
