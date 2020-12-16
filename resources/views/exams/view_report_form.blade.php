@extends('layouts.dashboard')

@section('content')
    

<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Report form</h4>

    </div>
</div>


<div class="panel panel-primary w-auto">
    <div class="panel-heading">
       
    </div>
      @csrf
       <div class="panel-body">
            <?php

use Illuminate\Http\Request;
use App\StudentMarksRanking;
use Illuminate\Support\Facades\DB;


$all_streams;

if($specific_class_name == '1E' || $specific_class_name == '1W'){
    $all_streams = ['1E', '1W'];
} else if($specific_class_name == '2E' || $specific_class_name == '2W'){
    $all_streams = ['2E', '2W'];
}
else if($specific_class_name == '3E' || $specific_class_name == '3W'){
    $all_streams = ['3E', '3W'];
}
else if($specific_class_name == '4E' || $specific_class_name == '4W'){
    $all_streams = ['4E', '4W'];
} else{

}

$stream1 =$all_streams[0];
$stream2 = $all_streams[1];

//get the student id and class name
$student_id = $specific_student_id;
$class_name = $specific_class_name;

$total_marks = 0;
$average = 0;


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
      $request->session()->flash('no_exam_sessions', 'Report forms are not ready because no exam session is active. However, you can find individual student report forms under specific student details!');
      return redirect('/report_forms/'.$class_name);
  }

//get the student personal details
$student_details = DB::table('students')
                     ->where('id', $student_id)
                     ->get();


$report_form = DB::table('student_marks')
                 ->where('year',$year)
                 ->where('term', $term)
                 ->where('exam_type', $exam_type)
                 ->where('student_id', $student_id)
                 ->where('class_name', $class_name)
                 ->get();

echo '
<a href="/report_forms/'.$class_name.'"> <i class="fa fa-arrow-left"></i>Back</a>
<a href="/report_form/'.$student_id.','.$class_name.'" target="_blank" class="btn btn-outline-primary" style="float: right;">Download</a>
<h2 style="text-align:center;">REPORT FORM             Term '.$term.' '.$exam_type.' exam  '.$year.'</h2>
';

foreach($student_details as $student){

     echo' 
    <table width="100%" style="border-collapse: collapse; border:0px;">
    <tr>
        <th style="border: 1px solid; padding: 5px;" align="left" width="20%" >ADM NO: '.$student->admission_number.'</th>
        <th style="border: 1px solid; padding: 5px;"  align="left" width="60%" >Name: '.$student->first_name.' '.$student->middle_name.' '.$student->last_name.'</th>
        <th style="border: 1px solid; padding: 5px;"  align="left" width="20%" >Class: '.$class_name.'</th>

    </tr>';
}

    
 echo '</table><br>

<table width="100%" style="border-collapse: collapse; border:0px;">
    <tr>
        <th style="border: 1px solid; padding: 5px;" align="left" >Subject</th>
        <th style="border: 1px solid; padding: 5px;"  align="left" width="10%" >Marks 100%</th>
        <th style="border: 1px solid; padding: 5px;"  align="left"width="7%">Grade</th>
        <th style="border: 1px solid; padding: 5px;" align="left" width="10%" >Subject Position</th>
        <th style="border: 1px solid; padding: 5px;" align="left" >Remarks</th>
        <th style="border: 1px solid; padding: 5px;" align="left"  >Subject teacher</th>
        

    </tr>


';

foreach($report_form as $report){

 echo '
<tr>
    <td style="border: 1px solid; padding: 5px;"> '.$report->subject.'</td>
    <td style="border: 1px solid; padding: 5px;"> '.$report->marks_obtained.'</td>
    <td style="border: 1px solid; padding: 5px;"> '.$report->grade.'</td>';

    if($report->subject != null){
            $subject_standing = getSubjectPosition($year, $term, $exam_type, $all_streams[0], $all_streams[1], $report->subject, $student_id);
            
             echo '
            <td  style="border: 1px solid; padding: 5px;">'.$subject_standing.'</td>
            ';
    }else{

         echo '
        <td  style="border: 1px solid; padding: 5px;">'.$subject_standing.'</td>
        ';
    }
    
     
    echo' <td  style="border: 1px solid; padding: 5px;"> '.$report->comments.'</td>
';

$teachers = DB::table('teachers')
             ->where('id', $report->teacher_id)
             ->get();
foreach($teachers as $teacher){

         echo '            
        <td  style="border: 1px solid; padding: 5px;"> '.$teacher->first_name.' '.$teacher->last_name.'</td>

    </tr>
    ';
}
}

$overall_total_marks = DB::table('student_marks_ranking')
                ->where('year',$year)
                ->where('term', $term)
                ->where('exam_type', $exam_type)
                ->where('student_id', $student_id)
                ->where('class_name', $class_name)
                ->get();

 $total_marks_of_student = 0;
 $average_grade = '';
 $average_marks = 0;
 $stream_students = DB::table('student_marks_ranking')
                        ->where('year',$year)
                        ->where('term', $term)
                        ->where('exam_type', $exam_type)
                        ->where('class_name', $class_name)
                        ->count();


    foreach($overall_total_marks as $marks){
        $total_marks_of_student = $marks->total;
        $average_grade = $marks->average_grade;
        $average_marks = $marks->average_marks;
    }
              



$total_students = DB::table('student_marks_ranking')
                    ->where('year',$year)
                    ->where('term', $term)
                    ->where('exam_type', $exam_type)
                    ->where('student_id', $student_id)
                    ->where('class_name', $class_name)
                    ->get();  
            
$no_of_subjects = 0;

