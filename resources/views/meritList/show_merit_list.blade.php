@extends('layouts.dashboard')

@section('content')
    

<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">{{$class_name}} merit list</h4>

    </div>
</div>


<div class="panel panel-primary w-auto">
    <div class="panel-heading">
       
    </div>
      @csrf
       <div class="panel-body">
            <?php

use Illuminate\Support\Facades\DB;
use App\StudentMarksRanking;
    //get the specific streams in classes
    $streams;
    $real_class_name;

    //get the class streams
    if($class_name == 'Form1' ){
        $streams = ['1E', '1W'];
        $real_class_name = 'FORM 1';
    } else if($class_name == 'Form2'){
        $streams = ['2E', '2W'];
        $real_class_name = 'FORM 2';
    } else if($class_name == 'Form3'){
        $streams = ['3E', '3W'];
        $real_class_name = 'FORM 3';
    } elseif($class_name == 'Form4'){
        $streams = ['4E', '4W'];
        $real_class_name = 'FORM 4';
    } else{
        echo 'The class does not exist';
        exit();
    }

        $stream1 =$streams[0];
        $stream2 = $streams[1];

    //get the term session and exams sessions periods
        $term_exam = DB::table('term_sessions')
                        ->join('exam_sessions', 'term_sessions.term_id', 'exam_sessions.term_id')
                        ->where('term_sessions.status', 'active')
                        ->where('exam_sessions.exam_status', 'active')
                        ->get();

        
        if(!$term_exam->isEmpty()){
            //get the exam session period
            foreach($term_exam as $exam_period){
                $year = $exam_period->year;
                $term = $exam_period->term;
                $exam_type = $exam_period->exam_type;
            }

        } else{
            $request->session()->flash('no_exam_sessions', 'Merit lists are not ready because no exam session is active. Click the link below to show other merit lists!');
            return redirect('/viewMeritList/'.$class_name);
        }

    //rankign position;
    $position = 1;
    
    $students_performance = StudentMarksRanking::where(function ($query) use($year, $term, $exam_type, $stream1){
                                                            $query->where('class_name',  $stream1)
                                                                  ->where('year', $year)
                                                                  ->where('term', $term)
                                                                  ->where('exam_type', $exam_type);
                                                        })->orWhere(function($query) use($year, $term, $exam_type, $stream2){
                                                            $query->where('class_name', $stream2)
                                                                  ->where('year', $year)
                                                                  ->where('term', $term)
                                                                  ->where('exam_type', $exam_type);
                                                        })->orderBy('average_marks', 'DESC')->get();



    echo '
    <h2 style="text-align:center; text-decoration: underline;">MERIT LIST      for  '.  $real_class_name.'       Term '.$term.' '.$exam_type.', '.$year.'</h2>
    
    <a href="/merit_list/'.$class_name.'"   class="btn btn-outline-primary" style="float: right; margin-bottom: 10px;" target="_blank" ><i class="fa fa-download"></i>Download</a>

    ';
   
    
    echo '
    
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

        echo '
            <tr>
            <td  style="border: 1px solid; padding: 5px;"> '.$position++.'</td>
            ';

            //select the student name
            $student_details = DB::table('students')
                                 ->where('id', $performance->student_id)
                                 ->get();
            foreach($student_details as $personal_details){
                echo'
                <td  style="border: 1px solid; padding: 5px;"> '.$personal_details->first_name. ' ' .$personal_details->middle_name. ' ' .$personal_details->last_name.'</td> 
                ';
            }

            echo '
            <td  style="border: 1px solid; padding: 5px;"> '.$performance->class_name.'</td> 

            ';


            if($performance->english != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->english.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }

            if($performance->kiswahili != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->kiswahili.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }

            if($performance->mathematics != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->mathematics.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }

            if($performance->chemistry != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->chemistry.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }

            if($performance->physics != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->physics.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }

            if($performance->biology != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->biology.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }

            if($performance->business_studies != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->business_studies.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }

            if($performance->geography != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->geography.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }

            if($performance->cre != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->cre.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }

            if($performance->agriculture != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->agriculture.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }

            if($performance->history != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->history.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }

            if($performance->total != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->total.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }

            if($performance->average_marks != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->average_marks.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }

            if($performance->average_grade != null){
                echo '
                <td  style="border: 1px solid; padding: 5px;"> '.$performance->average_grade.'</td>
                ';
            } else{
                echo '
                <td  style="border: 1px solid; padding: 5px;"> - </td>
                ';
            }


           echo'
           

           
           </tr>

        ';

}



