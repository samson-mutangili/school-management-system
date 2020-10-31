<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DisciplinaryCasesReports extends Controller
{
    //
    public function showForm(){
         //assign arbitrary value to transactions variable
         $cases = DB::table('disciplinary_cases')->where('case_id', '8765rfghg')->get();
         
         $date_from = "";
         $date_to = "";
 
         return view('reports.disciplinary_case_report', ['cases'=>$cases,  'date_from'=>$date_from, 'date_to'=>$date_to]);
 
    }

    //function for getting the reports
    public function getReport(Request $request){

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $cases = DB::table('disciplinary_cases')
                    ->join('students', 'disciplinary_cases.student_id', 'students.id')
                    ->whereBetween('disciplinary_cases.date_reported', [$date_from, $date_to])
                    ->orderBy('disciplinary_cases.date_reported', 'ASC')
                    ->get();

        if($cases->isEmpty()){
            $request->session()->flash('no_reports', 'There are no disciplinary cases reported as from the date '.$date_from.' to date '.$date_to);
        }


        return view('reports.disciplinary_case_report', ['cases'=>$cases,  'date_from'=>$date_from, 'date_to'=>$date_to]);
 
    }


    public function downloadReport($date_from, $date_to){

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->getDisciplinaryReportPDF($date_from, $date_to));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }


    public function getDisciplinaryReportPDF($date_from, $date_to){

         $cases = DB::table('disciplinary_cases')
                    ->join('students', 'disciplinary_cases.student_id', 'students.id')
                    ->whereBetween('disciplinary_cases.date_reported', [$date_from, $date_to])
                    ->orderBy('disciplinary_cases.date_reported', 'ASC')
                    ->get();


        $current_date = date("Y-m-d");
         $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg" alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>
        <h3 style="text-align:center; text-decoration: underline;">Disciplinary cases reported as from date '.$date_from.' to date '.$date_to.' </h3>
        <p style="float: right;"> Printed on: '.$current_date.' </p>
        ';

        $output .='
        
                </table>
            <br>
                <table width="100%" style="border-collapse: collapse; border:0px;">
                        <tr>
                            <th style="border-bottom: 1px solid; border-top: 1px solid;  padding: 5px;" align="left" width="3%">#NO</th>
                            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"  width="5" >Student ADM. NO</th>
                            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left" width="10%">Student Name</th>
                            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="5%" >Current class</th>
                            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="10%" >Case category</th>
                            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left" width="20%">Case description</th>
                            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="8%" >Date reported</th>
                            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="10%" >Reported By</th>
                            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="10%" >Action taken</th>
                            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="10%" >Status</th>

                            
                        </tr>
             ';
             $i = 1;


             foreach ($cases as $case ){
                $output .='
                         <tr>
                                 <td style=" padding: 5px; border-bottom: 1px solid;">'.$i++.'</td>
                                 <td style=" padding: 5px; border-bottom: 1px solid;">'.$case->admission_number.'</td>
                                 <td style=" padding: 5px; border-bottom: 1px solid;">'.$case->first_name.' '.$case->last_name.'</td>
                                 <td style=" padding: 5px; border-bottom: 1px solid;">'.$this->getClass($case->student_id).'</td>
                                 <td style=" padding: 5px; border-bottom: 1px solid;" >'.$case->case_category.'</td>
                                 <td style=" padding: 5px; border-bottom: 1px solid;" >'.$case->case_description.'</td>
                                 <td style=" padding: 5px; border-bottom: 1px solid;">'.$case->date_reported.'</td>
                                 <td style=" padding: 5px; border-bottom: 1px solid;">'.$this->getTeacher($case->teacher_id).'</td>
                                 <td style=" padding: 5px; border-bottom: 1px solid;">'.$case->action_taked.'</td>
                                 ';
                                 if($case->case_status == "cleared"){
                                   $output .=' <td style="color: green; border-bottom: 1px solid; padding: 5px;">'.$case->case_status.'</td>';
                                } else{
                                    $output .=' <td style="color: red; border-bottom: 1px solid; padding: 5px;">'.$case->case_status.'</td>';

                                 }
                                 
                         $output .='</tr> 
                 ';
             }

             

     $output .='</table>
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
    
   public function getTeacher($id){
        $name = "";
        $teachers = DB::table('teachers')->where('id', $id)->get();

        if(!$teachers->isEmpty()){
            foreach ($teachers as $teacher) {
                $name = $teacher->first_name.' '.$teacher->last_name;
            }
        } else {
            $name = "--";
        }

        return $name;
    }


    

}