if($class_name == '1E' || $class_name == '1W' || $class_name == '2E' || $class_name == '2W'){
$no_of_subjects = 11;
} else{

//get the number of students  according to the subjects done by form 3 and form 4 students
//find the total marks for the student
$student_total_marks = DB::table('student_marks_ranking')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->where('class_name', $class_name)
                            ->where('student_id', $student_id)
                            ->get();


    foreach($student_total_marks as $student_marks){

        if($student_marks->english != null){
        $no_of_subjects++;
        }

        if($student_marks->kiswahili != null){
        $no_of_subjects++;
        }

        if($student_marks->mathematics != null){
        $no_of_subjects++;
        }

        if($student_marks->chemistry != null){
        $no_of_subjects++;
        }

        if($student_marks->physics != null){
        $no_of_subjects++;
        }

        if($student_marks->biology != null){
        $no_of_subjects++;
        }

        if($student_marks->business_studies != null){
        $no_of_subjects++;
        }

        if($student_marks->geography != null){
        $no_of_subjects++;
        }

        if($student_marks->cre != null){
        $no_of_subjects++;
        }

        if($student_marks->agriculture != null){
        $no_of_subjects++;
        }

        if($student_marks->history != null){
        $no_of_subjects++;
        }
    }

}

$student_position_in_stream = 0;
$student_position_in_class = 0;

$class_standing = DB::table('student_marks_ranking')
                ->where('year', $year)
                ->where('term', $term)
                ->where('exam_type', $exam_type)
                ->where('class_name', $class_name)
                ->orderby('average_marks', 'DESC')
                ->get();

foreach($class_standing as $position){
    if($position->student_id == $student_id){
        $student_position_in_stream++;
        break;
    } else{
        $student_position_in_stream++;
    }
}


$out_of_marks = $no_of_subjects * 100;

$principals_comments = getComments($average_marks);
$class_teachers_comments = getComments($average_marks);

$overall_position = 0;
$all_students_in_class = StudentMarksRanking::where(function ($query) use($year, $term, $exam_type, $stream1){
                                                      $query->where('class_name',  $stream1)
                                                            ->where('year', $year)
                                                            ->where('term', $term)
                                                            ->where('exam_type', $exam_type);
                                                  })->orWhere(function($query) use($year, $term, $exam_type, $stream2){
                                                      $query->where('class_name', $stream2)
                                                            ->where('year', $year)
                                                            ->where('term', $term)
                                                            ->where('exam_type', $exam_type);
                                                  })->count();

$overall_position_ranking = StudentMarksRanking::where(function ($query) use($year, $term, $exam_type, $stream1){
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

             
foreach($overall_position_ranking as $rank){
if($rank->student_id == $student_id){
    $overall_position++;
    break;
} else{
    $overall_position++;
}
}




 echo'
<tr>
<td  style="border: 1px solid; padding: 5px;"> TOTAL MARKS </td>
<td  style="border: 1px solid; padding: 5px;" colspan="5"> '.$total_marks_of_student.' /  '.$out_of_marks.' </td>
</tr>

<tr>
<td  style="border: 1px solid; padding: 5px;"> AVERAGE MARKS </td>
<td  style="border: 1px solid; padding: 5px;" colspan="5"> '.$average_marks.'     '.$average_grade.' </td>
</tr>

<tr>
<td  style="border: 1px solid; padding: 5px;" colspan="4"> OVERALL POSITION ON MARKS : '.$overall_position.'    OUT OF '.$all_students_in_class.'   </td>
<td  style="border: 1px solid; padding: 5px;" colspan="2"> CLASS POSITION :     '.$student_position_in_stream.' OUT OF '.$stream_students.' </td>
</tr>
';

 echo ' </table>';

 echo'
<br>

<ul style="list-style: none;">
<li>
    <div style=" float: left;">
    <p style="text-decoration: underline;">Class Teacher\'s comments:</p>
    '.$class_teachers_comments.'
    </div>
</li>
    <div style="float: right;">
    <p style="text-decoration: underline;">Principal\'s comments:</p>
    '.$principals_comments.'
    </div>
<li>
</li>

</ul>


<br>

<br>
</div>

';

function getComments($average_marks){

if($average_marks >= 80){
    return 'Excellent. Keep up.';
} else if($average_marks >= 70){
    return 'Very good work.';
}
else if($average_marks >= 60){
    return 'Good work. Next time aim higher.';
} else if($average_marks >= 50){
    return 'Can do better than that. work harder';
} else if($average_marks >= 40){
    return 'Poorly performed but can do better than that. Work harder next time';
} else{
    return 'Very poor. Work on improving your performance';
}
}

//function that gets the student subject position in class
function getSubjectPosition($year, $term, $exam_type, $stream1, $stream2, $subject, $student_id){
  //get kiswahili position
$subject_position = 0;

$all_positions = StudentMarksRanking::where(function ($query) use($year, $term, $exam_type, $stream1){
                                                      $query->where('class_name',  $stream1)
                                                            ->where('year', $year)
                                                            ->where('term', $term)
                                                            ->where('exam_type', $exam_type);
                                                  })->orWhere(function($query) use($year, $term, $exam_type, $stream2){
                                                      $query->where('class_name', $stream2)
                                                            ->where('year', $year)
                                                            ->where('term', $term)
                                                            ->where('exam_type', $exam_type);
                                                  })->whereNotNull($subject)->orderBy($subject, 'DESC')->get();

foreach($all_positions as $sub){
if($sub->student_id == $student_id){
    $subject_position++;
    break;
} else{
    $subject_position++;
}
}

return $subject_position;

}


?>


       

</div>

@endsection