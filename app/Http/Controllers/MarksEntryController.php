<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Students;

use Illuminate\Support\Facades\DB;

class MarksEntryController extends Controller
{
    

    public function checkTeacher(Request $request, $class){

        //get the teacher's teaching classes from the session data
        $teaching_classes = $request->session()->get('teaching_classes');

        //get the specific class
        $class_name = $class;


        $allow_access = "false";

        if($teaching_classes != null){

        foreach($teaching_classes as $teacher_class){
            if($teacher_class->class_name == $class_name){
                $allow_access = "true";
            }
        }
        
        }
        if($allow_access == "true"){

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

        //get the existing marks

        $existing_marks = DB::table('student_marks')
                            ->where('year', $year)
                            ->where('term', $term)
                            ->where('exam_type', $exam_type)
                            ->get();
                            
        
            //select all the students in that class
            $students = DB::table('students')
                          ->join('student_classes', 'students.id', 'student_classes.student_id')
                          ->where('student_classes.stream', $class_name)
                          ->where('students.status', 'active')
                          ->where('student_classes.status', 'active')
                          ->get();
            
            //return to a view with the student class
            return view('marks_entry', ['no_exam_session'=>$no_exam_session, 'teaching_classes'=>$teaching_classes, 'students'=>$students, 'term'=>$term,'year'=>$year, 'exam_type'=>$exam_type, 'specific_class_name'=>$class_name, 'existing_marks'=>$existing_marks]);
        }

        if($allow_access == "false"){
            return view('access_forbidden');
        }



    }

    public function submitMarks(Request $request){

        //get the data from the form
        $class_name = $request->input('class_name');
        $student_id = $request->input('student_id');


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
            $request->session()->flash('marks_submission_failed', 'Failed to submit marks for student! No active exam session!');
            return redirect('/marks_entry/'.$class_name);
        }




        $teacher_id = null;
        $subject1 = null;
        $subject2 = null;

        //get the teacher's teaching classes from the session data
        $teaching_classes = $request->session()->get('teaching_classes');

        foreach($teaching_classes as $teacher_class){
            if($teacher_class->class_name == $class_name){
                $teacher_id = $teacher_class->teacher_id;

                if($teacher_class->subject1 != null){
                    $subject1 = $teacher_class->subject1;
                }

                if($teacher_class->subject2 != null){
                    $subject2 = $teacher_class->subject2;
                }
            }
        }


        $subject1_marks = null;
        $subject2_marks = null;
        $subject1_marks_comments = null;
        $subject2_marks_comments = null;

        if($subject1 != null){
            $subject1_marks = $request->input($subject1);
            $subject1_marks_comments = $request->input($subject1.'_comments');
        }
        if($subject2 != null){
            $subject2_marks = $request->input($subject2);
            $subject2_marks_comments = $request->input($subject2.'_comments');
        }


        if($subject1 != null && $subject2 != null){
            if($subject1_marks == null && $subject2_marks == null){
                //set message in a session
                $request->session()->flash('both_marks_empty', 'Marks not submitted because there are no input marks!!');

                return redirect('/marks_entry/'.$class_name);
            }

            if($subject1_marks != null &&  $subject1_marks_comments == null){
                //set message in a session
                $request->session()->flash('both_marks_empty', $subject1.' marks not submitted because no comments were chosen for the marks!!');

                return redirect('/marks_entry/'.$class_name);
            }

            if($subject2_marks != null &&  $subject2_marks_comments == null){
                //set message in a session
                $request->session()->flash('both_marks_empty', $subject2.' marks not submitted because no comments were chosen for the marks!!');

                return redirect('/marks_entry/'.$class_name);
            }
        }

        
        
        $subject1_grade;
        $subject2_grade;

        if($subject1_marks != null){
            $subject1_grade = $this->getGrade($subject1_marks);
        }

        if($subject2_marks != null){
            $subject2_grade = $this->getGrade($subject2_marks);
        }
        
