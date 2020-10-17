<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class StudentPromotion extends Controller
{
    
    //function for archiving student details
    public function archiveStudent(Request $request){

        //get the details from the form
        $student_id = $request->input('student_id');
        $class_name = $request->input('class_name');

        //get the date the student left
        $date_left = date("Y-m-d");

        //update the student details
        $update_student = DB::table('students')
                            ->where('id', $student_id)
                            ->update([
                                'status'=>'archived',
                                'date_left'=>$date_left
                            ]);

        //update the student classes
        $class_updates = DB::table('student_classes')
                           ->where('student_id', $student_id)
                           ->update([
                                'status'=>'archived'
                           ]);

        if($update_student == 1 && $class_updates == 1){
            //set message in flash session
            $request->session()->flash('student_archived', 'Student details have been archived successfully.');
            //return redirect to other class students
            return redirect('/students_details/'.$class_name);
        } else{
              //set message in flash session
              $request->session()->flash('student_not_archived', 'Student details have not been archived.');
            //return redirect to other class students
            return redirect('/students_details/'.$class_name);
        }
        
    }

    //function for promoting student to next class
    public function promotoToNextClass(Request $request){

        //get the data from the form
        $student_id = $request->input("student_id");
        $class_name = $request->input("class_name");
        $current_class = $request->input("current_class");
        $year = $request->input("year");
        $trial = $request->input("trial");
        $next_class = $request->input("next_class");
        $class_stream = $request->input("class_stream");

        //check for validity before promotion
        if($current_class == $next_class && $trial == 1){
            //set error message in a flash session
            $request->session()->flash('same_class', 'Student not promoted to next class. Please check the trial period to 2 if the student has to repeat the same class!');
            return redirect('/studentDetails/'.$class_name.','.$student_id);
        } else{
            //update the records in the DB
            $update_db = DB::table('student_classes')
                         ->where('student_id', $student_id)
                         ->update([
                            'status'=>'completed',
                         ]);

            //promote class
            $promote = DB::table('student_classes')
                         ->insert([
                             'student_id'=>$student_id,
                             'year'=>$year,
                             'class_name'=>$next_class,
                             'stream'=>$class_stream,
                             'trial'=>$trial,
                             'status'=>'active'
                         ]);

            if($promote == 1){
                //set success message in a session
                $request->session()->flash('promoted', 'Student has been promoted to next class successfully');
                return redirect('/studentDetails/'.$class_stream.','.$student_id);
            } else{
                //set error message in a session
                $request->session()->flash('not_promoted', 'Student promotion to next class has failed. Please contact admin for more information!');
                return redirect('/studentDetails/'.$class_name.','.$student_id);
            }
        }


    }


}
