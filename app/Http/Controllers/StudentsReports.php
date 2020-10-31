<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsReports extends Controller
{
    //
    public function showForm(){

        $students = DB::table('students')->where('id', 'dtyrty')->get();

        return view('reports.students_report', ['students'=>$students]);
        
    }

    public function getReport(Request $request){

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $students = DB::table('students')
                      ->whereBetween('date_of_admission', [$date_from, $date_to])
                      ->orderBy('admission_number')
                      ->get();

           if($students->isEmpty()){
            $request->session()->flash('no_reports', 'There are no students who were admitted between the date '.$date_from.' and date '.$date_to);
        }

        return view('reports.students_report', ['students'=>$students, 'date_from'=>$date_from, 'date_to'=>$date_to]);
        
    }

    public function downloadReport($date_from, $date_to){

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->getReportPDF($date_from, $date_to));
        return $pdf->stream();

    }  

    public function getReportPDF($date_from, $date_to){
        //query to get data

        $students = DB::table('students')
                      ->whereBetween('date_of_admission', [$date_from, $date_to])
                      ->orderBy('admission_number')
                      ->get();

;

        $current_date = date("Y-m-d");
         $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg" alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>
        <h3 style="text-align:center; text-decoration: underline;">List of students admitted between the date  '.$date_from.' and  date '.$date_to.' </h3>
        <p style="float: right;"> Printed on: '.$current_date.' </p>
        ';

        $output .='
        
                </table>
            <br>
                <table width="100%" style="border-collapse: collapse; border:0px;">
                        <tr>
                            <th style="border: 1px solid;   padding: 5px;" align="left" width="10%">#NO</th>
                            <th style="border: 1px solid;  padding: 5px;"  align="left" width="15%" >ADM No.</th>
                            <th style="border: 1px solid;  padding: 5px;"  align="left" >Name</th>
                            <th style="border: 1px solid; padding: 5px;" align="left" width="20%" >Current class</th>
                            <th style="border: 1px solid;  padding: 5px;" align="left" width="15%" >Gender</th>

                            
                        </tr>
             ';
             $i = 1;

             foreach ($students as $student ){
                $output .='
                         <tr>
                                 <td style="border: 1px solid; padding: 5px;">'.$i++.'</td>
                                 <td style="border: 1px solid; padding: 5px;">'.$student->admission_number.'</td>
                                 <td style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.'</td>
                                 <td style="border: 1px solid; padding: 5px;">'.$this->getClass($student->id).'</td>
                                 <td style="border: 1px solid; padding: 5px;" >'.$student->gender.'</td>
                         </tr> 
                 ';
             }

             
     $output .='
    
            
             </table>
     ';

        return $output;

    }

    public function getClass($id){
        $student_class = "";
        $class = DB::table('student_classes')
                    ->where('student_id', $id)
                    ->where('status', 'active')
                    ->get();

        if(!$class->isEmpty()){
            foreach ($class as $cls) {
                $student_class = $cls->stream;
            }
        } else{
            $student_class = "--";
        }
        return $student_class;
    }
}