        if(($subject1_marks < 0 || $subject1_marks > 100) && ($subject2_marks < 0 || $subject2_marks > 100)){
            //set error message           
                $request->session()->flash('invalid_marks', 'Invalid marks. The marks should be in a range between 0 and 100.');          
                
                //return redirect
                return redirect('/marks_entry/'.$class_name);
            }

        if(($subject1_marks < 0 || $subject1_marks > 100) && ($subject2_marks == null)){
            //set error message
            $request->session()->flash('invalid_marks', 'Invalid '.$subject1.' marks. The marks should be in a range between 0 and 100.');          

            //return redirect
            return redirect('/marks_entry/'.$class_name);
        }

        if(($subject2_marks < 0 || $subject2_marks > 100) && ($subject1_marks == null)){
              //set error message
              $request->session()->flash('invalid_marks', 'Invalid '.$subject2.' marks. The marks should be in a range between 0 and 100.');          

              //return redirect
              return redirect('/marks_entry/'.$class_name);
        }

        if($subject1 != null){
            if($subject1_marks == null){
                $request->session()->flash('subject1_empty', $subject1.' marks not submitted because the field is empty');

                //check if subject 2 marks is null
               
            } else{

                
                //check if marks already exists in the db
                $marks_exists = DB::table('student_marks')
                                  ->where('student_id', $student_id)
                                  ->where('year', $year)
                                  ->where('term', $term)
                                  ->where('exam_type', $exam_type)
                                  ->where('class_name', $class_name)
                                  ->where('subject', $subject1)
                                  ->get();

                if(!$marks_exists->isEmpty()){
                    //set message in flash session inorder to inform the teacher
                    $request->session()->flash('subject1_marks_exists', $subject1.' marks already exists. You can click on the edit button to edit marks you entered.');

                    //insert subject 2 marks
                    if($subject2_marks != null){
                        //check whether subject 2 marks exists
                        $subject2_marks_exists = DB::table('student_marks')
                                  ->where('student_id', $student_id)
                                  ->where('year', $year)
                                  ->where('term', $term)
                                  ->where('exam_type', $exam_type)
                                  ->where('class_name', $class_name)
                                  ->where('subject', $subject2)
                                  ->get();
                        
                        if(!$subject2_marks_exists->isEmpty()){
                            //set message in flash session inorder to inform the teacher
                           $request->session()->flash('subject2_marks_exists', $subject2.' marks already exists. You can click on the edit button to edit marks you entered.');

                           
                        }
                        else{
                            //insert student marks
                            $insert_marks = DB::table('student_marks')
                                              ->insert([
                                                    'year'=>$year,
                                                    'term'=>$term,
                                                    'exam_type'=>$exam_type,
                                                    'student_id'=>$student_id,
                                                    'class_name'=>$class_name,
                                                    'subject'=>$subject2,
                                                    'marks_obtained'=>$subject2_marks,
                                                    'grade'=>$subject2_grade,
                                                    'comments'=>$subject2_marks_comments,
                                                    'teacher_id'=>$teacher_id
                                              ]);
                            
                            //insert the marks to student_marks_ranking table
                                            
                            //first check if the student already exists in the student_marks_ranking table
                            $student_already_exists = DB::table('student_marks_ranking')
                                                        ->where('year', $year)
                                                        ->where('term', $term)
                                                        ->where('exam_type', $exam_type)
                                                        ->where('class_name', $class_name)
                                                        ->where('student_id', $student_id)
                                                        ->get();
                            if(!$student_already_exists->isEmpty()){
                                //update the student marks
                                $update_marks = DB::table('student_marks_ranking')
                                                  ->where('student_id', $student_id)
                                                  ->where('year', $year)
                                                  ->where('term', $term)
                                                  ->where('exam_type', $exam_type)
                                                  ->update([
                                                    $subject2 => $subject2_marks
                                                  ]);

                            } else{
                                //insert a new record
                                $insert_new = DB::table('student_marks_ranking')
                                                ->insert([
                                                    'year'=>$year,
                                                    'term'=>$term,
                                                    'exam_type'=>$exam_type,
                                                    'class_name'=>$class_name,
                                                    'student_id'=>$student_id,
                                                    $subject2 => $subject2_marks
                                                ]);
                               
                            }

                            $this->updateStudentMarksRankingTable($year, $term, $exam_type, $class_name, $student_id);

                            $request->session()->flash('subject2_marks_inserted', $subject2.' marks have been submitted successfully');
                        }

                        
                    } 

                    if($subject2_marks == null){
                        $request->session()->flash('subject2_empty', $subject2.' marks not submitted because the field is empty');
                    }

                    //return redirect
                    return redirect('/marks_entry/'.$class_name);
                } else{

                    //insert the student marks in to the database
                    $insert_subject1_marks = DB::table('student_marks')
                                               ->insert([
                                                'year'=>$year,
                                                'term'=>$term,
                                                'exam_type'=>$exam_type,
                                                'student_id'=>$student_id,
                                                'class_name'=>$class_name,
                                                'subject'=>$subject1,
                                                'marks_obtained'=>$subject1_marks,
                                                'grade'=>$subject1_grade,
                                                'comments'=>$subject1_marks_comments,
                                                'teacher_id'=>$teacher_id
                                               ]);
                    
                         //insert the marks to student_marks_ranking table
                                            
                            //first check if the student already exists in the student_marks_ranking table
                            $student_already_exists = DB::table('student_marks_ranking')
                                                        ->where('year', $year)
                                                        ->where('term', $term)
                                                        ->where('exam_type', $exam_type)
                                                        ->where('class_name', $class_name)
                                                        ->where('student_id', $student_id)
                                                        ->get();
                            if(!$student_already_exists->isEmpty()){
                                //update the student marks
                                $update_marks = DB::table('student_marks_ranking')
                                                  ->where('student_id', $student_id)
                                                  ->where('year', $year)
                                                  ->where('term', $term)
                                                  ->where('exam_type', $exam_type)
                                                  ->update([
                                                    $subject1 => $subject1_marks
                                                  ]);

                            } else{
                                //insert a new record
                                $insert_new = DB::table('student_marks_ranking')
                                                ->insert([
                                                    'year'=>$year,
                                                    'term'=>$term,
                                                    'exam_type'=>$exam_type,
                                                    'class_name'=>$class_name,
                                                    'student_id'=>$student_id,
                                                    $subject1 => $subject1_marks
                                                ]);
                               
                            }

                            //update student total marks
                           $this->updateStudentMarksRankingTable($year, $term, $exam_type, $class_name, $student_id);

                    //set message in flash session
                    $request->session()->flash('subject1_marks_submitted', $subject1.' marks have been submitted successfully');


                    //insert subject 2 marks
                    if($subject2_marks != null){
                        //check whether subject 2 marks exists
                        $subject2_marks_exists = DB::table('student_marks')
                                  ->where('student_id', $student_id)
                                  ->where('year', $year)
                                  ->where('term', $term)
                                  ->where('exam_type', $exam_type)
                                  ->where('class_name', $class_name)
                                  ->where('subject', $subject2)
                                  ->get();
                        
                        if(!$subject2_marks_exists->isEmpty()){
                            //set message in flash session inorder to inform the teacher
                           $request->session()->flash('subject2_marks_exists', $subject2.' marks already exists. You can click on the edit button to edit marks you entered.');

                           
                        }
                        else{
                            //insert student marks
                            $insert_marks = DB::table('student_marks')
                                              ->insert([
                                                    'year'=>$year,
                                                    'term'=>$term,
                                                    'exam_type'=>$exam_type,
                                                    'student_id'=>$student_id,
                                                    'class_name'=>$class_name,
                                                    'subject'=>$subject2,
                                                    'marks_obtained'=>$subject2_marks,
                                                    'grade'=>$subject2_grade,
                                                    'comments'=>$subject2_marks_comments,
                                                    'teacher_id'=>$teacher_id
                                              ]);
                            
                            //insert the marks to student_marks_ranking table
                                            
                            //first check if the student already exists in the student_marks_ranking table
                            $student_already_exists = DB::table('student_marks_ranking')
                                                        ->where('year', $year)
                                                        ->where('term', $term)
                                                        ->where('exam_type', $exam_type)
                                                        ->where('class_name', $class_name)
                                                        ->where('student_id', $student_id)
                                                        ->get();
                            if(!$student_already_exists->isEmpty()){
                                //update the student marks
                                $update_marks = DB::table('student_marks_ranking')
                                                  ->where('student_id', $student_id)
                                                  ->where('year', $year)
                                                  ->where('term', $term)
                                                  ->where('exam_type', $exam_type)
                                                  ->update([
                                                    $subject2 => $subject2_marks
                                                  ]);

                            } else{
                                //insert a new record
                                $insert_new = DB::table('student_marks_ranking')
                                                ->insert([
                                                    'year'=>$year,
                                                    'term'=>$term,
                                                    'exam_type'=>$exam_type,
                                                    'class_name'=>$class_name,
                                                    'student_id'=>$student_id,
                                                    $subject2 => $subject2_marks
                                                ]);
                               
                            }

                            $this->updateStudentMarksRankingTable($year, $term, $exam_type, $class_name, $student_id);

                            $request->session()->flash('subject2_marks_inserted', $subject2.' marks have been submitted successfully');
                        }

                        
                    } 

                    

                    //return redirect
                    return redirect('/marks_entry/'.$class_name);
                }

            }
        }



