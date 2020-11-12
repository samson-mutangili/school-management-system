<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    //function for changing password
    public function changePassword(Request $request){

        //get the details from the form
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');

        $hashed_password = Hash::make($new_password);

        if($request->session()->get('is_admin')){
            //get password
            $users = DB::table('users')->get();
            foreach($users as $user){
                if(Hash::check($old_password, $user->password)){
                    //update the password
                    $pass_update = DB::table('users')
                                    ->update([
                                        'password'=>Hash::make($new_password)
                                    ]);
                       //set success message 
                        $request->session()->flash('password_updated', 'Password has been updated successully');
                        return redirect('/settings/change_password');
                } else{
                    //wrong old password
                    //set error message 
                    $request->session()->flash('wrong_old_password', 'The old password is wrong! Please enter a correct old password');
                    return view('profile.change_password', ['old_password'=>$old_password, 'new_password'=>$new_password]);
               
                }
            }

        }

        
        if($request->session()->get('is_teacher')){
            
            $teacher_id;
            //get the teachers details
            $teacher_details = $request->session()->get('teacher_details');
            if(!$teacher_details->isEmpty()){
                foreach($teacher_details as $teacher){
                    $teacher_id = $teacher->id;
                }
                $check_password = DB::table('teachers')
                                     ->where('id', $teacher_id)
                                     ->get();

                if(!$check_password->isEmpty()){
                    foreach($check_password as $check){
                        if(!Hash::check($old_password, $check->password)){
                            //set error message 
                            $request->session()->flash('wrong_old_password', 'The old password is wrong! Please enter a correct old password');
                            return view('profile.change_password', ['old_password'=>$old_password, 'new_password'=>$new_password]);
                        }
                    }
                } else{
                    //set error message 
                    $request->session()->flash('no_user', 'Invalid user! Please contact admin for more information!');
                    return view('profile.change_password', ['old_password'=>$old_password, 'new_password'=>$new_password]);
                }
            } else{
                //set error message 
                $request->session()->flash('no_set_session', 'Not in session! Ensure you are logged in!');
                return view('profile.change_password', ['old_password'=>$old_password, 'new_password'=>$new_password]);
            }

            //update password after handling errors
            $update_password = DB::table('teachers')
                                 ->where('id', $teacher_id)
                                 ->update([
                                     'password'=>$hashed_password
                                 ]);
            
            if($update_password == 1){
                //set success message 
                $request->session()->flash('password_updated', 'Password has been updated successully');
                return redirect('/settings/change_password');
            } else{
                //set error message 
                $request->session()->flash('password_update_failed', 'Failed to update the password! Please contact admin for more information!');
                return view('profile.change_password', ['old_password'=>$old_password, 'new_password'=>$new_password]);
            }

        } else if($request->session()->get('is_non_teaching_staff')){
            

            $staff_id;
            //get the teachers details
            $staff_details = $request->session()->get('staff_details');
            if(!$staff_details->isEmpty()){
                foreach($staff_details as $staff){
                    $staff_id = $staff->id;
                }
                $check_password = DB::table('non_teaching_staff')
                                     ->where('id', $staff_id)
                                     ->get();

                if(!$check_password->isEmpty()){
                    foreach($check_password as $check){
                        if(!Hash::check($old_password, $check->password)){
                            //set error message 
                            $request->session()->flash('wrong_old_password', 'The old password is wrong! Please enter a correct old password');
                            return view('profile.change_password', ['old_password'=>$old_password, 'new_password'=>$new_password]);
                        }
                    }
                } else{
                    //set error message 
                    $request->session()->flash('no_user', 'Invalid user! Please contact admin for more information!');
                    return view('profile.change_password', ['old_password'=>$old_password, 'new_password'=>$new_password]);
                }
            } else{
                //set error message 
                $request->session()->flash('no_set_session', 'Not in session! Ensure you are logged in!');
                return view('profile.change_password', ['old_password'=>$old_password, 'new_password'=>$new_password]);
            }

            //update password after handling errors
            $update_password = DB::table('non_teaching_staff')
                                 ->where('id', $staff_id)
                                 ->update([
                                     'password'=>$hashed_password
                                 ]);
            
            if($update_password == 1){
                //set success message 
                $request->session()->flash('password_updated', 'Password has been updated successully');
                return redirect('/settings/change_password');
            } else{
                //set error message 
                $request->session()->flash('password_update_failed', 'Failed to update the password! Please contact admin for more information!');
                return view('profile.change_password', ['old_password'=>$old_password, 'new_password'=>$new_password]);
            }
        } elseif($request->session()->get('is_parent')){

            $parent_id;
            //get the teachers details
            $parent_details = $request->session()->get('parent_details');
            if(!$parent_details->isEmpty()){
                foreach($parent_details as $parent){
                    $parent_id = $parent->id;
                }
                $check_password = DB::table('parents')
                                     ->where('id', $parent_id)
                                     ->get();

                if(!$check_password->isEmpty()){
                    foreach($check_password as $check){
                        if(!Hash::check($old_password, $check->password)){
                            //set error message 
                            $request->session()->flash('wrong_old_password', 'The old password is wrong! Please enter a correct old password');
                            return view('profile.change_password', ['old_password'=>$old_password, 'new_password'=>$new_password]);
                        }
                    }
                } else{
                    //set error message 
                    $request->session()->flash('no_user', 'Invalid user! Please contact admin for more information!');
                    return view('profile.change_password', ['old_password'=>$old_password, 'new_password'=>$new_password]);
                }
            } else{
                //set error message 
                $request->session()->flash('no_set_session', 'Not in session! Ensure you are logged in!');
                return view('profile.change_password', ['old_password'=>$old_password, 'new_password'=>$new_password]);
            }

            //update password after handling errors
            $update_password = DB::table('parents')
                                 ->where('id', $parent_id)
                                 ->update([
                                     'password'=>$hashed_password
                                 ]);
            
            if($update_password == 1){
                //set success message 
                $request->session()->flash('password_updated', 'Password has been updated successully');
                return redirect('/settings/change_password');
            } else{
                //set error message 
                $request->session()->flash('password_update_failed', 'Failed to update the password! Please contact admin for more information!');
                return view('profile.change_password', ['old_password'=>$old_password, 'new_password'=>$new_password]);
            }


        }
    }
}
