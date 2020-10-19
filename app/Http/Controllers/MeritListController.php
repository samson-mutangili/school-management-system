<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class MeritListController extends Controller
{

    //

    //function for viewing merit list
    public function viewMeritList(Request $request, $className){

        //get the class name
        $class_name = $className;        

        //get the full url 
        $reference_link = $request->fullUrl();

        //get the specific streams in classes
        $streams;
        $real_class_name;

        //get the class streams
        if($class_name == 'form1' ){
            $streams = ['1E', '1W'];
            $real_class_name = 'FORM 1';
        } else if($class_name == 'form2'){
            $streams = ['2E', '2W'];
            $real_class_name = 'FORM 2';
        } else if($class_name == 'form3'){
            $streams = ['3E', '3W'];
            $real_class_name = 'FORM 3';
        } elseif($class_name == 'form4'){
            $streams = ['4E', '4W'];
            $real_class_name = 'FORM 4';
        } else{
            echo 'The class does not exist';
            exit();
        }

        //get the academic year, term and exam type
        //get the year, term and exam type
        $period = $this->getPeriod();

        $year = $period[0];
        $month = $period[1];
        $term = $period[2];
        $exam_type = $period[3];

        //get the term session and exams sessions periods
        $term_exam = DB::table('term_sessions')
                        ->join('exam_sessions', 'term_sessions.term_id', 'exam_sessions.term_id')
                        ->where('term_sessions.status', 'active')
                        ->where('exam_sessions.exam_status', 'active')
                        ->get();

                        $no_exam_session = "";
        if(!$term_exam->isEmpty()){
            //get the exam session period
            foreach($term_exam as $exam_period){
                $year = $exam_period->year;
                $term = $exam_period->term;
                $exam_type = $exam_period->exam_type;
            }

        } else{
            $no_exam_session = "There is no active exam session. Entry of marks to students is only allowed if there an active exam session";
            return view('marks_entry', ['no_exam_session'=>$no_exam_session]);
        }

        //rankign position;
        $position = 1;
        //get the student details according to performance
        $students_performance = DB::table('student_marks_ranking')
                                  ->where('year', $year)
                                  ->where('term', $term)
                                  ->where('exam_type', $exam_type)
                                  ->where('class_name', $streams[0])
                                  ->orwhere('class_name', $streams[1])
                                  ->orderby('average_marks', 'DESC')
                                  ->get();
        
       
    //     return view('view_demo',
    //                     [
    //                         'streams'=>$streams,
    //                         'real_class_name'=>$real_class_name,
    //                         'reference_link'=>$reference_link,
    //                         'year'=>$year,
    //                         'term'=>$term,
    //                         'exam_type'=>$exam_type

    //                     ]
    // );

    }


    public function getMeritList(Request $request, $className){

        //get the class name
        $class_name = $className;        

        //get the full url 
        $reference_link = $request->fullUrl();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->meritListPDF($class_name, $reference_link));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();



            

    }

    public function meritListPDF($class_name, $reference_link){

        //get the specific streams in classes
        $streams;
        $real_class_name;

        //get the class streams
        if($class_name == 'form1' ){
            $streams = ['1E', '1W'];
            $real_class_name = 'FORM 1';
        } else if($class_name == 'form2'){
            $streams = ['2E', '2W'];
            $real_class_name = 'FORM 2';
        } else if($class_name == 'form3'){
            $streams = ['3E', '3W'];
            $real_class_name = 'FORM 3';
        } elseif($class_name == 'form4'){
            $streams = ['4E', '4W'];
            $real_class_name = 'FORM 4';
        } else{
            echo 'The class does not exist';
            exit();
        }

        //get the academic year, term and exam type
        //get the year, term and exam type
        $period = $this->getPeriod();

        $year = $period[0];
        $month = $period[1];
        $term = $period[2];
        $exam_type = $period[3];

        //rankign position;
        $position = 1;
        //get the student details according to performance
        $students_performance = DB::table('student_marks_ranking')
                                  ->where('year', $year)
                                  ->where('term', $term)
                                  ->where('exam_type', $exam_type)
                                  ->where('class_name', $streams[0])
                                  ->orwhere('class_name', $streams[1])
                                  ->orderby('average_marks', 'DESC')
                                  ->get();
        



        $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg" alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>
        <h2 style="text-align:center;">MERIT LIST      for  '.  $real_class_name.'       Term '.$term.' '.$exam_type.' EXAM,   '.$year.'</h2>
        ';
       
        
        $output .= '
        
        <table width="100%" style="border-collapse: collapse; border:0px;">
            <tr>
                <th style="border: 1px solid; padding: 5px;" align="left"width="3%" >Pos</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" >Name</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="4%">CLASS</th>
                <th style="border: 1px solid; padding: 5px;" align="left"  width="3%">ENG</th>
                <th style="border: 1px solid; padding: 5px;" align="left" width="4%">KISW</th>
                <th style="border: 1px solid; padding: 5px;" align="left" width="4%" >MATH</th>
                <th style="border: 1px solid; padding: 5px;" align="left" width="4%" >CHEM</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="3%">PHY</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="3%">BIO</th>
                <th style="border: 1px solid; padding: 5px;" align="left" width="3%" >B/S</th>
                <th style="border: 1px solid; padding: 5px;" align="left" width="3%">GEO</th>
                <th style="border: 1px solid; padding: 5px;" align="left" width="3%" >CRE</th>
                <th style="border: 1px solid; padding: 5px;" align="left" width="4%">AGRI</th>
                <th style="border: 1px solid; padding: 5px;" align="left" width="4%">HIST</th>
                <th style="border: 1px solid; padding: 5px;" align="left" width="4%" >TOTAL</th>
                <th style="border: 1px solid; padding: 5px;" align="left" width="5%" > AVG</th>
                <th style="border: 1px solid; padding: 5px;" align="left"  width="4%">GRADE</th>
                

            </tr>
       
    
    ';

    foreach($students_performance as $performance){

            $output .='
                <tr>
                <td  style="border: 1px solid; padding: 5px;"> '.$position++.'</td>
                ';

                //select the student name
                $student_details = DB::table('students')
                                     ->where('id', $performance->student_id)
                                     ->get();
                foreach($student_details as $personal_details){
                    $output .='
                    <td  style="border: 1px solid; padding: 5px;"> '.$personal_details->first_name. ' ' .$personal_details->middle_name. ' ' .$personal_details->last_name.'</td> 
                    ';
                }

                $output .= '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->class_name.'</td> 

                ';


                if($performance->english != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->english.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }

                if($performance->kiswahili != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->kiswahili.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }

                if($performance->mathematics != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->mathematics.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }

                if($performance->chemistry != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->chemistry.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }

                if($performance->physics != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->physics.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }

                if($performance->biology != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->biology.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }

                if($performance->business_studies != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->business_studies.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }

                if($performance->geography != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->geography.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }

                if($performance->cre != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->cre.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }

                if($performance->agriculture != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->agriculture.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }

                if($performance->history != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->history.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }

                if($performance->total != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->total.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }

                if($performance->average_marks != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->average_marks.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }

                if($performance->average_grade != null){
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> '.$performance->average_grade.'</td>
                    ';
                } else{
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;"> - </td>
                    ';
                }


               $output .='
               

               
               </tr>

            ';

    }


 
    $overallPerformance = $this->getOverallPerformance($year, $term, $exam_type, $streams);



    $output .= ' </table>';


     $totalA_plain = $overallPerformance[0][0] + $overallPerformance[1][0];
     $totalA_minus = $overallPerformance[0][1] + $overallPerformance[1][1];
     $totalB_plus = $overallPerformance[0][2] + $overallPerformance[1][2];
     $totalB_plain = $overallPerformance[0][3] + $overallPerformance[1][3];
     $totalB_minus = $overallPerformance[0][4] + $overallPerformance[1][4];
     $totalC_plus = $overallPerformance[0][5] + $overallPerformance[1][5];
     $totalC_plain = $overallPerformance[0][6] + $overallPerformance[1][6];
     $totalC_minus = $overallPerformance[0][7] + $overallPerformance[1][7];
     $totalD_plus = $overallPerformance[0][8] + $overallPerformance[1][8];
     $totalD_plain = $overallPerformance[0][9] + $overallPerformance[1][9];
     $totalD_minus = $overallPerformance[0][10] + $overallPerformance[1][10];
     $totalE = $overallPerformance[0][11] + $overallPerformance[1][11];
     
    $output .='

    <br><br>
    <p style="text-decoration: underline; font-size: 20px;">Overall performance</p>
    
    <table width="100%" style="border-collapse: collapse; border:0px;">
    <tr>
        <th style="border: 1px solid; padding: 5px;" align="left" ></th>
        <th style="border: 1px solid; padding: 5px;"  align="left" >A</th>
        <th style="border: 1px solid; padding: 5px;"  align="left">A-</th>
        <th style="border: 1px solid; padding: 5px;" align="left"  >B+</th>
        <th style="border: 1px solid; padding: 5px;" align="left" >B</th>
        <th style="border: 1px solid; padding: 5px;" align="left"  >B-</th>
        <th style="border: 1px solid; padding: 5px;" align="left" >C+</th>
        <th style="border: 1px solid; padding: 5px;"  align="left" >C</th>
        <th style="border: 1px solid; padding: 5px;"  align="left">C-</th>
        <th style="border: 1px solid; padding: 5px;" align="left" >D+</th>
        <th style="border: 1px solid; padding: 5px;" align="left" >D</th>
        <th style="border: 1px solid; padding: 5px;" align="left"  >D-</th>
        <th style="border: 1px solid; padding: 5px;" align="left" >E</th>
        

    </tr>

    <tr>
         <td  style="border: 1px solid; padding: 5px;">FORM  '.$streams[0].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[0][0].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[0][1].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[0][2].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[0][3].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[0][4].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[0][5].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[0][6].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[0][7].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[0][8].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[0][9].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[0][10].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[0][11].'</td>
    </tr>

    <tr>
         <td  style="border: 1px solid; padding: 5px;">FORM  '.$streams[1].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[1][0].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[1][1].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[1][2].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[1][3].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[1][4].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[1][5].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[1][6].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[1][7].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[1][8].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[1][9].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[1][10].'</td>
         <td  style="border: 1px solid; padding: 5px;">'.$overallPerformance[1][11].'</td>
    </tr>


                   <tr>
                            <td  style="border: 1px solid; padding: 5px;">TOTAL</td>
                            <td  style="border: 1px solid; padding: 5px;">'.$totalA_plain.'</td>
                            <td  style="border: 1px solid; padding: 5px;">'.$totalA_minus.'</td>
                            <td  style="border: 1px solid; padding: 5px;">'.$totalB_plus.'</td>
                            <td  style="border: 1px solid; padding: 5px;">'.$totalB_plain.'</td>
                            <td  style="border: 1px solid; padding: 5px;">'.$totalB_minus.'</td>
                            <td  style="border: 1px solid; padding: 5px;">'.$totalC_plus.'</td>
                            <td  style="border: 1px solid; padding: 5px;">'.$totalC_plain.'</td>
                            <td  style="border: 1px solid; padding: 5px;">'.$totalC_minus.'</td>
                            <td  style="border: 1px solid; padding: 5px;">'.$totalD_plus.'</td>
                            <td  style="border: 1px solid; padding: 5px;">'.$totalD_plain.'</td>
                            <td  style="border: 1px solid; padding: 5px;">'.$totalD_minus.'</td>
                            <td  style="border: 1px solid; padding: 5px;">'.$totalE.'</td>
                       </tr>
    
    
    



        </table>
    ';

    //get the subject performance per class and total averages
    $english_performance = $this->getSubjectPerformance($year, $term, $exam_type, $streams, 'english');
    $kiswahili_performance = $this->getSubjectPerformance($year, $term, $exam_type, $streams, 'kiswahili');
    $mathematics_performance = $this->getSubjectPerformance($year, $term, $exam_type, $streams, 'mathematics');
    $chemistry_performance = $this->getSubjectPerformance($year, $term, $exam_type, $streams, 'chemistry');
    $physics_performance = $this->getSubjectPerformance($year, $term, $exam_type, $streams, 'physics');
    $biology_performance = $this->getSubjectPerformance($year, $term, $exam_type, $streams, 'biology');
    $business_studies_performance = $this->getSubjectPerformance($year, $term, $exam_type, $streams, 'business_studies');
    $geography_performance = $this->getSubjectPerformance($year, $term, $exam_type, $streams, 'geography');
    $cre_performance = $this->getSubjectPerformance($year, $term, $exam_type, $streams, 'cre');
    $agriculture_performance = $this->getSubjectPerformance($year, $term, $exam_type, $streams, 'agriculture');
    $history_performance = $this->getSubjectPerformance($year, $term, $exam_type, $streams, 'history');

    $output .='

            <br><br>
            <p style="text-decoration: underline; font-size: 20px;">Subject performance as per stream and overall</p>
            <table width="100%" style="border-collapse: collapse; border:0px;">
            <tr>
                <th style="border: 1px solid; padding: 5px;" align="left" width="16%" ></th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="6%" >ENG</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="6%" >KISW</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="6%" >MATH</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="6%" >CHEM</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="6%" >PHY</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="6%" >BIO</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="6%" >B/S</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="6%" >GEO</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="6%" >CRE</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="6%" >AGRI</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="6%" >HIST</th>
                
            </tr>

            <tr>
                <td style="border: 1px solid; padding: 5px;">Form '.$streams[0].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$english_performance[0].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$kiswahili_performance[0].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$mathematics_performance[0].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$chemistry_performance[0].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$physics_performance[0].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$biology_performance[0].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$business_studies_performance[0].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$geography_performance[0].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$cre_performance[0].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$agriculture_performance[0].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$history_performance[0].'</td>

            </tr>


            <tr>
                <td style="border: 1px solid; padding: 5px;">Form '.$streams[1].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$english_performance[1].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$kiswahili_performance[1].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$mathematics_performance[1].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$chemistry_performance[1].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$physics_performance[1].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$biology_performance[1].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$business_studies_performance[1].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$geography_performance[1].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$cre_performance[1].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$agriculture_performance[1].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$history_performance[1].'</td>

          </tr>

         <tr>
                <td style="border: 1px solid; padding: 5px;">Total averages</td>
                <td style="border: 1px solid; padding: 5px;">'.$english_performance[2].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$kiswahili_performance[2].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$mathematics_performance[2].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$chemistry_performance[2].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$physics_performance[2].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$biology_performance[2].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$business_studies_performance[2].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$geography_performance[2].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$cre_performance[2].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$agriculture_performance[2].'</td>
                <td style="border: 1px solid; padding: 5px;">'.$history_performance[2].'</td>

        </tr>

            </table>
    
    ';



    //get the class performances
    $averages = $this->getAveragePerformances($year, $term, $exam_type, $streams);
    $round_stream1_average = round($averages[0], 2);
    $round_stream2_average = round($averages[1], 2);
    $round_class_average = round($averages[2], 2);

    // table for the class performances
    $output .= '
    <br><br>
    <p style="text-decoration: underline; font-size: 20px;">Class performance as per stream and overall</p>
    <table width="40%" style="border-collapse: collapse; border:0px;">
    <tr>
        <th style="border: 1px solid; padding: 5px;" align="left" width="20%" >Class</th>
        <th style="border: 1px solid; padding: 5px;"  align="left" width="20%" >Average</th>
        
    </tr>

    <tr>
        <td style="border: 1px solid; padding: 5px;">Form '.$streams[0].'</td>
        <td style="border: 1px solid; padding: 5px;">'.$round_stream1_average.'</td>

    </tr>

    <tr>
    <td style="border: 1px solid; padding: 5px;">Form '.$streams[1].'</td>
    <td style="border: 1px solid; padding: 5px;">'.$round_stream2_average.'</td>
    </tr>

    <tr>
    <td style="border: 1px solid; padding: 5px;">Total average</td>
    <td style="border: 1px solid; padding: 5px;">'.$round_class_average.'</td>
    </tr>

    </table>
    ';

    $output .= '
         <br><br>
        <p style="text-decoration: underline; font-size: 20px;">Best students as per subject</p>
        <table width="70%" style="border-collapse: collapse; border:0px;">
        <tr>
            <th style="border: 1px solid; padding: 5px;" align="left" width="20%" >Subject</th>
            <th style="border: 1px solid; padding: 5px;"  align="left" width="35%" >Student name</th>
            <th style="border: 1px solid; padding: 5px;"  align="left" width="20%">Class</th>
            <th style="border: 1px solid; padding: 5px;" align="left" width="20%" >Marks</th>
            
    
        </tr>

        ';

        $best_in_english = $this->getBestStudentInSubject($year, $term, $exam_type, $streams, 'english');

        $i = 1;
        $first_student_english_marks;
        $second_student_english_marks;
        $other_student_english_marks;

        foreach($best_in_english as $best_english){

            if($i == 2){
                if($first_student_english_marks == $best_english->english){

                } else{
                    break;
                }
            }

            if($i == 3){
                if($second_student_english_marks == $best_english->english){

                } else{
                    break;
                }
            }

            $output .= '
            <tr>
            <td  style="border: 1px solid; padding: 5px;">English</td>
            ';

            //get the student name
            $student_name = DB::table('students')
                              ->where('id', $best_english->student_id)
                              ->get();
            
            foreach($student_name as $student){
                $output .= '
                <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

                ';
            }

            if($i == 1){
                $first_student_english_marks = $best_english->english;
                $i++;
            } else if($i == 2){
                $second_student_english_marks_marks = $best_english->english;
                $i++;
            } else{
                $other_student_english_marks = $best_english->english;
            }

            $output .= ' 
            <td  style="border: 1px solid; padding: 5px;">'.$best_english->class_name.'</td>
            <td  style="border: 1px solid; padding: 5px;">'.$best_english->english.'</td>
        </tr>

        
            ';
        }
        


        //best student in kiswahili

        $best_in_kiswahili = $this->getBestStudentInSubject($year, $term, $exam_type, $streams, 'kiswahili');

        $i = 1;
        $first_student_kiswahili_marks;
        $second_student_kiswahili_marks;
        $other_student_kiswahili_marks;

        foreach($best_in_kiswahili as $best_kiswahili){

            if($i == 2){
                if($first_student_kiswahili_marks == $best_kiswahili->kiswahili){

                } else{
                    break;
                }
            }

            if($i == 3){
                if($second_student_kiswahili_marks == $best_kiswahili->kiswahili){

                } else{
                    break;
                }
            }

            $output .= '
            <tr>
            <td  style="border: 1px solid; padding: 5px;">Kiswahili</td>
            ';

            //get the student name
            $student_name = DB::table('students')
                              ->where('id', $best_kiswahili->student_id)
                              ->get();
            
            foreach($student_name as $student){
                $output .= '
                <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

                ';
            }

            if($i == 1){
                $first_student_kiswahili_marks = $best_kiswahili->kiswahili;
                $i++;
            } else if($i == 2){
                $second_student_kiswahili_marks_marks = $best_kiswahili->kiswahili;
                $i++;
            } else{
                $other_student_kiswahili_marks = $best_kiswahili->kiswahili;
            }

            $output .= ' 
            <td  style="border: 1px solid; padding: 5px;">'.$best_kiswahili->class_name.'</td>
            <td  style="border: 1px solid; padding: 5px;">'.$best_kiswahili->kiswahili.'</td>
        </tr>

        
            ';
        }

        //get the best in mathematics

        $best_in_mathematics = $this->getBestStudentInSubject($year, $term, $exam_type, $streams, 'mathematics');

        $i = 1;
        $first_student_mathematics_marks;
        $second_student_mathematics_marks;
        $other_student_mathematics_marks;

        foreach($best_in_mathematics as $best_mathematics){

            if($i == 2){
                if($first_student_mathematics_marks == $best_mathematics->mathematics){

                } else{
                    break;
                }
            }

            if($i == 3){
                if($second_student_mathematics_marks == $best_mathematics->mathematics){

                } else{
                    break;
                }
            }

            $output .= '
            <tr>
            <td  style="border: 1px solid; padding: 5px;">Mathematics</td>
            ';

            //get the student name
            $student_name = DB::table('students')
                              ->where('id', $best_mathematics->student_id)
                              ->get();
            
            foreach($student_name as $student){
                $output .= '
                <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

                ';
            }

            if($i == 1){
                $first_student_mathematics_marks = $best_mathematics->mathematics;
                $i++;
            } else if($i == 2){
                $second_student_mathematics_marks_marks = $best_mathematics->mathematics;
                $i++;
            } else{
                $other_student_mathematics_marks = $best_mathematics->mathematics;
            }

            $output .= ' 
            <td  style="border: 1px solid; padding: 5px;">'.$best_mathematics->class_name.'</td>
            <td  style="border: 1px solid; padding: 5px;">'.$best_mathematics->mathematics.'</td>
        </tr>

        
            ';
        }

        //get the best in chemistry


        $best_in_chemistry = $this->getBestStudentInSubject($year, $term, $exam_type, $streams, 'chemistry');

        $i = 1;
        $first_student_chemistry_marks;
        $second_student_chemistry_marks;
        $other_student_chemistry_marks;

        foreach($best_in_chemistry as $best_chemistry){

            if($i == 2){
                if($first_student_chemistry_marks == $best_chemistry->chemistry){

                } else{
                    break;
                }
            }

            if($i == 3){
                if($second_student_chemistry_marks == $best_chemistry->chemistry){

                } else{
                    break;
                }
            }

            $output .= '
            <tr>
            <td  style="border: 1px solid; padding: 5px;">Chemistry</td>
            ';

            //get the student name
            $student_name = DB::table('students')
                              ->where('id', $best_chemistry->student_id)
                              ->get();
            
            foreach($student_name as $student){
                $output .= '
                <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

                ';
            }

            if($i == 1){
                $first_student_chemistry_marks = $best_chemistry->chemistry;
                $i++;
            } else if($i == 2){
                $second_student_chemistry_marks_marks = $best_chemistry->chemistry;
                $i++;
            } else{
                $other_student_chemistry_marks = $best_chemistry->chemistry;
            }

            $output .= ' 
            <td  style="border: 1px solid; padding: 5px;">'.$best_chemistry->class_name.'</td>
            <td  style="border: 1px solid; padding: 5px;">'.$best_chemistry->chemistry.'</td>
        </tr>

        
            ';
        }

        //get the best in physics


        $best_in_physics = $this->getBestStudentInSubject($year, $term, $exam_type, $streams, 'physics');

        $i = 1;
        $first_student_physics_marks;
        $second_student_physics_marks;
        $other_student_physics_marks;

        foreach($best_in_physics as $best_physics){

            if($i == 2){
                if($first_student_physics_marks == $best_physics->physics){

                } else{
                    break;
                }
            }

            if($i == 3){
                if($second_student_physics_marks == $best_physics->physics){

                } else{
                    break;
                }
            }

            $output .= '
            <tr>
            <td  style="border: 1px solid; padding: 5px;">Physics</td>
            ';

            //get the student name
            $student_name = DB::table('students')
                              ->where('id', $best_physics->student_id)
                              ->get();
            
            foreach($student_name as $student){
                $output .= '
                <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

                ';
            }

            if($i == 1){
                $first_student_physics_marks = $best_physics->physics;
                $i++;
            } else if($i == 2){
                $second_student_physics_marks = $best_physics->physics;
                $i++;
            } else{
                $other_student_physics_marks = $best_physics->physics;
            }

            $output .= ' 
            <td  style="border: 1px solid; padding: 5px;">'.$best_physics->class_name.'</td>
            <td  style="border: 1px solid; padding: 5px;">'.$best_physics->physics.'</td>
        </tr>

        
            ';
        }

        //get the best student in biology
        $best_in_biology = $this->getBestStudentInSubject($year, $term, $exam_type, $streams, 'biology');

        $i = 1;
        $first_student_biology_marks;
        $second_student_biology_marks;
        $other_student_biology_marks;

        foreach($best_in_biology as $best_biology){

            if($i == 2){
                if($first_student_biology_marks == $best_biology->biology){

                } else{
                    break;
                }
            }

            if($i == 3){
                if($second_student_biology_marks == $best_biology->biology){

                } else{
                    break;
                }
            }

            $output .= '
            <tr>
            <td  style="border: 1px solid; padding: 5px;">Biology</td>
            ';

            //get the student name
            $student_name = DB::table('students')
                              ->where('id', $best_biology->student_id)
                              ->get();
            
            foreach($student_name as $student){
                $output .= '
                <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

                ';
            }

            if($i == 1){
                $first_student_biology_marks = $best_biology->biology;
                $i++;
            } else if($i == 2){
                $second_student_biology_marks = $best_biology->biology;
                $i++;
            } else{
                $other_student_biology_marks = $best_biology->biology;
            }

            $output .= ' 
            <td  style="border: 1px solid; padding: 5px;">'.$best_biology->class_name.'</td>
            <td  style="border: 1px solid; padding: 5px;">'.$best_biology->biology.'</td>
        </tr>

        
            ';
        }

        //get the best student in business studies
        $best_in_business_studies = $this->getBestStudentInSubject($year, $term, $exam_type, $streams, 'business_studies');

        $i = 1;
        $first_student_business_studies_marks;
        $second_student_business_studies_marks;
        $other_student_business_studies_marks;

        foreach($best_in_business_studies as $best_business_studies){

            if($i == 2){
                if($first_student_business_studies_marks == $best_business_studies->business_studies){

                } else{
                    break;
                }
            }

            if($i == 3){
                if($second_student_business_studies_marks == $best_business_studies->business_studies){

                } else{
                    break;
                }
            }

            $output .= '
            <tr>
            <td  style="border: 1px solid; padding: 5px;">Business studies</td>
            ';

            //get the student name
            $student_name = DB::table('students')
                              ->where('id', $best_business_studies->student_id)
                              ->get();
            
            foreach($student_name as $student){
                $output .= '
                <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

                ';
            }

            if($i == 1){
                $first_student_business_studies_marks = $best_business_studies->business_studies;
                $i++;
            } else if($i == 2){
                $second_student_business_studies_marks = $best_business_studies->business_studies;
                $i++;
            } else{
                $other_student_business_studies_marks = $best_business_studies->business_studies;
            }

            $output .= ' 
            <td  style="border: 1px solid; padding: 5px;">'.$best_business_studies->class_name.'</td>
            <td  style="border: 1px solid; padding: 5px;">'.$best_business_studies->business_studies.'</td>
        </tr>

        
            ';
        }

        //get the best in geography
        $best_in_geography = $this->getBestStudentInSubject($year, $term, $exam_type, $streams, 'geography');

        $i = 1;
        $first_student_geography_marks;
        $second_student_geography_marks;
        $other_student_geography_marks;

        foreach($best_in_geography as $best_geography){

            if($i == 2){
                if($first_student_geography_marks == $best_geography->geography){

                } else{
                    break;
                }
            }

            if($i == 3){
                if($second_student_geography_marks == $best_geography->geography){

                } else{
                    break;
                }
            }

            $output .= '
            <tr>
            <td  style="border: 1px solid; padding: 5px;">Geography</td>
            ';

            //get the student name
            $student_name = DB::table('students')
                              ->where('id', $best_geography->student_id)
                              ->get();
            
            foreach($student_name as $student){
                $output .= '
                <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

                ';
            }

            if($i == 1){
                $first_student_geography_marks = $best_geography->geography;
                $i++;
            } else if($i == 2){
                $second_student_geography_marks = $best_geography->geography;
                $i++;
            } else{
                $other_student_geography_marks = $best_geography->geography;
            }

            $output .= ' 
            <td  style="border: 1px solid; padding: 5px;">'.$best_geography->class_name.'</td>
            <td  style="border: 1px solid; padding: 5px;">'.$best_geography->geography.'</td>
        </tr>

        
            ';
        }

        //get the best in cre
        $best_in_cre = $this->getBestStudentInSubject($year, $term, $exam_type, $streams, 'cre');

        $i = 1;
        $first_student_cre_marks;
        $second_student_cre_marks;
        $other_student_cre_marks;

        foreach($best_in_cre as $best_cre){

            if($i == 2){
                if($first_student_cre_marks == $best_cre->cre){

                } else{
                    break;
                }
            }

            if($i == 3){
                if($second_student_cre_marks == $best_cre->cre){

                } else{
                    break;
                }
            }

            $output .= '
            <tr>
            <td  style="border: 1px solid; padding: 5px;">CRE</td>
            ';

            //get the student name
            $student_name = DB::table('students')
                              ->where('id', $best_cre->student_id)
                              ->get();
            
            foreach($student_name as $student){
                $output .= '
                <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

                ';
            }

            if($i == 1){
                $first_student_cre_marks = $best_cre->cre;
                $i++;
            } else if($i == 2){
                $second_student_cre_marks = $best_cre->cre;
                $i++;
            } else{
                $other_student_cre_marks = $best_cre->cre;
            }

            $output .= ' 
            <td  style="border: 1px solid; padding: 5px;">'.$best_cre->class_name.'</td>
            <td  style="border: 1px solid; padding: 5px;">'.$best_cre->cre.'</td>
        </tr>

        
            ';
        }

        //get the best student in agriculture
        $best_in_agriculture = $this->getBestStudentInSubject($year, $term, $exam_type, $streams, 'agriculture');

        $i = 1;
        $first_student_agriculture_marks;
        $second_student_agriculture_marks;
        $other_student_agriculture_marks;

        foreach($best_in_agriculture as $best_agriculture){

            if($i == 2){
                if($first_student_agriculture_marks == $best_agriculture->agriculture){

                } else{
                    break;
                }
            }

            if($i == 3){
                if($second_student_agriculture_marks == $best_agriculture->agriculture){

                } else{
                    break;
                }
            }

            $output .= '
            <tr>
            <td  style="border: 1px solid; padding: 5px;">Agriculture</td>
            ';

            //get the student name
            $student_name = DB::table('students')
                              ->where('id', $best_agriculture->student_id)
                              ->get();
            
            foreach($student_name as $student){
                $output .= '
                <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

                ';
            }

            if($i == 1){
                $first_student_agriculture_marks = $best_agriculture->agriculture;
                $i++;
            } else if($i == 2){
                $second_student_agriculture_marks = $best_agriculture->agriculture;
                $i++;
            } else{
                $other_student_agriculture_marks = $best_agriculture->agriculture;
            }

            $output .= ' 
            <td  style="border: 1px solid; padding: 5px;">'.$best_agriculture->class_name.'</td>
            <td  style="border: 1px solid; padding: 5px;">'.$best_agriculture->agriculture.'</td>
        </tr>

        
            ';
        }

        //get the best student in history
        $best_in_history = $this->getBestStudentInSubject($year, $term, $exam_type, $streams, 'history');

        $i = 1;
        $first_student_history_marks;
        $second_student_history_marks;
        $other_student_history_marks;

        foreach($best_in_history as $best_history){

            if($i == 2){
                if($first_student_history_marks == $best_history->history){

                } else{
                    break;
                }
            }

            if($i == 3){
                if($second_student_history_marks == $best_history->history){

                } else{
                    break;
                }
            }

            $output .= '
            <tr>
            <td  style="border: 1px solid; padding: 5px;">History</td>
            ';

            //get the student name
            $student_name = DB::table('students')
                              ->where('id', $best_history->student_id)
                              ->get();
            
            foreach($student_name as $student){
                $output .= '
                <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

                ';
            }

            if($i == 1){
                $first_student_history_marks = $best_history->history;
                $i++;
            } else if($i == 2){
                $second_student_history_marks = $best_history->history;
                $i++;
            } else{
                $other_student_history_marks = $best_history->history;
            }

            $output .= ' 
            <td  style="border: 1px solid; padding: 5px;">'.$best_history->class_name.'</td>
            <td  style="border: 1px solid; padding: 5px;">'.$best_history->history.'</td>
        </tr>

        
            ';
        }

     $output .= '  
       
        </table>

    ';
    //abbreviations meaning
    $output .= '
    <br><br>
    <p style="text-decoration: underline;">Abbreviations meaning<p>
        
    ENG - English <br>
    KISW - Kiswahili <br>
    MATH - Mathematics <br>
    CHEM - Chemistry <br>
    PHY - Physics <br>
    BIO - Biology <br>
    B/S - Business studies <br>
    GEO - Geography <br>
    CRE - Christian Religious Education <br>
    AGRI - Agriculture <br>
    HIST - History <br><br>

    AVG - Average <br>

    ';

    $output .='
    <br><br>

    <p style="text-decoration: italics;" >Reference link: <a  style="text-decoration: none;" href="'.$reference_link.'">'.$reference_link.'</a></p>
    ';

    

    return $output;


    }



       //function that gets the time period
       public function getPeriod(){

        //get the academic year, term and exam type
        //get the year, term and exam type
        $year = date("Y");
        $month = date("m");
        $term;
        $exam_type;

       if($month >= 1 && $month <= 4){
           $term = 1;
           if($month == 1){
               $exam_type = "Opener";
           }
           else if($month == 2){
               $exam_type = "Mid term";
           }
           else if($month == 3 || $month == 4){
               $exam_type = "End term";
           }
       }
       else if($month >= 5 && $month <= 8){
           $term = 2;
           if($month == 5){
               $exam_type = "Opener";
           }
           else if($month == 6){
               $exam_type = "Mid term";
           }
           else if($month == 7 || $month == 8){
               $exam_type = "End term";
           }
       } 
       else if($month >= 9 && $month <= 12){
           $term = 3;
           if($month == 9){
               $exam_type = "Opener";
           }
           else if($month == 10){
               $exam_type = "Mid term";
           }
           else if($month == 11 || $month == 12){
               $exam_type = "End term";
           }
       }

       return array($year, $month, $term, $exam_type);

    }

    //function that gets the overall performance
    public function getOverallPerformance($year, $term, $exam_type, $streams){

        //get stream 1 performance in terms of average grades
        $stream1_A_plain = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->where('average_grade', 'A')
                             ->count();

        $stream1_A_plain = (int)($stream1_A_plain);

        $stream1_A_minus = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->where('average_grade', 'A-')
                             ->count();
        $stream1_A_minus = (int)($stream1_A_minus);

        $stream1_B_plus = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->where('average_grade', 'B+')
                             ->count();

        $stream1_B_plain = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->where('average_grade', 'B')
                             ->count();

        $stream1_B_minus = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->where('average_grade', 'B-')
                             ->count();

        $stream1_C_plus = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->where('average_grade', 'C+')
                             ->count();

        $stream1_C_plain = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->where('average_grade', 'C')
                             ->count();

        $stream1_C_minus = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->where('average_grade', 'C-')
                             ->count();

        $stream1_D_plus = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->where('average_grade', 'D+')
                             ->count();

        $stream1_D_plain = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->where('average_grade', 'D')
                             ->count();

        $stream1_D_minus = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->where('average_grade', 'D-')
                             ->count();

        $stream1_E = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->where('average_grade', 'E')
                             ->count();


        //get stream 2 performance in terms of average grades
        $stream2_A_plain = DB::table('student_marks_ranking')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->where('class_name', $streams[1])
                            ->where('average_grade', 'A')
                            ->count();
        $stream2_A_plain = (int)($stream2_A_plain);

        $stream2_A_minus = DB::table('student_marks_ranking')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->where('class_name', $streams[1])
                            ->where('average_grade', 'A-')
                            ->count();
        $stream2_A_minus = (int)($stream2_A_minus);

        $stream2_B_plus = DB::table('student_marks_ranking')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->where('class_name', $streams[1])
                            ->where('average_grade', 'B+')
                            ->count();

        $stream2_B_plain = DB::table('student_marks_ranking')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->where('class_name', $streams[1])
                            ->where('average_grade', 'B')
                            ->count();

        $stream2_B_minus = DB::table('student_marks_ranking')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->where('class_name', $streams[1])
                            ->where('average_grade', 'B-')
                            ->count();

        $stream2_C_plus = DB::table('student_marks_ranking')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->where('class_name', $streams[1])
                            ->where('average_grade', 'C+')
                            ->count();

        $stream2_C_plain = DB::table('student_marks_ranking')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->where('class_name', $streams[1])
                            ->where('average_grade', 'C')
                            ->count();

        $stream2_C_minus = DB::table('student_marks_ranking')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->where('class_name', $streams[1])
                            ->where('average_grade', 'C-')
                            ->count();

        $stream2_D_plus = DB::table('student_marks_ranking')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->where('class_name', $streams[1])
                            ->where('average_grade', 'D+')
                            ->count();

        $stream2_D_plain = DB::table('student_marks_ranking')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->where('class_name', $streams[1])
                            ->where('average_grade', 'D')
                            ->count();

        $stream2_D_minus = DB::table('student_marks_ranking')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->where('class_name', $streams[1])
                            ->where('average_grade', 'D-')
                            ->count();

        $stream2_E = DB::table('student_marks_ranking')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->where('class_name', $streams[1])
                            ->where('average_grade', 'E')
                            ->count();

                            
                   

        $stream1 = [$stream1_A_plain, $stream1_A_minus, $stream1_B_plus, $stream1_B_plain, $stream1_B_minus, $stream1_C_plus, $stream1_C_plain, $stream1_C_minus, $stream1_D_plus, $stream1_D_plain, $stream1_D_minus, $stream1_E];
        $stream2 = [$stream2_A_plain, $stream2_A_minus, $stream2_B_plus, $stream2_B_plain, $stream2_B_minus, $stream2_C_plus, $stream2_C_plain, $stream2_C_minus, $stream2_D_plus, $stream2_D_plain, $stream2_D_minus, $stream2_E];
    
        return array($stream1, $stream2);
    }

    //function that returns the best students in specific subject
    public function getBestStudentInSubject($year, $term, $exam_type, $streams, $subject){

        $student_details = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->orwhere('class_name', $streams[1])
                             ->where($subject,  '!=', null)
                             ->orderBy($subject, 'DESC')
                             ->get();

        return $student_details;
    }


    //function that gets the class performances and the overall performance
    public function getAveragePerformances($year, $term, $exam_type, $streams){

        $stream1_average = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->avg('average_marks');

        //get stream 2 average
        $stream2_average = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[1])
                             ->avg('average_marks');

        //get the total averages
        $class_average = DB::table('student_marks_ranking')
                             ->where('year', $year)
                             ->where('term', $term)
                             ->where('exam_type', $exam_type)
                             ->where('class_name', $streams[0])
                             ->orwhere('class_name', $streams[1])
                             ->avg('average_marks');


        //return an array of the averages
        return array($stream1_average, $stream2_average, $class_average);
    }

    //function that gets the subject performance averages per class and overall
    public function getSubjectPerformance($year, $term, $exam_type, $streams, $subject){

        $performance_stream1 = DB::table('student_marks_ranking')
                                 ->where('year', $year)
                                 ->where('term', $term)
                                 ->where('exam_type', $exam_type)
                                 ->where($subject, '!=', null)
                                 ->where('class_name', $streams[0])
                                 ->avg($subject);

        $performance_stream2 = DB::table('student_marks_ranking')
                                 ->where('year', $year)
                                 ->where('term', $term)
                                 ->where('exam_type', $exam_type)
                                 ->where($subject, '!=', null)
                                 ->where('class_name', $streams[1])
                                 ->avg($subject);

        $class_subject_performance = ($performance_stream1 + $performance_stream2) / 2;

        //round off the averages to 2 decimal places
        $performance_stream1_rounded = round($performance_stream1, 2);
        $performance_stream2_rounded = round($performance_stream2, 2);
        $class_subject_performance_rounded = round($class_subject_performance, 2);

        return array($performance_stream1_rounded, $performance_stream2_rounded, $class_subject_performance_rounded);
    }

    



    //function for viewing merit list;

    public function view_merit_list(){

      include(app_path() . '/my_styles.php');
        include(app_path() . '/admin_styles.php');

        $output = '
        <!DOCTYPE html>
<html lang="en">
<head>
	<title>School management system</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

</head>
<body id="page-top">
<!-- Page Wrapper -->
<div id="wrapper">

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
    </div>
    <div class="sidebar-brand-text mx-3">Shiners high school</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">


  <!-- Divider -->
  <hr class="sidebar-divider">
  
   <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#trips" aria-expanded="true" aria-controls="collapseTwo">
      <span>Teachers</span>
    </a>
    <div id="trips" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
         <a class="collapse-item" href="/teachers_details">Teachers details</a>
        <a class="collapse-item" href="/addTeacher">Add new teacher</a>
        <a class="collapse-item" href="#">Assign roles</a>
      </div>
    </div>
  </li>
  
  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bookingRequests" aria-expanded="true" aria-controls="collapseTwo">
      <span>Students</span>
    </a>
    <div id="bookingRequests" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <a class="collapse-item" href="/students_details">Students details</a>
        <a class="collapse-item" href="/add_student">Add new student</a>
        <!--  <a class="collapse-item" href="ViewLocalBookings.jsp">Local use requests</a>-->
      </div>
    </div>
  </li>


  <!-- Nav Item - Pages Collapse Menu -->
  <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
      <span>Non teaching staff</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
      
        <a class="collapse-item" href="/nonTeachingStaffDetails">All staff</a>
        <a class="collapse-item" href="/addStaff">Add new</a>
        <a class="collapse-item" href="/alumniStaff">Alumni staff</a>
      </div>
    </div>
  </li>



  <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#form1_classes" aria-expanded="true" aria-controls="collapseUtilities">
        <span>Form 1</span>
      </a>
      <div id="form1_classes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/marks_entry/1E">Form 1E</a>
          <a class="collapse-item" href="/marks_entry/1W">Form 1W</a>
          
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#form2_classes" aria-expanded="true" aria-controls="collapseUtilities">
        <span>Form 2</span>
      </a>
      <div id="form2_classes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/marks_entry/2E">Form 2E</a>
          <a class="collapse-item" href="/marks_entry/2W">Form 2W</a>
          
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#form3_classes" aria-expanded="true" aria-controls="collapseUtilities">
        <span>Form 3</span>
      </a>
      <div id="form3_classes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/marks_entry/3E">Form 3E</a>
          <a class="collapse-item" href="/marks_entry/3W">Form 3W</a>
          
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#form4_classes" aria-expanded="true" aria-controls="collapseUtilities">
        <span>Form 4</span>
      </a>
      <div id="form4_classes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="/marks_entry/4E">Form 4E</a>
          <a class="collapse-item" href="/marks_entry/4W">Form 4W</a>
          
        </div>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#merit_lists" aria-expanded="true" aria-controls="collapseUtilities">
        <span>Merit lists</span>
      </a>
      <div id="merit_lists" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <hr>
            <a class="collapse-item" href="/viewMeritList/form1">Form 1</a>        
          <hr>
          <a class="collapse-item" href="/merit_list/form2">Form 2</a>
          <hr>
          <a class="collapse-item" href="/merit_list/form3">Form 3</a>
          <hr>
            <a class="collapse-item" href="/merit_list/form4">Form 4</a>
          <hr>
        </div>
      </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#report_forms" aria-expanded="true" aria-controls="collapseUtilities">
          <span>Result Slips</span>
        </a>
        <div id="report_forms" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <hr>
              <a class="collapse-item" href="/report_forms/1E">Form 1E</a>
              <a class="collapse-item" href="/report_forms/1W">Form 1W</a>            
            <hr>
            <a class="collapse-item" href="/report_forms/2E">Form 2E</a>
            <a class="collapse-item" href="/report_forms/2W">Form 2W</a>
            <hr>
            <a class="collapse-item" href="/report_forms/3E">Form 3E</a>
            <a class="collapse-item" href="/report_forms/3W">Form 3W</a>
            <hr>
              <a class="collapse-item" href="/report_forms/4E">Form 4E</a>
            <a class="collapse-item" href="/report_forms/4W">Form 4W</a>
            <hr>
          </div>
        </div>
      </li>

  <!-- Divider -->
  <hr class="sidebar-divider">

   
  
  

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

  <!-- Main Content -->
  <div id="content">

    <!-- Topbar -->
    <nav style="height: 40px;" class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

      <!-- Sidebar Toggle (Topbar) -->
      <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
      </button>

      <!-- Topbar Search -->
      
      <!-- Topbar Navbar -->
      <ul class="navbar-nav ml-auto">
      <li class="nav-l"></li>

        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
        <li class="nav-item dropdown no-arrow d-sm-none">
          <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-search fa-fw"></i>
          </a>
          <!-- Dropdown - Messages -->
          <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
              <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        

        <!-- Nav Item - Messages -->
        <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <!-- <i class="fas fa-envelope fa-fw"></i> --> 
            <!-- Counter - Messages -->
            <!-- <span class="badge badge-danger badge-counter">7</span> -->
          </a>
          <!-- Dropdown - Messages -->
        
        </li>

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            


            <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
            <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
          </a>
          <!-- Dropdown - User Information -->
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
             <!--<a class="dropdown-item" href="#">
               <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
              Profile
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
              Settings
            </a>
            <a class="dropdown-item" href="#">
              <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
              Activity Log
            </a> -->
             <div class="dropdown-divider"></div>
          
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="">
            <span class="focus-input100" data-placeholder="&#xf191;"></span>
              Change password
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="">
              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
              Logout
            </a>
            <div class="dropdown-divider"></div>
            
          </div>
        </li>

      </ul>

    </nav>
    <!-- End of Topbar -->

    <!-- Begin Page Content -->
    <div class="container-fluid">
            ';

        $output .= '

            <p class="hello">Hello there</>

        ';


        $output .='
        

        </div>
        <!-- End of Main Content -->
  
        <!-- Footer -->
        <footer style="align: bottom; margin-top: 30%;" class="sticky-footer bg-white static-bottom">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span><!-- Copyright &copy; --> Shiners high school management system</span>
            </div>
          </div>
        </footer>
        <!-- End of Footer -->
  
      </div>
      <!-- End of Content Wrapper -->
  
    </div>
    <!-- End of Page Wrapper -->
  
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>
  
  </body>
  </html>
        

        ';

        return $output;


    }


  }