        if($subject2 != null){
            if($subject2_marks == null){
                $request->session()->flash('subject2_empty', $subject2.' marks not submitted because the field is empty');
            } else{

                
                //check if marks already exists in the db
                $marks_exists = DB::table('student_marks')
                                  ->where('student_id', $student_id)
                                  ->where('year', $year)
                                  ->where('term', $term)
                                  ->where('exam_type', $exam_type)
                                  ->where('class_name', $class_name)
                                  ->where('subject', $subject2)
                                  ->get();
                if(!$marks_exists->isEmpty()){
                    //set message in flash session inorder to inform the teacher
                    $request->session()->flash('subject2_marks_exists', $subject2.' marks already exists. You can click on the edit button to edit marks you entered.');

                    //insert subject 1 marks
                    if($subject1_marks != null){
                        //check whether subject 2 marks exists
                        $subject1_marks_exists = DB::table('student_marks')
                                  ->where('student_id', $student_id)
                                  ->where('year', $year)
                                  ->where('term', $term)
                                  ->where('exam_type', $exam_type)
                                  ->where('class_name', $class_name)
                                  ->where('subject', $subject1)
                                  ->get();
                        
                        if(!$subject1_marks_exists->isEmpty()){
                            //set message in flash session inorder to inform the teacher
                           $request->session()->flash('subject1_marks_exists', $subject1.' marks already exists. You can click on the edit button to edit marks you entered.');

                           
                        }
                        else{
                            //insert student marks
                            $insert_marks = DB::table('student_marks')
                                              ->insert([
                                                    'year'=>$year,
                                                    'term'=>$term,
                                                    'exam_type'=>$exam_type,
                                                    'student_id'=>$student_id,
                                                    'class_name'=>$class_name,
                                                    'subject'=>$subject1,
                                                    'marks_obtained'=>$subject1_marks,
                                                    'grade'=>$subject1_grade,
                                                    'comments'=>$subject1_marks_comments,
                                                    'teacher_id'=>$teacher_id
                                              ]);
                        
                            //insert the marks to student_marks_ranking table
                                            
                            //first check if the student already exists in the student_marks_ranking table
                            $student_already_exists = DB::table('student_marks_ranking')
                                                        ->where('year', $year)
                                                        ->where('term', $term)
                                                        ->where('exam_type', $exam_type)
                                                        ->where('class_name', $class_name)
                                                        ->where('student_id', $student_id)
                                                        ->get();
                            if(!$student_already_exists->isEmpty()){
                                //update the student marks
                                $update_marks = DB::table('student_marks_ranking')
                                                  ->where('student_id', $student_id)
                                                  ->where('year', $year)
                                                  ->where('term', $term)
                                                  ->where('exam_type', $exam_type)
                                                  ->update([
                                                    $subject1 => $subject1_marks
                                                  ]);

                            } else{
                                //insert a new record
                                $insert_new = DB::table('student_marks_ranking')
                                                ->insert([
                                                    'year'=>$year,
                                                    'term'=>$term,
                                                    'exam_type'=>$exam_type,
                                                    'class_name'=>$class_name,
                                                    'student_id'=>$student_id,
                                                    $subject1 => $subject1_marks
                                                ]);
                               
                            }

                            //update student total marks
                            $this->updateStudentMarksRankingTable($year, $term, $exam_type, $class_name, $student_id);

                            $request->session()->flash('subject1_marks_inserted', $subject1.' marks have been submitted successfully');
                        }

                        
                    } 

                    if($subject1_marks == null){
                        $request->session()->flash('subject1_empty', $subject1.' marks not submitted because the field is empty');
                    }

                    //return redirect
                    return redirect('/marks_entry/'.$class_name);

                } else{

                    //insert the student marks in to the database
                    $insert_subject2_marks = DB::table('student_marks')
                                               ->insert([
                                                'year'=>$year,
                                                'term'=>$term,
                                                'exam_type'=>$exam_type,
                                                'student_id'=>$student_id,
                                                'class_name'=>$class_name,
                                                'subject'=>$subject2,
                                                'marks_obtained'=>$subject2_marks,
                                                'grade'=>$subject2_grade,
                                                'comments'=>$subject2_marks_comments,
                                                'teacher_id'=>$teacher_id
                                               ]);
                    


                             //insert the marks to student_marks_ranking table
                                            
                            //first check if the student already exists in the student_marks_ranking table
                            $student_already_exists = DB::table('student_marks_ranking')
                                                        ->where('year', $year)
                                                        ->where('term', $term)
                                                        ->where('exam_type', $exam_type)
                                                        ->where('class_name', $class_name)
                                                        ->where('student_id', $student_id)
                                                        ->get();
                            if(!$student_already_exists->isEmpty()){
                                //update the student marks
                                $update_marks = DB::table('student_marks_ranking')
                                                  ->where('student_id', $student_id)
                                                  ->where('year', $year)
                                                  ->where('term', $term)
                                                  ->where('exam_type', $exam_type)
                                                  ->update([
                                                    $subject2 => $subject2_marks
                                                  ]);

                            } else{
                                //insert a new record
                                $insert_new = DB::table('student_marks_ranking')
                                                ->insert([
                                                    'year'=>$year,
                                                    'term'=>$term,
                                                    'exam_type'=>$exam_type,
                                                    'class_name'=>$class_name,
                                                    'student_id'=>$student_id,
                                                    $subject2 => $subject2_marks
                                                ]);
                               
                            }
                           
                            //update student total marks
                            $this->updateStudentMarksRankingTable($year, $term, $exam_type, $class_name, $student_id);
                    
                    //set message in flash session
                    $request->session()->flash('subject2_marks_submitted', $subject2.' marks have been submitted successfully');

                    //return redirect
                    return redirect('/marks_entry/'.$class_name);
                }

            }
        }


        

    }

    //function to update students marks

    public function updateMarks(Request $request){

        //get the details from the form
        $class_name = $request->input('class_name');
        $student_id = $request->input('student_id');

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
            $request->session()->flash('marks_update_failed', 'Failed to update marks for student! No active exam session!');
            return redirect('/marks_entry/'.$class_name);
        }

        $teacher_id = null;
        $subject1 = null;
        $subject2 = null;

        //get the teacher's teaching classes from the session data
        $teaching_classes = $request->session()->get('teaching_classes');

        foreach($teaching_classes as $teacher_class){
            if($teacher_class->class_name == $class_name){
                $teacher_id = $teacher_class->teacher_id;

                if($teacher_class->subject1 != null){
                    $subject1 = $teacher_class->subject1;
                }

                if($teacher_class->subject2 != null){
                    $subject2 = $teacher_class->subject2;
                }
            }
        }


        $subject1_marks = null;
        $subject2_marks = null;
        $subject1_marks_comments = null;
        $subject2_marks_comments = null;

        if($subject1 != null){
            $subject1_marks = $request->input($subject1);
            $subject1_marks_comments = $request->input($subject1.'_comments');
        }
        if($subject2 != null){
            $subject2_marks = $request->input($subject2);
            $subject2_marks_comments = $request->input($subject2.'_comments');
        }


        if($subject1 != null && $subject2 != null){
            if($subject1_marks == null && $subject2_marks == null){
                //set message in a session
                $request->session()->flash('both_marks_empty', 'Marks not submitted because there are no input marks!!');

                return redirect('/marks_entry/'.$class_name);
            }
        }

        
        
        $subject1_grade;
        $subject2_grade;

        if($subject1_marks != null){
            $subject1_grade = $this->getGrade($subject1_marks);
        }

        if($subject2_marks != null){
            $subject2_grade = $this->getGrade($subject2_marks);
        }
        
        if(($subject1_marks < 0 || $subject1_marks > 100) && ($subject2_marks < 0 || $subject2_marks > 100)){
            //set error message           
                $request->session()->flash('invalid_marks', 'You entered invalid marks. The marks should be in a range between 0 and 100.');          
                
                //return redirect
                return redirect('/marks_entry/'.$class_name);
            }

        if(($subject1_marks < 0 || $subject1_marks > 100)){
            //set error message
            $request->session()->flash('invalid_marks', 'Invalid '.$subject1.' marks. The marks should be in a range between 0 and 100, you entered '.$subject1_marks);          

            //return redirect
            return redirect('/marks_entry/'.$class_name);
        }

        if(($subject2_marks < 0 || $subject2_marks > 100)){
              //set error message
              $request->session()->flash('invalid_marks', 'Invalid '.$subject2.' marks. The marks should be in a range between 0 and 100, you entered '.$subject2_marks);          

              //return redirect
              return redirect('/marks_entry/'.$class_name);
        }


        //update subject 1 marks
        if($subject1 != null){
            if($subject1_marks == null){
                $request->session()->flash('subject1_empty', $subject1.' marks not updated because the field is empty');

            }
            else{
                //update the students marks
                $update_marks = DB::table('student_marks')
                                  ->where('student_id', $student_id)
                                  ->where('year', $year)
                                  ->where('term', $term)
                                  ->where('exam_type', $exam_type)
                                  ->where('class_name', $class_name)
                                  ->where('subject', $subject1)
                                  ->update([
                                        'marks_obtained'=>$subject1_marks,
                                        'grade'=>$subject1_grade,
                                        'comments'=>$subject1_marks_comments
                                  ]);
                //update the student marks ranking table
                $update_marks_ranking = DB::table('student_marks_ranking')
                                          ->where('student_id', $student_id)
                                          ->where('year', $year)
                                          ->where('term', $term)
                                          ->where('exam_type', $exam_type)
                                          ->update([
                                              $subject1=>$subject1_marks
                                          ]);
                    
                //update student total marks
                $this->updateStudentMarksRankingTable($year, $term, $exam_type, $class_name, $student_id);
                    
                //set message in a session  
                $request->session()->flash('subject1_updated', $subject1.' marks have been updated successfully');
                
            }
        }

        //update subject 2 marks
        if($subject2 != null){
            if($subject2_marks == null){
                $request->session()->flash('subject2_empty', $subject2.' marks not updated because the field is empty');

            }
            else{
                //update the students marks
                $update_marks2 = DB::table('student_marks')
                                  ->where('student_id', $student_id)
                                  ->where('year', $year)
                                  ->where('term', $term)
                                  ->where('exam_type', $exam_type)
                                  ->where('class_name', $class_name)
                                  ->where('subject', $subject2)
                                  ->update([
                                        'marks_obtained'=>$subject2_marks,
                                        'grade'=>$subject2_grade,
                                        'comments'=>$subject2_marks_comments
                                  ]);

                //update the student marks ranking table
                $update_marks_ranking = DB::table('student_marks_ranking')
                                          ->where('student_id', $student_id)
                                          ->where('year', $year)
                                          ->where('term', $term)
                                          ->where('exam_type', $exam_type)
                                          ->update([
                                              $subject2=>$subject2_marks
                                          ]);
                    
                
                //update student total marks
                $this->updateStudentMarksRankingTable($year, $term, $exam_type, $class_name, $student_id);
                                               
                //set message in a session  
                $request->session()->flash('subject2_updated', $subject2.' marks have been updated successfully');
                
            }
        }

        //return redirect
        return redirect('/marks_entry/'.$class_name);

    }

    //function to remove student marks from the database
   public function removeMarks(Request $request){

    //get the class name
    $class_name = $request->input('class_name');
    $student_id = $request->input('student_id');

    //get the subject names
    $subject1_name = $request->input('subject1_name');
    $subject2_name = $request->input('subject2_name');


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
            $request->session()->flash('remove_marks_failed', 'Failed to remove marks for student! No active exam session!');
            return redirect('/marks_entry/'.$class_name);
        }
    
    

    $subject1_checked = null;
    $subject2_checked = null;
    //get the value of the subjects
    $subject1_checked = $request->input('subject1_checked');
    $subject2_checked = $request->input('subject2_checked');

    if($subject1_checked == null && $subject2_checked == null){
        $request->session()->flash('remove_not_selected', 'No subject was selected!!');
     
        //return redirect
        return redirect('/marks_entry/'.$class_name);

    }

    if($subject1_checked != null){
        //get the id
        $subject1_id = $request->input('subject1_id');

        //query to remove students marks
        $delete_subject1 = DB::table('student_marks')
                             ->where('id', $subject1_id)
                             ->delete();

        
        //set the corresponding suject marks to null in student marks ranking  
        $update_marks_ranking = DB::table('student_marks_ranking')
                                    ->where('student_id', $student_id)
                                    ->where('year', $year)
                                    ->where('term', $term)
                                    ->where('exam_type', $exam_type)
                                    ->update([
                                        $subject1_name=>null
                                    ]);
        //update student total marks
        $this->updateStudentMarksRankingTable($year, $term, $exam_type, $class_name, $student_id);
                                       
        
        //set a message in a session
        $request->session()->flash('subject1_marks_removed', $subject1_checked.' marks have been removed successfully');                     
    }

    if($subject2_checked != null){
        //get the subject id
        $subject2_id = $request->input('subject2_id');

        //query to remove students marks
        $delete_subject2 = DB::table('student_marks')
                             ->where('id', $subject2_id)
                             ->delete();
        //set the corresponding suject marks to null in student marks ranking  
        $update_marks_ranking = DB::table('student_marks_ranking')
                                    ->where('student_id', $student_id)
                                    ->where('year', $year)
                                    ->where('term', $term)
                                    ->where('exam_type', $exam_type)
                                    ->update([
                                        $subject2_name=>null
                                    ]);

        //update student total marks
        $this->updateStudentMarksRankingTable($year, $term, $exam_type, $class_name, $student_id);
                        
         //set a message in a session
         $request->session()->flash('subject2_marks_removed', $subject2_checked.' marks have been removed successfully');                     
        
    }


   //return redirect
   return redirect('/marks_entry/'.$class_name);

    }

