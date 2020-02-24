<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import the teacher model
use App\Teacher;

use Illuminate\Support\Facades\DB;


class Teachers extends Controller
{
    //a function to insert teacher details to the database
    public function insertTeacher(Request $request){

        //make a model for a new teacher
        $teacher = new Teacher;

        //get the system date which represents the hire date of the teacher
        $hire_date = date("Y-m-d");        

        //query to save teacher details the database
        $teacher->first_name = $request->input('teacher_first_name');
        $teacher->middle_name = $request->input('teacher_middle_name');
        $teacher->last_name = $request->input('teacher_last_name');
        $teacher->email = $request->input('teacher_email');
        $teacher->phone_no = $request->input('teacher_phone_no');
        $teacher->tsc_no = $request->input('tsc_no');
        $teacher->id_no = $request->input('teacher_id_no');
        $teacher->gender = $request->input('teacher_gender');
        $teacher->subject_1 = $request->input('subject_1');
        $teacher->subject_2 = $request->input('subject_2');
        $teacher->religion = $request->input('teacher_religion');
        $teacher->nationality = $request->input('teacher_nationality');
        $teacher->date_hired = $hire_date;
        $teacher->save();

        //get all the teachers details
        $teachers_details = Teacher::all();
        
        return view('teachers_details', ['teachers_details' => $teachers_details]);

    }

    public function showTeachers(Request $request){

        //get the data from the form
        $no_to_paginate = 10;
        $subject = "all";

        //get all the teachers details
        $teachers_details = DB::table('teachers')->paginate($no_to_paginate);      

        if($request->input('no_to_paginate') != null){
            $no_to_paginate = $request->input('no_to_paginate');
        }

        if($request->input('subject') != null){
            $subject = $request->input('subject');
        }

        //if the default subject is all, select all the records
        if($subject == "all"){
            //get all the teachers details
          $teachers_details = DB::table('teachers')->paginate($no_to_paginate);
        }

        if($request->input('no_to_paginate') != null){

            //paginate the teachers details according to user input
            $teachers_details = DB::table('teachers')->paginate($no_to_paginate);
        }

        if($request->input('subject') != null){
            if($request->input('no_to_paginate') == null){
                $no_to_paginate = 10;
            }

            if(($request->input('subject') != "all") ){

            //select the teachers details according to subject
            $teachers_details = DB::table('teachers')
                                    ->where('subject_1', $subject)
                                    ->paginate($no_to_paginate);
            }
        }

        $i = 1;
        $page_no = $request->input('page');

        if($page_no != null){
            if($page_no == 1){
                $i = 1;
            } else {
                $i = $i + $no_to_paginate * ($page_no -1);
            }
        }
        
        return view('teachers_details', ['teachers_details' => $teachers_details, 'i'=>$i]);

    }

    //function to show a specific teacher
    public function specificTeacher($id){

        //get the teacher id
        $teacher_id = $id;

        //select the teacher details
        $specific_teacher = Teacher::where('id', $teacher_id)->get();

        //return to a view that displays the teacher details
        return view('specific_teacher_details', ['specific_teacher'=>$specific_teacher, 'not_updated'=>'Teacher details have not been updated']);
    }

    //function to edit teacher details
    public function editTeacher(Request $request){

        //get the id of the teacher
        $teacher_id = $request->input('id');

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
}