$overallPerformance = getOverallPerformance($year, $term, $exam_type, $streams);



echo ' </table>';


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
 
echo'

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
$english_performance = getSubjectPerformance($year, $term, $exam_type, $streams, 'english');
$kiswahili_performance = getSubjectPerformance($year, $term, $exam_type, $streams, 'kiswahili');
$mathematics_performance = getSubjectPerformance($year, $term, $exam_type, $streams, 'mathematics');
$chemistry_performance = getSubjectPerformance($year, $term, $exam_type, $streams, 'chemistry');
$physics_performance = getSubjectPerformance($year, $term, $exam_type, $streams, 'physics');
$biology_performance = getSubjectPerformance($year, $term, $exam_type, $streams, 'biology');
$business_studies_performance = getSubjectPerformance($year, $term, $exam_type, $streams, 'business_studies');
$geography_performance = getSubjectPerformance($year, $term, $exam_type, $streams, 'geography');
$cre_performance = getSubjectPerformance($year, $term, $exam_type, $streams, 'cre');
$agriculture_performance = getSubjectPerformance($year, $term, $exam_type, $streams, 'agriculture');
$history_performance = getSubjectPerformance($year, $term, $exam_type, $streams, 'history');

echo'

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
            <td style="border: 1px solid; padding: 5px;">Form '.$stream1.'</td>
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
            <td style="border: 1px solid; padding: 5px;">Form '.$stream2.'</td>
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
$averages = getAveragePerformances($year, $term, $exam_type, $streams);
$round_stream1_average = round($averages[0], 2);
$round_stream2_average = round($averages[1], 2);
$round_class_average = round($averages[2], 2);

// table for the class performances
echo '
<br><br>
<p style="text-decoration: underline; font-size: 20px;">Class performance as per stream and overall</p>
<table width="40%" style="border-collapse: collapse; border:0px;">
<tr>
    <th style="border: 1px solid; padding: 5px;" align="left" width="20%" >Class</th>
    <th style="border: 1px solid; padding: 5px;"  align="left" width="20%" >Average</th>
    
</tr>

<tr>
    <td style="border: 1px solid; padding: 5px;">Form '.$stream1.'</td>
    <td style="border: 1px solid; padding: 5px;">'.$round_stream1_average.'</td>

</tr>

<tr>
<td style="border: 1px solid; padding: 5px;">Form '.$stream2.'</td>
<td style="border: 1px solid; padding: 5px;">'.$round_stream2_average.'</td>
</tr>

<tr>
<td style="border: 1px solid; padding: 5px;">Total average</td>
<td style="border: 1px solid; padding: 5px;">'.$round_class_average.'</td>
</tr>

</table>
';

