<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    //function for changing password
    public function changePassword(Request $request){

        //get the details from the form
        $old_password = $request->input('old_password');
        $new_password = $request->input('new_password');

        if($request->session()->get('is_teacher')){
            echo 'is teacher';
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
                        if($old_password != $check->password){
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
                                     'password'=>$new_password
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
            echo 'non teaching staff';

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
                        if($old_password != $check->password){
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
                                     'password'=>$new_password
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
