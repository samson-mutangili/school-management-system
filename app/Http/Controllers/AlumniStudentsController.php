<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use Illuminate\Support\Facades\DB;

class AlumniStudentsController extends Controller
{
    //
    public function getAlumniStudents(){

        //get the students details
        $alumni_students = DB::table('students')->where('status', 'cleared')->orWhere('status', 'completed')->get();

        return view('students.show_alumni', ['alumni_students'=>$alumni_students]);
    }


    //show the specific alumni student
    public function getSpecificAlumni(Request $request, $studentID){        

        $student_id = $studentID;

        //get the student details from the database
        $student_details = DB::table('students')
                             ->where('id', $student_id)
                             ->where('status', 'cleared')
                             ->orWhere('status', 'completed')
                             ->whereNotNull('date_left')
                             ->get();

        if($student_details->isEmpty()){
            $request->session()->flash('no_such_student', 'There is no an alumni student with the id as '.$student_id);
            return redirect('/students/alumni');
        }

        $student_classes = DB::table('student_classes')
                             ->where('student_id', $student_id)
                             ->get();


        $student_address = DB::table('addresses')
                             ->join('student_address', 'addresses.id', 'student_address.address_id')
                             ->where('student_address.student_id', $student_id)
                             ->get();

        $student_parents = DB::table('parents')
                             ->join('student_parent', 'parents.id', 'student_parent.parent_id')
                             ->where('student_parent.student_id', $student_id)
                             ->get();
                             
        $student_result_slips = DB::table('student_marks_ranking')
                                  ->where('student_id', $student_id)
                                  ->get();

        $disciplinary_cases = DB::table('disciplinary_cases')
                                ->join('teachers', 'disciplinary_cases.teacher_id', 'teachers.id')
                                ->where('disciplinary_cases.student_id', $student_id)
                                ->get();
             
        return view('students.specific_alumni', [
            'student_details'=>$student_details,
            'student_classes'=>$student_classes,
            'student_address'=>$student_address,
            'student_parents'=>$student_parents,
            'student_result_slips'=>$student_result_slips,
            'student_disciplinary_cases'=>$disciplinary_cases
            ]);
    }
}
