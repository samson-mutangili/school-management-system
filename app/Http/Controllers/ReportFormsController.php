<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
class ReportFormsController extends Controller
{
    


    //function for viewing report form
    public function viewReportForm(Request $request, $specific_class_name, $specific_student_id){

        //get the class name and student id
        $specific_class_name = $specific_class_name;
        $specific_student_id = $specific_student_id;


        $reference_link = $request->fullUrl();

        $output = $this->getPDF($specific_student_id, $specific_class_name, $reference_link);

        return response($output);

    
    }

    public function getReportForms($class_name){

        //get the academic year, term and exam type
        //get the year, term and exam type
        $period = $this->getPeriod();

        $year = $period[0];
        $month = $period[1];
        $term = $period[2];
        $exam_type = $period[3];

        //get the class name
        $specific_class_name = $class_name;

        $students = DB::table('students')
                      ->where('status', 'active')
                      ->where('class', $specific_class_name)
                      ->get();


        return view('class_report_forms', ['students'=>$students, 'year'=>$year, 'term'=>$term, 'exam_type'=>$exam_type, 'class_name'=>$specific_class_name]);



    }

    public function generateReportForm(Request $request, $student_id, $class_name){

        $specific_student_id = $student_id;
        $specific_class_name = $class_name;

        $reference_link = $request->fullUrl();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->getPDF($specific_student_id, $specific_class_name, $reference_link));
        return $pdf->stream();

    }

    public function getPDF($specific_student_id, $specific_class_name, $reference_link){

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



        //get the student id and class name
        $student_id = $specific_student_id;
        $class_name = $specific_class_name;

        $total_marks = 0;
        $average = 0;

        //get the academic year, term and exam type
        //get the year, term and exam type
        $period = $this->getPeriod();

        $year = $period[0];
        $month = $period[1];
        $term = $period[2];
        $exam_type = $period[3];

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

        $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg" alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>
        <h2 style="text-align:center;">REPORT FORM             Term '.$term.' '.$exam_type.' exam  '.$year.'</h2>
        ';

        foreach($student_details as $student){

            $output .=' 
            <table width="100%" style="border-collapse: collapse; border:0px;">
            <tr>
                <th style="border: 1px solid; padding: 5px;" align="left" width="20%" >ADM NO: '.$student->admission_number.'</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="60%" >Name: '.$student->first_name.' '.$student->middle_name.' '.$student->last_name.'</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="20%" >Class: '.$class_name.'</th>

            </tr>';
        }

            
        $output .= '</table><br>
        
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

        $output .= '
        <tr>
            <td style="border: 1px solid; padding: 5px;"> '.$report->subject.'</td>
            <td style="border: 1px solid; padding: 5px;"> '.$report->marks_obtained.'</td>
            <td style="border: 1px solid; padding: 5px;"> '.$report->grade.'</td>';

            if($report->subject != null){
                    $subject_standing = $this->getSubjectPosition($year, $term, $exam_type, $all_streams[0], $all_streams[1], $report->subject, $student_id);
                    
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;">'.$subject_standing.'</td>
                    ';
            }else{

                $output .= '
                <td  style="border: 1px solid; padding: 5px;">'.$subject_standing.'</td>
                ';
            }
            
             
           $output .=' <td  style="border: 1px solid; padding: 5px;"> '.$report->comments.'</td>
        ';

        $teachers = DB::table('teachers')
                     ->where('id', $report->teacher_id)
                     ->get();
        foreach($teachers as $teacher){

            $output .= '            
            <td  style="border: 1px solid; padding: 5px;"> '.$teacher->first_name.' '.$teacher->last_name.'</td>
        }        
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

    $principals_comments = $this->getComments($average_marks);
    $class_teachers_comments = $this->getComments($average_marks);

    $overall_position = 0;
    $all_students_in_class = DB::table('student_marks_ranking')
                                ->where('year', $year)
                                ->where('term', $term)
                                ->where('exam_type', $exam_type)
                                ->where('class_name', $all_streams[0])
                                ->orwhere('class_name', $all_streams[1])
                                ->count();

    $overall_position_ranking = DB::table('student_marks_ranking')
                                  ->where('year', $year)
                                  ->where('term', $term)
                                  ->where('exam_type', $exam_type)
                                  ->where('class_name', $all_streams[0])
                                  ->orwhere('class_name', $all_streams[1])
                                  ->orderBy('average_marks', 'DESC')
                                  ->get();
    
    foreach($overall_position_ranking as $rank){
        if($rank->student_id == $student_id){
            $overall_position++;
            break;
        } else{
            $overall_position++;
        }
    }
       
   
    

    $output .='
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

    $output .= ' </table>';

    $output .='
    <br>
    
    <ul style="list-style: none; margin: 0; padding: 0;">
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
    
    <br><br>
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


    public function getComments($average_marks){

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
     public function getSubjectPosition($year, $term, $exam_type, $stream1, $stream2, $subject, $student_id){
          //get kiswahili position
    $subject_position = 0;

    $all_positions = DB::table('student_marks_ranking')
                                ->where('year', $year)
                                ->where('term', $term)
                                ->where('exam_type', $exam_type)
                                ->where('class_name', $stream1)                                
                                ->orwhere('class_name', $stream2)
                                ->where($subject, '!=', null)
                                ->orderBy($subject, 'DESC')
                                ->get();
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
























     public function resultSlip(Request $request, $year, $term, $exam_type, $student_id, $class_name){


        $reference_link = $request->fullUrl();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->getReportFormPDF($reference_link, $year, $term, $exam_type, $student_id, $class_name));
        return $pdf->stream();
        

    }



     //this function converts report form data to pdf format
     public function getReportFormPDF($reference_link, $year, $term, $exam_type, $student_id, $class_name){
         //return 'Student details are, year: '.$year.'term is:  ' .$term.' exam type is: '.$exam_type. 'Student id is: '.$student_id.' class is: '.$class_name;  
        $specific_class_name = $class_name;
        
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



        $total_marks = 0;
        $average = 0;

        //get the academic year, term and exam type
        //get the year, term and exam type
        
        $year = $year;
        $term = $term;
        $exam_type = $exam_type;

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

        $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg" alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>
        <h2 style="text-align:center;">REPORT FORM             Term '.$term.' '.$exam_type.' exam  '.$year.'</h2>
        ';

        foreach($student_details as $student){

            $output .=' 
            <table width="100%" style="border-collapse: collapse; border:0px;">
            <tr>
                <th style="border: 1px solid; padding: 5px;" align="left" width="20%" >ADM NO: '.$student->admission_number.'</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="60%" >Name: '.$student->first_name.' '.$student->middle_name.' '.$student->last_name.'</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="20%" >Class: '.$class_name.'</th>

            </tr>';
        }

            
        $output .= '</table><br>
        
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

        $output .= '
        <tr>
            <td style="border: 1px solid; padding: 5px;"> '.$report->subject.'</td>
            <td style="border: 1px solid; padding: 5px;"> '.$report->marks_obtained.'</td>
            <td style="border: 1px solid; padding: 5px;"> '.$report->grade.'</td>';

            if($report->subject != null){
                    $subject_standing = $this->getSubjectPosition($year, $term, $exam_type, $all_streams[0], $all_streams[1], $report->subject, $student_id);
                    
                    $output .= '
                    <td  style="border: 1px solid; padding: 5px;">'.$subject_standing.'</td>
                    ';
            }else{

                $output .= '
                <td  style="border: 1px solid; padding: 5px;">'.$subject_standing.'</td>
                ';
            }
            
             
           $output .=' <td  style="border: 1px solid; padding: 5px;"> '.$report->comments.'</td>
        ';

        $teachers = DB::table('teachers')
                     ->where('id', $report->teacher_id)
                     ->get();
        foreach($teachers as $teacher){

            $output .= '            
            <td  style="border: 1px solid; padding: 5px;"> '.$teacher->first_name.' '.$teacher->last_name.'</td>
        }        
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

    $principals_comments = $this->getComments($average_marks);
    $class_teachers_comments = $this->getComments($average_marks);

    $overall_position = 0;
    $all_students_in_class = DB::table('student_marks_ranking')
                                ->where('year', $year)
                                ->where('term', $term)
                                ->where('exam_type', $exam_type)
                                ->where('class_name', $all_streams[0])
                                ->orwhere('class_name', $all_streams[1])
                                ->count();

    $overall_position_ranking = DB::table('student_marks_ranking')
                                  ->where('year', $year)
                                  ->where('term', $term)
                                  ->where('exam_type', $exam_type)
                                  ->where('class_name', $all_streams[0])
                                  ->orwhere('class_name', $all_streams[1])
                                  ->orderBy('average_marks', 'DESC')
                                  ->get();
    
    foreach($overall_position_ranking as $rank){
        if($rank->student_id == $student_id){
            $overall_position++;
            break;
        } else{
            $overall_position++;
        }
    }
       
   
    

    $output .='
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

    $output .= ' </table>';

    $output .='
    <br>
    
    <ul style="list-style: none; margin: 0; padding: 0;">
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
    
    <br><br>
    <br><br>

    <p style="text-decoration: italics;" >Reference link: <a  style="text-decoration: none;" href="'.$reference_link.'">'.$reference_link.'</a></p>
    ';
    return $output;
     }
}


