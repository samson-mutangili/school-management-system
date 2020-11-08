<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Disciplinary extends Controller
{
    //function that displays students details 
    public function showStudents($class_name){

        //get students in the specific class
        $students = DB::table('students')
                      ->join('student_classes', 'students.id', 'student_classes.student_id')
                      ->where('student_classes.stream', $class_name)
                      ->where('students.status', 'active')
                      ->where('student_classes.status', 'active')
                      ->get();

        return view('report_disciplinary', ['class_name'=>$class_name, 'students'=>$students]);
    }

    public function reportCase(Request $request){

        //get the details from the form
        $student_id = $request->input('student_id');
        $case_category = $request->input('case_category');
        $case_description = $request->input('case_description');
        $class_name = $request->input('class_name');

        //get the system date, which represents the date the disciplinary case was reported
        $date_reported = date("Y-m-d");

        $teacher_id = 0;
        //get the teacher id from the session data
        if(!($request->session()->get('teacher_details'))->isEmpty()){
            $teacher_details = $request->session()->get('teacher_details');
            foreach($teacher_details as $teacher){
                $teacher_id = $teacher->id;
            }
        }

        //insert case details into the database
        $report_case = DB::table('disciplinary_cases')
                         ->insert([
                             'student_id'=>$student_id,
                             'student_class'=>$class_name,
                             'teacher_id'=>$teacher_id,
                             'case_category'=>$case_category,
                             'case_description'=>$case_description,
                             'date_reported'=>$date_reported
                         ]);
        
        // return with a success message
        
        if($report_case == 1){
            //set message in a flash session
            $request->session()->flash('case_reported_successfully','The disciplinary case was successfully reported. Appropriate measures will be taken.');
            return redirect('/disciplinary/'.$class_name);
        } else{
            $request->session()->flash('case_not_reported', 'The disciplinary case was not reported!! Contact admin for more information!!');
            return redirect('/disciplinary/'.$class_name);
        }   

        
    }

    public function current_cases(){

        $current_cases = DB::table('disciplinary_cases')
                           ->join('students', 'disciplinary_cases.student_id', 'students.id')
                           ->where('disciplinary_cases.case_status','uncleared')
                           ->get();

        return view('current_disciplinary_cases', ['current_cases'=>$current_cases]);
    }

    public function specific_student_case(Request $request, $case_id, $student_id, $teacher_id){

        //get the data
        $case_id = $case_id;
        $student_id = $student_id;
        $teacher_id = $teacher_id;
        $student_class = "";

        //get the data from the database
        $case_details = DB::table('disciplinary_cases')
                          ->where('case_id', $case_id)
                          ->get();

        if(!$case_details->isEmpty()){
            foreach($case_details as $case){
                $student_id = $case->student_id;
                $teacher_id = $case->teacher_id;
                $student_class = $case->student_class;
            }
        }

        //get the student details
        $student_details = DB::table('students')
                             ->where('id', $student_id)
                             ->get();


        //get the teacher details
        $teacher_details = DB::table('teachers')
                             ->where('id', $teacher_id)
                             ->get();

        return view('specific_student_disciplinary_case', [
            'case_details'=>$case_details,
            'student_details'=>$student_details,
            'teacher_details'=>$teacher_details,
            'student_class'=>$student_class
            ]);
    }

    public function case_clearance(Request $request){

        //get the data from the form
        $teacher_id = $request->input('teacher_id');
        $case_id = $request->input('case_id');
        $action_taken = $request->input('action_taken');

        //get the date the case was cleared
        $date_case_cleared = date("d-m-Y");

        if($teacher_id == null){
            $request->session()->flash('case_not_cleared', 'The disciplinary case was not cleared!! Please contact admin for more information!!');
            return redirect('/disciplinary/cases/current_cases');            
        }
        else{

            //update the case records
            $case_update = DB::table('disciplinary_cases')
                             ->where('case_id', $case_id)
                             ->update([
                                 'action_taked'=>$action_taken,
                                 'date_action_taken'=>$date_case_cleared,
                                 'action_taken_by'=>$teacher_id,
                                 'case_status'=>'cleared'
                             ]);

            if($case_update == 1){
                //set success message
                $request->session()->flash('case_cleared_successfully','The disciplinary case was successfully cleared.');
                return redirect('/disciplinary/cases/current_cases');  
            } else{
                $request->session()->flash('case_not_cleared','The disciplinary case was not cleared!! Please contact admin for more information!!');
                return redirect('/disciplinary/cases/current_cases');  
            }
         }

    }
}
