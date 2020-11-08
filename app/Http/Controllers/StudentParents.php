<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentParents extends Controller
{
    //

    //show students parents
    public function showParents(){

        //get the parents from the DB
        $parents = DB::table('parents')->orderBy('created_at', 'Desc')->get();

        return view('parents.studentsParents', ['parents'=>$parents]);
    }


    public function specific_parent($parent_id){

        $parent_details = DB::table('parents')->where('id', $parent_id)->get();
        
        $parent_children = DB::table('students')
                             ->join('student_parent', 'students.id', 'student_parent.student_id')
                             ->where('student_parent.parent_id', $parent_id)
                             ->get();


        return view('parents.parent', ['parent_details'=>$parent_details, 'parent_children'=>$parent_children]);
    }


    public function editParentRelationship(Request $request){

        //get the details
        $student_id = $request->input('student_id');
        $parent_id = $request->input('parent_id');
        $relationship = $request->input('relationship');
                 //check for any conflicts
           $relationship_exists = DB::table('student_parent')
                                     ->where('student_id', $student_id)
                                     ->where('relationship', $relationship)
                                     ->get();
            if(!$relationship_exists->isEmpty()){
                $request->session()->flash('edit_relationship_exists', 'The student has already been assigned a '.$relationship.'. Every child can have only one '.$relationship);
                return redirect('/parents/'.$parent_id);
            }

        //update the details in the database
        $update_info = DB::table('student_parent')
                         ->where('student_id', $student_id)
                         ->where('parent_id', $parent_id)
                         ->update([
                             'relationship'=>$relationship
                         ]);

                

        if($update_info == 1){
            $request->session()->flash('relationship_updated', 'Relationship has been updated successfully');
            return redirect('/parents/'.$parent_id);
        } else{
            $request->session()->flash('relationship_update_failed',' Failed to update the relationship between the child and the parent');
            return redirect('/parents/'.$parent_id);
        }
    }

    public function detach(Request $request){
        //get the details
        $student_id = $request->input('student_id');
        $parent_id = $request->input('parent_id');

        //delete the details
        $detach_child = DB::table('student_parent')
                          ->where('student_id', $student_id)
                          ->where('parent_id', $parent_id)
                          ->delete();

        if($detach_child == 1){
            $request->session()->flash('detach_successful', 'Student has been successfully detached from the parent');
            return redirect('/parents/'.$parent_id);
        } else{
            $request->session()->flash('detach_failed',' Failed to detach student from the parent');
            return redirect('/parents/'.$parent_id);
        }
    }

    public function addStudentForm($parent_id){

        $adm_no = "";
        $student_details = DB::table('students')->where('id', '9876vbjhg')->get();

        return view('parents.add_child', ['parent_id'=>$parent_id, 'student_details'=>$student_details, 'adm_no'=>$adm_no]);
    }

    public function searchStudent(Request $request){

        //get the  details
        $parent_id = $request->input('parent_id');
        $adm_no = $request->input('adm_no');

        //search for the student
        $student_details = DB::table('students')
                             ->where('admission_number', $adm_no)
                             ->get();

        if($student_details->isEmpty()){
            $request->session()->flash('no_child', 'There is no student with the admission number: '.$adm_no);
        }

        return view('parents.add_child', ['parent_id'=>$parent_id, 'student_details'=>$student_details, 'adm_no'=>$adm_no]);
    }


    public function addChild(Request $request){

        //get the details from the form
        $adm_no = $request->input('admission_number');
        $parent_id = $request->input('parent_id');
        $student_id = $request->input('student_id');
        $relationship = $request->input('relationship');

        //search for the student
        $student_details = DB::table('students')
                             ->where('admission_number', $adm_no)
                             ->get();

        //check for any conflicts
           $relationship_exists = DB::table('student_parent')
                                     ->where('student_id', $student_id)
                                     ->where('relationship', $relationship)
                                     ->get();
            if(!$relationship_exists->isEmpty()){
                $request->session()->flash('relationship_exists', 'The student has already been assigned a '.$relationship.'. Every child can have only one '.$relationship);
                return view('parents.add_child', ['parent_id'=>$parent_id, 'student_details'=>$student_details, 'adm_no'=>$adm_no]);
            }

            //check for any conflicts
           $relationship_exists = DB::table('student_parent')
                                     ->where('student_id', $student_id)
                                     ->where('parent_id', $parent_id)
                                     ->get();
            if(!$relationship_exists->isEmpty()){
                $request->session()->flash('child_assigned_to_parent', 'This child has already been assigned to this parent. You can try a different child');
                return view('parents.add_child', ['parent_id'=>$parent_id, 'student_details'=>$student_details, 'adm_no'=>$adm_no]);
            }

            //else update the db
            $insert_student_parent = DB::table('student_parent')
                                        ->insert([
                                            'student_id'=>$student_id,
                                            'parent_id'=>$parent_id,
                                            'relationship'=>$relationship
                                        ]);
            
        if($insert_student_parent == 1){
            $request->session()->flash('insert_successful', 'One child has been successfully assigned to this parent. You can view the child details under children tab');
            return redirect('/parents/'.$parent_id);
        } else{
            $request->session()->flash('insert_failed',' Failed to assign the child to parent. Please contact admin for more information');
            return redirect('/parents/'.$parent_id);
        }
        
    }

    //add a new parent
    public function addNewParent(Request $request){

        //get the details from the form
        $first_name = $request->input('first_name');
        $middle_name = $request->input('middle_name');
        $last_name = $request->input('last_name');
        $phone_no = $request->input('phone_no');
        $email = $request->input('email');
        $gender = $request->input('gender');
        $id_no = $request->input('id_no');
        $occupation = $request->input('occupation');

        //check for confilict of id no, and email
        $email_conflict = DB::table('parents')->where('email', $email)->get();
        if(!$email_conflict->isEmpty()){
            $request->session()->flash('email_conflict', 'There is another parent with the email '.$email);
            return view('parents.add_parent', [
                'first_name'=>$first_name,
                'middle_name'=>$middle_name,
                'last_name'=>$last_name,
                'phone_no'=>$phone_no,
                'email'=>$email,
                'gender'=>$gender,
                'id_no'=>$id_no,
                'occupation'=>$occupation
            ]);
        }

        //check for confilict of id no, and email
        $id_no_conflict = DB::table('parents')->where('id_no', $id_no)->get();
        if(!$id_no_conflict->isEmpty()){
            $request->session()->flash('id_no_conflict', 'There is another parent with the ID No.  '.$id_no);
            return view('parents.add_parent', [
                'first_name'=>$first_name,
                'middle_name'=>$middle_name,
                'last_name'=>$last_name,
                'phone_no'=>$phone_no,
                'email'=>$email,
                'gender'=>$gender,
                'id_no'=>$id_no,
                'occupation'=>$occupation
            ]);
        }

        //insert parent details
        $insert_parent = DB::table('parents')
                            ->insert([
                                'first_name'=>$first_name,
                                'middle_name'=>$middle_name,
                                'last_name'=>$last_name,
                                'phone_no'=>$phone_no,
                                'email'=>$email,
                                'gender'=>$gender,
                                'id_no'=>$id_no,
                                'occupation'=>$occupation,
                                'created_at'=>now(),
                                'updated_at'=>now()
                            ]);

        if($insert_parent == 1){
            $request->session()->flash('parent_inserted_successfully', 'The parent details have been saved successfully');
            return redirect('/students/parents');
            
        } else{
            $request->session()->flash('parent_insert_failed', 'Failed to save parent details. Please contact admin for more information');
            return redirect('/students/parents');            
        }
    }


    //function for editing student details
    public function editParent(Request $request){
         //get the details from the form
         $parent_id = $request->input('parent_id');
         $first_name = $request->input('first_name');
         $middle_name = $request->input('middle_name');
         $last_name = $request->input('last_name');
         $phone_no = $request->input('phone_no');
         $email = $request->input('email');
         $gender = $request->input('gender');
         $id_no = $request->input('id_no');
         $occupation = $request->input('occupation');

         //check for confilict of id no, and email
        $email_conflict = DB::table('parents')->where('email', $email)->where('id', '!=', $parent_id)->get();
        if(!$email_conflict->isEmpty()){
            $request->session()->flash('edit_email_conflict', 'There is another parent with the email '.$email);
            return redirect('parents/'.$parent_id);
        }

        //check for confilict of id no, and email
        $id_no_conflict = DB::table('parents')->where('id_no', $id_no)->where('id', '!=', $parent_id)->get();
        if(!$id_no_conflict->isEmpty()){
            $request->session()->flash('edit_id_no_conflict', 'There is another parent with the ID No.  '.$id_no);
            return redirect('parents/'.$parent_id);
        }


        //update parent details
        $update_parent = DB::table('parents')
                           ->where('id', $parent_id)
                            ->update([
                                'first_name'=>$first_name,
                                'middle_name'=>$middle_name,
                                'last_name'=>$last_name,
                                'phone_no'=>$phone_no,
                                'email'=>$email,
                                'gender'=>$gender,
                                'id_no'=>$id_no,
                                'occupation'=>$occupation,
                                'updated_at'=>now()
                            ]);

        if($update_parent == 1){
            $request->session()->flash('parent_updated_successfully', 'The parent details have been saved successfully');
            return redirect('parents/'.$parent_id);
            
        } else{
            $request->session()->flash('parent_update_failed', 'Failed to save parent details');
            return redirect('parents/'.$parent_id);         
        }

    }
}
