<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import the teacher model
use App\Teacher;
use App\Teacher_classes;
use App\User;


//import the teacher role and responsibilities model
use App\Roles_and_responsibilities;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Teachers extends Controller
{
    //a function to insert teacher details to the database
    public function insertTeacher(Request $request){

        //make a model for a new teacher
        $teacher = new Teacher;

        //get the system date which represents the hire date of the teacher
        $hire_date = date("Y-m-d");        

        $hashed_password = Hash::make($request->input('teacher_id_no'));

        $first_name = $request->input('teacher_first_name');
        $middle_name = $request->input('teacher_middle_name');
        $last_name = $request->input('teacher_last_name');
        $email = $request->input('teacher_email');
        $phone_no = $request->input('teacher_phone_no');
        $tsc_no = $request->input('tsc_no');
        $id_no = $request->input('teacher_id_no');
        $gender = $request->input('teacher_gender');
        $subject_1 = $request->input('subject_1');
        $subject_2 = $request->input('subject_2');
        $religion = $request->input('teacher_religion');
        $nationality = $request->input('teacher_nationality');
        $date_hired = $hire_date;
        
        //check for data collision with other teachers details
        $check_email = DB::table('teachers')->where('email', $email)->get();
        if(!$check_email->isEmpty()){
            $request->session()->flash('email_crash', 'The email is already used.');
            return view('add_teacher', [
                'teacher_first_name'=>$first_name,
                'teacher_middle_name'=>$middle_name,
                'teacher_last_name'=>$last_name,
                'teacher_email'=>$email,
                'teacher_phone_no'=>$phone_no,
                'tsc_no'=>$tsc_no,
                'teacher_id_no'=>$id_no,
                'teacher_gender'=>$gender,
                'teacher_religion'=>$religion,
                'teacher_nationality'=>$nationality
            ]);
        }


        //check for tsc no
        $check_id_no = DB::table('teachers')->where('id_no', $id_no)->get();
        if(!$check_id_no->isEmpty()){
            $request->session()->flash('id_no_crash', 'The ID number is already used.');
            return view('add_teacher', [
                'teacher_first_name'=>$first_name,
                'teacher_middle_name'=>$middle_name,
                'teacher_last_name'=>$last_name,
                'teacher_email'=>$email,
                'teacher_phone_no'=>$phone_no,
                'tsc_no'=>$tsc_no,
                'teacher_id_no'=>$id_no,
                'teacher_gender'=>$gender,
                'teacher_religion'=>$religion,
                'teacher_nationality'=>$nationality
            ]);
        }

        $check_tsc_no = DB::table('teachers')->where('tsc_no', $tsc_no)->get();
        if(!$check_tsc_no->isEmpty()){
            $request->session()->flash('tsc_no_crash', 'The TSC number is already used.');
            return view('add_teacher', [
                'teacher_first_name'=>$first_name,
                'teacher_middle_name'=>$middle_name,
                'teacher_last_name'=>$last_name,
                'teacher_email'=>$email,
                'teacher_phone_no'=>$phone_no,
                'tsc_no'=>$tsc_no,
                'teacher_id_no'=>$id_no,
                'teacher_gender'=>$gender,
                'teacher_religion'=>$religion,
                'teacher_nationality'=>$nationality
            ]);
        }



        //query to save teacher details the database
        $teacher->first_name = $first_name;
        $teacher->middle_name = $middle_name;
        $teacher->last_name = $last_name;
        $teacher->email = $email;
        $teacher->phone_no = $phone_no;
        $teacher->tsc_no = $tsc_no;
        $teacher->id_no = $id_no;
        $teacher->password = $hashed_password;
        $teacher->gender = $gender;
        $teacher->subject_1 = $subject_1;
        $teacher->subject_2 = $subject_2;
        $teacher->religion = $religion;
        $teacher->nationality = $nationality;
        $teacher->date_hired = $hire_date;
        $teacher->save();


       
        //get all the teachers details
        $teachers_details = DB::table('teachers')->where('status', 'active');
        $request->session()->flash('teacher_registered_successfully', 'Teacher has been registered successfully');
        return redirect('/teachers_details');

    }

    public function showTeachers(Request $request){

       $teachers_details = DB::table('teachers')->where('status', 'active')->get();

        
        return view('teachers_details', ['teachers_details' => $teachers_details]);

    }

    //function to show a specific teacher
    public function specificTeacher($id){

        //get the teacher id
        $teacher_id = $id;

        //select the teacher details
       $specific_teacher = Teacher::where('id', $teacher_id)->get();

        //get the roles and responsibilities of the teacher, using joins
        // $specific_teacher = DB::table('teachers')
        //                             ->join('roles_and_responsibilities', 'teachers.id', 'roles_and_responsibilities.teacher_id')
        //                             ->where('teachers.id', $teacher_id)
        //                             ->get();
        
       // return $specific_teacher;

       //get already set roles and responsibilities
       $set_roles_and_responsiblities = Roles_and_responsibilities::all();

       $roles_and_responsibilities = Teacher::find($teacher_id)->teacher_roles_and_responsibilities;

     //  $teacher_classes = Teacher::find($teacher_id)->myClasses;
     $teacher_classes = DB::table('teacher_classes')
                            ->where('teacher_id', $teacher_id)
                            ->get();

    //    if(!$teacher_classes->isEmpty()){
    //         foreach($teacher_classes as $teaching_class){
    //             echo $teaching_class->class_name.'  ';
    //             echo $teaching_class->subject;
    //             echo '<br><br>';
    //         }
    //    }
       //return $teacher_classes;
        
       
      //return $roles_and_responsibilities;


        //return to a view that displays the teacher details
        return view('specific_teacher_details', ['specific_teacher'=>$specific_teacher, 'roles_and_responsibilities'=>$roles_and_responsibilities, 'set_roles_and_responsiblities'=>$set_roles_and_responsiblities, 'teacher_classes'=>$teacher_classes, 'not_updated'=>'Teacher details have not been updated']);
    }

    //function to edit teacher details
    public function editTeacher(Request $request){

        //get the id of the teacher
        $teacher_id = $request->input('id');


        $first_name = $request->input('teacher_first_name');
        $middle_name = $request->input('teacher_middle_name');
        $last_name = $request->input('teacher_last_name');
        $email = $request->input('teacher_email');
        $phone_no = $request->input('teacher_phone_no');
        $tsc_no = $request->input('tsc_no');
        $id_no = $request->input('teacher_id_no');
        $gender = $request->input('teacher_gender');
        $subject_1 = $request->input('subject_1');
        $subject_2 = $request->input('subject_2');
        $religion = $request->input('teacher_religion');
        $nationality = $request->input('teacher_nationality');

         //check for data collision with other teachers details
         $check_email = DB::table('teachers')->where('email', $email)->Where('id', '!=', $teacher_id)->get();
         if(!$check_email->isEmpty()){
             $request->session()->flash('email_crash', 'The entered email is already used.');
             return redirect('/teachers_details/'.$teacher_id);
         }
 
 
         //check for tsc no
         $check_id_no = DB::table('teachers')->where('id_no', $id_no)->Where('id', '!=', $teacher_id)->get();
         if(!$check_id_no->isEmpty()){
             $request->session()->flash('id_no_crash', 'The entered ID number is already used.');
             return redirect('/teachers_details/'.$teacher_id);
         }
 
         $check_tsc_no = DB::table('teachers')->where('tsc_no', $tsc_no)->Where('id', '!=', $teacher_id)->get();
         if(!$check_tsc_no->isEmpty()){
             $request->session()->flash('tsc_no_crash', 'The entered TSC number is already used.');
             return redirect('/teachers_details/'.$teacher_id);
         }
 
        

        
        //query to update teacher details
        $teacher = DB::table('teachers')
                     ->where('id', $teacher_id)
                     ->update([
                        'first_name' => $request->input('teacher_first_name'),
                        'middle_name' => $request->input('teacher_middle_name'),
                        'last_name' => $request->input('teacher_last_name'),
                        'email' => $request->input('teacher_email'),
                        'phone_no' => $request->input('teacher_phone_no'),
                        'tsc_no' => $request->input('tsc_no'),
                        'id_no' => $request->input('teacher_id_no'),
                        'gender' => $request->input('teacher_gender'),
                        'subject_1' => $request->input('subject_1'),
                        'subject_2' => $request->input('subject_2'),
                        'religion' => $request->input('teacher_religion'),
                        'nationality' => $request->input('teacher_nationality')
                     ]);

        //session data in flash session in order to update the user
        $request->session()->flash('updated_successfully', 'Teacher details have been updated successfully');

        //redirect to the teacher details page
        return redirect('/teachers_details/'.$teacher_id);
    }

    //function to archive teacher details 
    public function archiveTeacher(Request $request){

        //get the teacher id
        $teacher_id = $request->input('id');

        //get the system date which represents the date the teacher left
        $date_left = date("Y-m-d");

        //delete the teaching classes
        $delete_classes = DB::table('teacher_classes')
                            ->where('teacher_id', $teacher_id)
                            ->delete();

        //delete the teaching classes
        $delete_roles = DB::table('roles_and_responsibilities')
                            ->where('teacher_id', $teacher_id)
                            ->delete();

        //query to update teacher status
        $update_teacher = DB::table('teachers')
                            ->where('id', $teacher_id)
                            ->update([
                                'status' => 'archived',
                                'date_left' => $date_left
                            ]);
        
        //message in flash session for feedback
        $request->session()->flash('archived_successfully', 'One teacher has been archived successfully');

        return redirect('/teachers_details');

    }

    //function to add special roles to teachers
    public function addSpecialRole(Request $request){

        //get the inputs
        $teacher_id = $request->input('id');
        $role = $request->input('role');


        //check if the role is of principal
        if($role == "Principal"){
            //remove all other principals in db
            $removePrincipal = DB::table('roles_and_responsibilities')
                                 ->where('special_role', 'Principal')
                                 ->update([
                                     'special_role'=>null
                                 ]);

            //check if user is already in db
            $user_exists = DB::table('roles_and_responsibilities')->where('teacher_id', $teacher_id)->get();

            if(!$user_exists->isEmpty()){
                foreach($user_exists as $user){
                    //update
                    $insert_principal = DB::table('roles_and_responsibilities')
                                ->where('teacher_id', $teacher_id)
                                ->update([
                                    'special_role'=>$role
                                ]);
                } 
                } else{
                    //insert the new principal
                $insert_principal = DB::table('roles_and_responsibilities')
                                      ->insert([
                                          'teacher_id'=>$teacher_id,
                                          'special_role'=>$role                                      
                                      ]);
                }


            if($insert_principal == 1){
                            //set data in a flash session inorder to update the system user
                    $request->session()->flash('role_added_successfully', 'Teacher role has been added successfully.');

                    //redirect to the teachers details
                    return redirect('/teachers_details/'.$teacher_id);
            }
          
        }


        //first select from the roles and responsibilities table to check if a user has already
        //been assigned a responsibility
        $teacher_roles = Roles_and_responsibilities::where('teacher_id', $teacher_id)->get();
        if($teacher_roles->isEmpty()){
            //add as a new record
            $new_role = new Roles_and_responsibilities;
            $new_role->teacher_id = $teacher_id;
            $new_role->special_role = $role;
            $new_role->save();
        }
        else{
            //updating the existing column
            $update_role = DB::table('roles_and_responsibilities')
                             ->where('teacher_id', $teacher_id)
                             ->update([
                                'special_role' => $role
                             ]);
        }

        //set data in a flash session inorder to update the system user
        $request->session()->flash('role_added_successfully', 'Teacher role has been added successfully.');

        //redirect to the teachers details
        return redirect('/teachers_details/'.$teacher_id);
    }

    //function to remove special roles to teachers
    public function denySpecialRole(Request $request){
        //get the teacher id from the request
        $teacher_id = $request->input('id');

        //update the corresponding column in the database
        $roles = DB::table('roles_and_responsibilities')
                   ->where('teacher_id', $teacher_id)
                   ->update([
                        'special_role' => null
                   ]);
        
        //set some data in flash session in order to notify the system user
        $request->session()->flash('special_role_removed', 'Teacher special role has been removed successfully!!');
        
        return redirect('/teachers_details/'.$teacher_id);

    }

    //function to add teachers responsibilities
    public function addResponsibility(Request $request){

        //get the inputs
        $teacher_id = $request->input('id');
        $responsibility = $request->input('responsibility');
        $class_incharge = $request->input('class_incharge');

        //first select from the roles and responsibilities table to check if a user has already
        //been assigned a responsibility
        $teacher_roles = Roles_and_responsibilities::where('teacher_id', $teacher_id)->get();
        if($teacher_roles->isEmpty()){
            //add as a new record
            $new_role = new Roles_and_responsibilities;
            $new_role->teacher_id = $teacher_id;
            $new_role->responsibility = $responsibility;
            $new_role->class_teacher = $class_incharge;
            $new_role->save();
        }
        else{
            //updating the existing column
            $update_role = DB::table('roles_and_responsibilities')
                             ->where('teacher_id', $teacher_id)
                             ->update([
                                'responsibility' => $responsibility,
                                'class_teacher' => $class_incharge
                             ]);
        }

        //set data in a flash session inorder to update the system user
        $request->session()->flash('responsibility_added_successfully', 'Teacher responsibility has been added successfully.');

        //redirect to the teachers details
        return redirect('/teachers_details/'.$teacher_id);

    }

    //function to remove responsibility from teacher
    public function denyResponsibility(Request $request){

        //get the teacher id from the request
        $teacher_id = $request->input('id');

        //update the corresponding column in the database
        $roles = DB::table('roles_and_responsibilities')
                   ->where('teacher_id', $teacher_id)
                   ->update([
                        'responsibility' => null,
                        'class_teacher' => null
                   ]);
        
        //set some data in flash session in order to notify the system user
        $request->session()->flash('responsibility_removed', 'Teacher responsibility has been removed successfully!!');
     
        return redirect('/teachers_details/'.$teacher_id);
    }


    //function to check if the selected subjects are already taught by another teacher
    //and add details to the database
    public function addTeachingClass(Request $request){

        //get the input fields
        $class_name = $request->input('class_name');
        $subject = $request->input('subject');
        $teacher_id = $request->input('id');
        //get the current year
        $year = date("Y");

         //get the data from the database
         $data_available = Teacher_classes::where('class_name', $class_name)->get();

         //check if the subject has already been taken by another teacher
         if(!$data_available->isEmpty()){

            $extisting_id;
            //loop through the array
            foreach($data_available as $data){
                
                
                if($data->subject1 == $subject){
                    $request->session()->flash('class_taken', 'The subject in the respective class has already been assigned a teacher');
                    
                    //return to the teachers page
                    return redirect('/teachers_details/'.$teacher_id);
                    
                } else if ($data->subject2 == $subject){
                    $request->session()->flash('class_taken', 'The subject in the respective class has already been assigned a teacher');
            
                    //return to the teachers page
                    return redirect('/teachers_details/'.$teacher_id);                  

                }
                else{
                    $extisting_id = $data->teacher_id;
                }

            }

            foreach($data_available as $data1){

                if($data1->teacher_id == $teacher_id && $data1->class_name == $class_name){

                    if($data1->subject1 == null){

                        //update teachers subject 1
                        $update_teacher_class = DB::table('teacher_classes')
                                                   ->where('teacher_id', $teacher_id)
                                                   ->where('class_name', $class_name)
                                                   ->update([
                                                        'subject1'=>$subject
                                                   ]);

                        //set a success message in the session
                        $request->session()->flash('teaching_class_successful', 'Teacher has been successfully assigned a teaching class');

                            //send redirect
                        return redirect('/teachers_details/'.$teacher_id);
                        
                    } else if($data1->subject2 == null){
                        //update subject 2
                        $update_teacher_class = DB::table('teacher_classes')
                                                   ->where('teacher_id', $teacher_id)
                                                   ->where('class_name', $class_name)
                                                   ->update([
                                                        'subject2'=>$subject
                                                   ]);

                        //set a success message in the session
                       $request->session()->flash('teaching_class_successful', 'Teacher has been successfully assigned a teaching class in');

                            //send redirect
                        return redirect('/teachers_details/'.$teacher_id);

                    }
                }
            }

            if($teacher_id != $extisting_id){
                //The  record is new, so make a new insertion
             $new_teacher_class = new Teacher_classes;
             $new_teacher_class->teacher_id = $teacher_id;
             $new_teacher_class->class_name = $class_name;
             $new_teacher_class->subject1 = $subject;
             $new_teacher_class->year = $year;
             $new_teacher_class->save();

             //set a success message in the session
             $request->session()->flash('teaching_class_successful', 'Teacher has been successfully assigned a teaching class');

             //send redirect
             return redirect('/teachers_details/'.$teacher_id);
            }

         } 
         
         if($data_available->isEmpty())
         {
             
             //The  record is new, so make a new insertion
             $new_teacher_class = new Teacher_classes;
             $new_teacher_class->teacher_id = $teacher_id;
             $new_teacher_class->class_name = $class_name;
             $new_teacher_class->subject1 = $subject;
             $new_teacher_class->year = $year;
             $new_teacher_class->save();

            

             //set a success message in the session
             $request->session()->flash('teaching_class_successful', 'Teacher has been successfully assigned a teaching class');

             //send redirect
             return redirect('/teachers_details/'.$teacher_id);
         }

         
    }

    //function to remove teaching class role from teacher
    public function removeTeachingClassSubject1(Request $request){
        //get the teaching class id
        $teaching_class_id = $request->input('id');
        $teacher_id = $request->input('teacher_id');

        $teacher_class = DB::table('teacher_classes')
                           ->where('id', $teaching_class_id)
                           ->update([
                               'subject1'=> null
                           ]);

        //if the teacher has no more classes to teach, delete the record
         $any_more_class =  DB::table('teacher_classes')
                           ->where('id', $teaching_class_id)
                            ->get();
        if(!$any_more_class->isEmpty()){

            foreach($any_more_class as $no_more_class){
                if($no_more_class->subject1 == null && $no_more_class->subject2 == null){
                    //delete the record
                    $delete_record = DB::table('teacher_classes')
                                       ->where('id', $no_more_class->id)
                                       ->delete();
                }
            }
            
        }

         
        $request->session()->flash('teacher_class_withdrawn', 'Teacher has been withdrawn from teaching the subject in the class');
        //send redirect
        return redirect('/teachers_details/'.$teacher_id);
    }

    public function removeTeachingClassSubject2(Request $request){

        //get the teaching class id
        $teaching_class_id = $request->input('id');
        $teacher_id = $request->input('teacher_id');
    
        $teacher_class = DB::table('teacher_classes')
                           ->where('id', $teaching_class_id)
                           ->update([
                               'subject2'=> null
                           ]);
         //if the teacher has no more classes to teach, delete the record
         $any_more_class =  DB::table('teacher_classes')
                           ->where('id', $teaching_class_id)
                            ->get();
        if(!$any_more_class->isEmpty()){

            foreach($any_more_class as $no_more_class){
                if($no_more_class->subject1 == null && $no_more_class->subject2 == null){
                    //delete the record
                    $delete_record = DB::table('teacher_classes')
                                       ->where('id', $no_more_class->id)
                                       ->delete();
                }
            }
            
        }

        $request->session()->flash('teacher_class_withdrawn', 'Teacher has been withdrawn from teaching the subject in the class');
        //send redirect
        return redirect('/teachers_details/'.$teacher_id);
    }


    //function for showing classes which a teacher teaches
    public function showMyTeachingClasses(Request $request){


        //get the teacher
        $teacher_id = $request->session()->get('teacher_id');

        //get the classes from the database
        $teaching_classes = DB::table('teacher_classes')
                              ->where('teacher_id', $teacher_id)
                              ->get();
                            
        return view('teachers.myTeachingClasses', ['teaching_classes'=>$teaching_classes]);
    }

    public function showAllTeacherClasses(){

        //get the details from db
        $teacher_classes = DB::table('teacher_classes')
                            ->join('teachers', 'teacher_classes.teacher_id', 'teachers.id')
                            ->get();

        return view ('teachers.allTeachersClasses', ['teacher_classes'=>$teacher_classes]);
    }

    //function to show archived teachers
    public function showArchived(){

        //get the teachers details
        $archivedTeachers = DB::table('teachers')
                             ->where('status', 'archived')
                             ->get();

        return view('teachers.archived_teachers', ['archivedTeachers'=>$archivedTeachers]);
    }

    public function showSpecificArchivedTeacher($teacher_id){

        //get the teacher details
        $specific_archived_teacher = DB::table('teachers')
                                        ->where('id', $teacher_id)
                                        ->where('status', 'archived')
                                        ->get();

        return view('teachers.specific_archived_teacher', ['specific_archived_teacher'=>$specific_archived_teacher]);


    }
    

    //function for unarchiving teacher
    public function unarchiveTeacher(Request $request){

        //get teacher id 
        $teacher_id = $request->input('teacher_id');

        $unarchive = DB::table('teachers')
                        ->where('id', $teacher_id)
                        ->update([
                            'status'=>'active',
                            'date_left'=>null
                        ]);

        if($unarchive == 1){
            $request->session()->flash('unarchived_success', 'One teacher has been unarchived successfully');
            return redirect('/teachers/archived');
        } else{
            $request->session()->flash('unarchived_failed', 'Failed to unarchive teacher');
            return redirect('/teachers/archived');
        }
    }
    
}