echo '
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

    $best_in_english = getBestStudentInSubject($year, $term, $exam_type, $streams, 'english');

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
        if($best_english->english != null){ 
        echo '
        <tr>
        <td  style="border: 1px solid; padding: 5px;">English</td>
        ';

        //get the student name
        $student_name = DB::table('students')
                          ->where('id', $best_english->student_id)
                          ->get();
        
        foreach($student_name as $student){
            echo '
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

        echo ' 
        <td  style="border: 1px solid; padding: 5px;">'.$best_english->class_name.'</td>
        <td  style="border: 1px solid; padding: 5px;">'.$best_english->english.'</td>
    </tr>

    
        ';
}
    }
    


    //best student in kiswahili

    $best_in_kiswahili = getBestStudentInSubject($year, $term, $exam_type, $streams, 'kiswahili');

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

        if($best_kiswahili->kiswahili != null){ 
        echo '
        <tr>
        <td  style="border: 1px solid; padding: 5px;">Kiswahili</td>
        ';

        //get the student name
        $student_name = DB::table('students')
                          ->where('id', $best_kiswahili->student_id)
                          ->get();
        
        foreach($student_name as $student){
            echo '
            <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

            ';
        }

        if($i == 1){
            $first_student_kiswahili_marks = $best_kiswahili->kiswahili;
            $i++;
        } else if($i == 2){
            $second_student_kiswahili_marks = $best_kiswahili->kiswahili;
            $i++;
        } else{
            $other_student_kiswahili_marks = $best_kiswahili->kiswahili;
        }

        echo ' 
        <td  style="border: 1px solid; padding: 5px;">'.$best_kiswahili->class_name.'</td>
        <td  style="border: 1px solid; padding: 5px;">'.$best_kiswahili->kiswahili.'</td>
    </tr>

    
        ';
}
    }

    // //get the best in mathematics

    //get the best in mathematics
    $best_in_mathematics = getBestStudentInSubject($year, $term, $exam_type, $streams, 'mathematics');

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
        if($best_mathematics->mathematics != null){  
        echo '
        <tr>
        <td  style="border: 1px solid; padding: 5px;">Mathematics</td>
        ';

        //get the student name
        $student_name = DB::table('students')
                          ->where('id', $best_mathematics->student_id)
                          ->get();
        
        foreach($student_name as $student){
            echo '
            <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

            ';
        }

        if($i == 1){
            $first_student_mathematics_marks = $best_mathematics->mathematics;
            $i++;
        } else if($i == 2){
            $second_student_mathematics_marks = $best_mathematics->mathematics;
            $i++;
        } else{
            $other_student_mathematics_marks = $best_mathematics->mathematics;
        }

        echo ' 
        <td  style="border: 1px solid; padding: 5px;">'.$best_mathematics->class_name.'</td>
        <td  style="border: 1px solid; padding: 5px;">'.$best_mathematics->mathematics.'</td>mathematics
    
        ';
    }
    }


  

    //get the best in chemistry


    $best_in_chemistry = getBestStudentInSubject($year, $term, $exam_type, $streams, 'chemistry');

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
        if($best_chemistry->chemistry != null){ 
        echo '
        <tr>
        <td  style="border: 1px solid; padding: 5px;">Chemistry</td>
        ';

        //get the student name
        $student_name = DB::table('students')
                          ->where('id', $best_chemistry->student_id)
                          ->get();
        
        foreach($student_name as $student){
            echo '
            <td  style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

            ';
        }

        if($i == 1){
            $first_student_chemistry_marks = $best_chemistry->chemistry;
            $i++;
        } else if($i == 2){
            $second_student_chemistry_marks = $best_chemistry->chemistry;
            $i++;
        } else{
            $other_student_chemistry_marks = $best_chemistry->chemistry;
        }

        echo ' 
        <td  style="border: 1px solid; padding: 5px;">'.$best_chemistry->class_name.'</td>
        <td  style="border: 1px solid; padding: 5px;">'.$best_chemistry->chemistry.'</td>
    </tr>

    
        ';
    }
}

    //get the best in physics


    $best_in_physics = getBestStudentInSubject($year, $term, $exam_type, $streams, 'physics');

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
        if($best_physics->physics != null){ 
        echo '
        <tr>
        <td  style="border: 1px solid; padding: 5px;">Physics</td>
        ';

        //get the student name
        $student_name = DB::table('students')
                          ->where('id', $best_physics->student_id)
                          ->get();
        
        foreach($student_name as $student){
            echo '
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

        echo ' 
        <td  style="border: 1px solid; padding: 5px;">'.$best_physics->class_name.'</td>
        <td  style="border: 1px solid; padding: 5px;">'.$best_physics->physics.'</td>
    </tr>

    
        ';
    }
}

    //get the best student in biology
    $best_in_biology = getBestStudentInSubject($year, $term, $exam_type, $streams, 'biology');

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
        if($best_biology->biology != null){ 
        echo '
        <tr>
        <td  style="border: 1px solid; padding: 5px;">Biology</td>
        ';

        //get the student name
        $student_name = DB::table('students')
                          ->where('id', $best_biology->student_id)
                          ->get();
        
        foreach($student_name as $student){
            echo '
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

        echo ' 
        <td  style="border: 1px solid; padding: 5px;">'.$best_biology->class_name.'</td>
        <td  style="border: 1px solid; padding: 5px;">'.$best_biology->biology.'</td>
    </tr>

    
        ';
    }
    }
    //get the best student in business studies
    $best_in_business_studies = getBestStudentInSubject($year, $term, $exam_type, $streams, 'business_studies');

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

        if($best_business_studies->business_studies != null){ 
        echo '
        <tr>
        <td  style="border: 1px solid; padding: 5px;">Business studies</td>
        ';

        //get the student name
        $student_name = DB::table('students')
                          ->where('id', $best_business_studies->student_id)
                          ->get();
        
        foreach($student_name as $student){
            echo '
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

        echo ' 
        <td  style="border: 1px solid; padding: 5px;">'.$best_business_studies->class_name.'</td>
        <td  style="border: 1px solid; padding: 5px;">'.$best_business_studies->business_studies.'</td>
    </tr>

    
        ';
    }
}

    //get the best in geography
    $best_in_geography = getBestStudentInSubject($year, $term, $exam_type, $streams, 'geography');

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

        if($best_geography->geography != null){ 
        echo '
        <tr>
        <td  style="border: 1px solid; padding: 5px;">Geography</td>
        ';

        //get the student name
        $student_name = DB::table('students')
                          ->where('id', $best_geography->student_id)
                          ->get();
        
        foreach($student_name as $student){
            echo '
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

        echo ' 
        <td  style="border: 1px solid; padding: 5px;">'.$best_geography->class_name.'</td>
        <td  style="border: 1px solid; padding: 5px;">'.$best_geography->geography.'</td>
    </tr>

    
        ';
    }
}

    //get the best in cre
    $best_in_cre = getBestStudentInSubject($year, $term, $exam_type, $streams, 'cre');

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

        if($best_cre->cre != null){ 
        echo '
        <tr>
        <td  style="border: 1px solid; padding: 5px;">CRE</td>
        ';

        //get the student name
        $student_name = DB::table('students')
                          ->where('id', $best_cre->student_id)
                          ->get();
        
        foreach($student_name as $student){
            echo '
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

        echo ' 
        <td  style="border: 1px solid; padding: 5px;">'.$best_cre->class_name.'</td>
        <td  style="border: 1px solid; padding: 5px;">'.$best_cre->cre.'</td>
    </tr>

    
        ';
    }
}

    //get the best student in agriculture
    $best_in_agriculture = getBestStudentInSubject($year, $term, $exam_type, $streams, 'agriculture');

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

        if($best_agriculture->agriculture != null){
        

        echo '
        <tr>
        <td  style="border: 1px solid; padding: 5px;">Agriculture</td>
        ';

        //get the student name
        $student_name = DB::table('students')
                          ->where('id', $best_agriculture->student_id)
                          ->get();
        
        foreach($student_name as $student){
            echo '
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

        echo ' 
        <td  style="border: 1px solid; padding: 5px;">'.$best_agriculture->class_name.'</td>
        <td  style="border: 1px solid; padding: 5px;">'.$best_agriculture->agriculture.'</td>
    </tr>

    
        ';
}
    }

    //get the best student in history
    $best_in_history = getBestStudentInSubject($year, $term, $exam_type, $streams, 'history');

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

        if($best_history->history != null){ 
        echo '
        <tr>
        <td  style="border: 1px solid; padding: 5px;">History</td>
        ';

        //get the student name
        $student_name = DB::table('students')
                          ->where('id', $best_history->student_id)
                          ->get();
        
        foreach($student_name as $student){
            echo '
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

        echo ' 
        <td  style="border: 1px solid; padding: 5px;">'.$best_history->class_name.'</td>
        <td  style="border: 1px solid; padding: 5px;">'.$best_history->history.'</td>
    </tr>

    
        ';
    }
}

 echo '  
   
    </table>

