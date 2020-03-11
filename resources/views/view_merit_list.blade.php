@extends('layouts.dashboard')

@section('content')




       
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg" alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>
        <h2 style="text-align:center;">MERIT LIST      for  {{ $real_class_name}}       Term  {{$term}} {{$exam_type}} EXAM,   {{$year}}</h2>
       
       
        
        
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
       
    

    @foreach($students_performance as $performance)

           <?php $position = 1; ?>
                <tr>
                <td  style="border: 1px solid; padding: 5px;"> {{$position++}}</td>
                

                

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

   @endforeach


 
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

    

    
@endsection