//function to get the student's grade according to the marks scored
    public function getGrade($marks){
        if($marks != null){
            if($marks >= 80 && $marks < 100){
                return 'A';
            } else if($marks >=75){
                return 'A-';
            } else if($marks >= 70){
                return 'B+';
            } else if($marks >= 65){
                return 'B';
            } else if($marks >= 60){
                 return 'B-';
            } else if($marks >= 55){
                return 'C+';
            } else if($marks >= 50){
                return 'C';
            } else if($marks >= 45){
                return 'C-';
            } else if($marks >= 40){
                return 'D+';
            } else if($marks >= 35){
                return 'D';
            } else if($marks >= 30){
                return 'D-';
            } else{
                return 'E';
            }
        }
    }

    //function that update the total marks, avarage marks and average grade     
    public function updateStudentMarksRankingTable($year, $term, $exam_type, $class_name, $student_id){


                     $total_marks = 0;
                    $no_of_subjects = 0;
                    //find the total marks for the student
                    $student_total_marks = DB::table('student_marks_ranking')
                                             ->where('year', $year)
                                             ->where('term', $term)
                                             ->where('exam_type', $exam_type)
                                             ->where('class_name', $class_name)
                                             ->where('student_id', $student_id)
                                             ->get();
                                    
                    if(!$student_total_marks->isEmpty()){
                        foreach($student_total_marks as $student_marks){
                            
                            if($student_marks->english != null){
                                $total_marks = $total_marks + $student_marks->english;
                                $no_of_subjects++;
                            }

                            if($student_marks->kiswahili != null){
                                $total_marks = $total_marks + $student_marks->kiswahili;
                                $no_of_subjects++;
                            }

                            if($student_marks->mathematics != null){
                                $total_marks = $total_marks + $student_marks->mathematics;
                                $no_of_subjects++;
                            }

                            if($student_marks->chemistry != null){
                                $total_marks = $total_marks + $student_marks->chemistry;
                                $no_of_subjects++;
                            }

                            if($student_marks->physics != null){
                                $total_marks = $total_marks + $student_marks->physics;
                                $no_of_subjects++;
                            }

                            if($student_marks->biology != null){
                                $total_marks = $total_marks + $student_marks->biology;
                                $no_of_subjects++;
                            }

                            if($student_marks->business_studies != null){
                                $total_marks = $total_marks + $student_marks->business_studies;
                                $no_of_subjects++;
                            }

                            if($student_marks->geography != null){
                                $total_marks = $total_marks + $student_marks->geography;
                                $no_of_subjects++;
                            }

                            if($student_marks->cre != null){
                                $total_marks = $total_marks + $student_marks->cre;
                                $no_of_subjects++;
                            }

                            if($student_marks->agriculture != null){
                                $total_marks = $total_marks + $student_marks->agriculture;
                                $no_of_subjects++;
                            }

                            if($student_marks->history != null){
                                $total_marks = $total_marks + $student_marks->history;
                                $no_of_subjects++;
                            }
                        }

                        if($class_name == '1E' || $class_name == '1W' || $class_name == '2E' || $class_name == '2W'){
                            $no_of_subjects = 11;
                        }

                         if($class_name == '3E' || $class_name == '3W' || $class_name == '4E' || $class_name == '4W'){
                           
                           if($no_of_subjects < 7){
                                $no_of_subjects = 7;
                           }
                            
                        }

                        $average_marks = $total_marks / $no_of_subjects;
                        $actual_average_marks = round($average_marks, 2);
                        $average_grade = $this->getGrade($actual_average_marks);


                        //update the total marks
                        $update_total_marks = DB::table('student_marks_ranking')
                                                ->where('year', $year)
                                                ->where('term', $term)
                                                ->where('exam_type', $exam_type)
                                                ->where('class_name', $class_name)
                                                ->where('student_id', $student_id)
                                                ->update([
                                                    'total'=>$total_marks,
                                                    'average_marks'=>$actual_average_marks,
                                                    'average_grade'=>$average_grade
                                                ]);
                        
                    }
    }

    
}