';
//abbreviations meaning
echo '
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




//function that gets the overall performance
function getOverallPerformance($year, $term, $exam_type, $streams){

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
function getBestStudentInSubject($year, $term, $exam_type, $streams, $subject){
$stream1 = $streams[0];
$stream2 = $streams[1];

$student_details = StudentMarksRanking::where(function ($query) use($year, $term, $exam_type, $stream1){
                                                        $query->where('class_name',  $stream1)
                                                              ->where('year', $year)
                                                              ->where('term', $term)
                                                              ->where('exam_type', $exam_type);
                                                    })->orWhere(function($query) use($year, $term, $exam_type, $stream2){
                                                        $query->where('class_name', $stream2)
                                                              ->where('year', $year)
                                                              ->where('term', $term)
                                                              ->where('exam_type', $exam_type);
                                                    })->whereNotNull($subject)
                                                    ->orderBy($subject, 'DESC')
                                                    ->get();


return $student_details;
}


//function that gets the class performances and the overall performance
function getAveragePerformances($year, $term, $exam_type, $streams){

$stream1 = $streams[0];
$stream2 = $streams[1];

$stream1_average = DB::table('student_marks_ranking')
                     ->where('year', $year)
                     ->where('term', $term)
                     ->where('exam_type', $exam_type)
                     ->where('class_name', $stream1)
                     ->avg('average_marks');

//get stream 2 average
$stream2_average = DB::table('student_marks_ranking')
                     ->where('year', $year)
                     ->where('term', $term)
                     ->where('exam_type', $exam_type)
                     ->where('class_name', $stream2)
                     ->avg('average_marks');



$class_average = StudentMarksRanking::where(function ($query) use($year, $term, $exam_type, $stream1){
                                                        $query->where('class_name',  $stream1)
                                                              ->where('year', $year)
                                                              ->where('term', $term)
                                                              ->where('exam_type', $exam_type);
                                                    })->orWhere(function($query) use($year, $term, $exam_type, $stream2){
                                                        $query->where('class_name', $stream2)
                                                              ->where('year', $year)
                                                              ->where('term', $term)
                                                              ->where('exam_type', $exam_type);
                                                    })->avg('average_marks');

//return an array of the averages
return array($stream1_average, $stream2_average, $class_average);
}

//function that gets the subject performance averages per class and overall
function getSubjectPerformance($year, $term, $exam_type, $streams, $subject){

$performance_stream1 = DB::table('student_marks_ranking')
                         ->where('year', $year)
                         ->where('term', $term)
                         ->where('exam_type', $exam_type)
                         ->whereNotNull($subject)
                         ->where('class_name', $streams[0])
                         ->avg($subject);

$performance_stream2 = DB::table('student_marks_ranking')
                         ->where('year', $year)
                         ->where('term', $term)
                         ->where('exam_type', $exam_type)
                         ->whereNotNull($subject)
                         ->where('class_name', $streams[1])
                         ->avg($subject);

if($subject == "kiswahili" || $subject == "english" || $subject == "mathematics" || $subject == "chemistry"){
    $class_subject_performance = ($performance_stream1 + $performance_stream2) / 2;
} else{
    if($performance_stream1 == 0 || $performance_stream2 == 0){
        $class_subject_performance = ($performance_stream1 + $performance_stream2) / 1;
    } else{
        $class_subject_performance = ($performance_stream1 + $performance_stream2) / 2;
    }
}


//round off the averages to 2 decimal places
$performance_stream1_rounded = round($performance_stream1, 2);
$performance_stream2_rounded = round($performance_stream2, 2);
$class_subject_performance_rounded = round($class_subject_performance, 2);

return array($performance_stream1_rounded, $performance_stream2_rounded, $class_subject_performance_rounded);
}



?>


       </div>
</div>

@endsection