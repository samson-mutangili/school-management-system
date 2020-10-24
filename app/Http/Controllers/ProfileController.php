<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use File;
use App\Teacher;
use App\Non_teaching_staff_model;

class ProfileController extends Controller
{
    //
    public function viewProfile(Request $request){

        
        //get the user id 
        if($request->session()->get('is_teacher')){

            
            $teacher_id = $request->session()->get('teacher_id');

            $teacher_details = DB::table('teachers')
                                 ->where('id', $teacher_id)
                                 ->get();

            if(!$teacher_details->isEmpty()){
                //return to view with teacher details
                return view('profile.view_profile', ['user_details'=>$teacher_details]);
            } else{
                //set error message 
                $request->session()->flash('invalid_user', 'Invalid user! Please ensure you are logged in');
                return view('profile.view_profile');
            }
        }

        if($request->session()->get('is_non_teaching_staff')){

            $non_teaching_staff_id = $request->session()->get('non_teaching_staff_id');

            $non_teaching_staff_details = DB::table('non_teaching_staff')
                                 ->where('id', $non_teaching_staff_id)
                                 ->get();

            if(!$non_teaching_staff_details->isEmpty()){
                //return to view with teacher details
                return view('profile.view_profile', ['user_details'=>$non_teaching_staff_details]);
            } else{
                //set error message 
                $request->session()->flash('invalid_user', 'Invalid user! Please ensure you are logged in');
                return view('profile.view_profile');
            }
        }

    }

    public function editProfile(Request $request){

            //get the user id 
        if($request->session()->get('is_teacher')){

            $teacher_id = $request->session()->get('teacher_id');

            $teacher_details = DB::table('teachers')
                                 ->where('id', $teacher_id)
                                 ->get();

            if(!$teacher_details->isEmpty()){
                //return to view with teacher details
                return view('profile.edit_profile', ['user_details'=>$teacher_details, 'user_type'=>'teacher']);
            } else{
                //set error message 
                $request->session()->flash('invalid_user', 'Invalid user! Please ensure you are logged in');
                return view('profile.edit_profile');
            }
        }

        if($request->session()->get('is_non_teaching_staff')){

            $non_teaching_staff_id = $request->session()->get('non_teaching_staff_id');

            $non_teaching_staff_details = DB::table('non_teaching_staff')
                                 ->where('id', $non_teaching_staff_id)
                                 ->get();

            if(!$non_teaching_staff_details->isEmpty()){
                //return to view with teacher details
                return view('profile.edit_profile', ['user_details'=>$non_teaching_staff_details, 'user_type'=>'non_teaching_staff']);
            } else{
                //set error message 
                $request->session()->flash('invalid_user', 'Invalid user! Please ensure you are logged in');
                return view('profile.edit_profile');
            }
        }


    }


    //function for updating user profile
    public function updateProfile(Request $request){

        //get the user details from the form
        $id = $request->input('id');
        $user_type = $request->input('user_type');
        $email = $request->input('email');
        $phone_no = $request->input('phone_no');
        $religion = $request->input('religion');

         $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        if($request->hasfile('image')){
            $imageName = $id.'_'.time().'.'.$request->image->extension();  
   
            $request->image->move(public_path('images'), $imageName);

        }
        


        if($user_type == 'teacher'){

            //check if there is another user with the same email
            $check_email = DB::table('teachers')
                             ->where('id', '!=', $id)
                             ->where('email', $email)
                             ->get();

            $email_collide3 = DB::table('non_teaching_staff')
                             ->where('email', $email)
                             ->get();
             if((!$check_email->isEmpty()) || (!$email_collide3->isEmpty())){
                 //set error message 
                $request->session()->flash('email_collide', 'There is another user with that email. Email address should be unique!');
                return redirect('/users/profile/edit');
             }          

             if($request->hasfile('image')){
                    //get teacher 
                $teacher = Teacher::where('id', $id)->get();

                if(!$teacher->isEmpty()){
                    foreach($teacher as $user){
                            //delete image

                             if(file_exists(public_path("images/".$user->profile_pic))){
                                 //the line below deletes the picture using old php, 
                               // unlink(public_path("images/".$user->teacher_profile_pic));
                                     File::delete("images/".$user->profile_pic);
                            };

                            
                    }
                        
                }
                 //update teacher info
             $update_info = DB::table('teachers')
                              ->where('id', $id)
                              ->update([
                                  'email'=>$email,
                                  'phone_no'=>$phone_no,
                                  'religion'=>$religion,
                                  'profile_pic'=>$imageName
                              ]);

             } else{
                    //update staff info
             $update_info = DB::table('teachers')
                              ->where('id', $id)
                              ->update([
                                  'email'=>$email,
                                  'phone_no'=>$phone_no,
                                  'religion'=>$religion
                              ]);

             }
             
             if($request->hasfile('image')){
                $request->session()->put('profile_pic', $imageName);
             }
            
            if($update_info == 1){
                //set success message
                $request->session()->flash('profile_updated_successfully', 'User profile has been updated successfully');
                return redirect('/users/profile');
            } else{
                //set error message
                $request->session()->flash('profile_update_failed', 'Failed to update user profile! Please contact admin for more information!');
                return redirect('/users/profile/edit');
            }
        }


        //update details in non teaching staff
        if($user_type == 'non_teaching_staff'){

            //check if there is another user with the same email
            $check_email = DB::table('teachers')
                             ->where('email', $email)
                             ->get();
            $email_collide2 = DB::table('non_teaching_staff')
                                ->where('id', '!=', $id)
                                ->where('email', $email)
                                ->get();

             if((!$check_email->isEmpty()) || (!$email_collide2->isEmpty()) ){
                 //set error message 
                $request->session()->flash('email_collide', 'There is another user with that email. Email address should be unique!');
                return redirect('/users/profile/edit');
             }          

             if($request->hasfile('image')){
                    //get staff 
                $staff = Non_teaching_staff_model::where('id', $id)->get();

                if(!$staff->isEmpty()){
                    foreach($staff as $user){
                            //delete image

                             if(file_exists(public_path("images/".$user->profile_pic))){
                                 //the line below deletes the picture using old php, 
                               // unlink(public_path("images/".$user->teacher_profile_pic));
                                     File::delete("images/".$user->profile_pic);
                            };

                            
                    }
                        
                }

                //update teacher info
             $update_info = DB::table('non_teaching_staff')
                              ->where('id', $id)
                              ->update([
                                  'email'=>$email,
                                  'phone_no'=>$phone_no,
                                  'religion'=>$religion,
                                  'profile_pic'=>$imageName
                              ]);
             } else{
                     //update teacher info
             $update_info = DB::table('non_teaching_staff')
                              ->where('id', $id)
                              ->update([
                                  'email'=>$email,
                                  'phone_no'=>$phone_no,
                                  'religion'=>$religion
                              ]);
             }
             
            
             if($request->hasfile('image')){
                $request->session()->put('profile_pic', $imageName);
             }

            if($update_info == 1){
                //set success message
                $request->session()->flash('profile_updated_successfully', 'User profile has been updated successfully');
                return redirect('/users/profile');
            } else{
                //set error message
                $request->session()->flash('profile_update_failed', 'Failed to update user profile! Please contact admin for more information!');
                return redirect('/users/profile/edit');
            }
        }
    }
}
