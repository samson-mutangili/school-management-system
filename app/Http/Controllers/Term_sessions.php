<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Term_sessions extends Controller
{
    //function for showing current session dates
    public function current_session(){

        $term = DB::table('term_sessions')
                  ->where('status', 'active')
                  ->get();


        //get the exam sessions
        $exam_sessions = DB::table('term_sessions')
                           ->join('exam_sessions', 'term_sessions.term_id', 'exam_sessions.term_id')
                           ->where('term_sessions.status', 'active')
                           ->get();

        return view("current_session", ["term_session"=>$term, 'exam_sessions'=>$exam_sessions]);
    }

    public function other_sessions(){

        return view("other_sessions");
    }

   

    //function that sets the current session
    public function set_current_session(Request $request){
        //get the data from the form
        $year = $request->input("year");
        $term = $request->input("term");
        $start_date = $request->input("start_date");
        $end_date = $request->input("end_date");

        $term_start_date = date_create_from_format("Y-m-d", $request->input("start_date"));
        $term_end_date = date_create_from_format("Y-m-d", $request->input("end_date"));


        $absolute = false;
        //echo "selected date is: ".$da;
        //get the system date
        $current_date = date_create_from_format("Y-m-d", date("Y-m-d"));

        $diff = date_diff($term_start_date, $term_end_date);

        $current_start = date_diff($current_date, $term_start_date);
        $current_end = date_diff($current_date, $term_end_date);

        $differenceFormat = ('%a');

        //check for other terms 

        if(!$absolute and $current_start->invert){
            //term start date is before the current date
            $request->session()->flash('start_past_dates', 'Incorrect term start date! The selected term start date has already passed!');
            return view('new_term_session', ['start_date'=>$start_date, 'end_date'=>$end_date, 'term'=>$term]);
        }

        if(!$absolute and $current_end->invert){
            //term end date is before the current date
            $request->session()->flash('end_past_dates', 'Incorrect term end date! The selected term end date has already passed!');
            return view('new_term_session', ['start_date'=>$start_date, 'end_date'=>$end_date, 'term'=>$term]);
        }
        if(!$absolute and $diff->invert){
            //handle for negative days
            $request->session()->flash('days_negative', 'Incorrect dates! The term end date should not be before the term start date');
            return view('new_term_session', ['start_date'=>$start_date, 'end_date'=>$end_date, 'term'=>$term]);
            //return "days are negative".$diff->days;
        } else{

            //check for term days, they should not be less than 2 months
            if($diff->days < 50){
                $request->session()->flash('term_too_short', 'Term period is too short! Typical term period should not be less than one and half months.');
                return view('new_term_session', ['start_date'=>$start_date, 'end_date'=>$end_date, 'term'=>$term]);
            }
            if($diff->days > 150){
                $request->session()->flash('term_too_long', 'Term period is too long! Typical term period should not be exceed 5 months.');
                return view('new_term_session', ['start_date'=>$start_date, 'end_date'=>$end_date, 'term'=>$term]);
            }


            //check if there is another term with the same dates
            $terms_collide = 
            //check if the academic year term is already set
            $term_set = DB::table('term_sessions')
                          ->where('year', $year)
                          ->where('term', $term)
                          ->get();
            
            if(!$term_set->isEmpty()){
                $request->session()->flash('term_already_set', 'The academic year term '.$term.' dates are already set!.');
                return view('new_term_session', ['start_date'=>$start_date, 'end_date'=>$end_date, 'term'=>$term]);
            }

            //check if there is another term with the same dates
            $terms_collide = DB::table('term_sessions')
                                ->where('year', $year)
                                ->get();

            if(!$terms_collide->isEmpty()){
                foreach($terms_collide as $terms){
                    $term_collide_start_date = date_create_from_format('Y-m-d', $terms->term_start_date);
                    $term_collide_end_date = date_create_from_format('Y-m-d', $terms->term_end_date);

                    //check for term dates collision
                    if($term_start_date >= $term_collide_start_date && $term_start_date <= $term_collide_end_date){
                        $request->session()->flash('term_start_date_collide', 'Term '.$term.' start dates collide with '.$terms->term.' dates');
                        return view('new_term_session', ['start_date'=>$start_date, 'end_date'=>$end_date, 'term'=>$term]);
                    }

                    //check for term dates collision
                    if($term_end_date >= $term_collide_start_date && $term_end_date <= $term_collide_end_date){
                        $request->session()->flash('term_end_date_collide', 'Term '.$term.' end dates collide with '.$terms->term.' dates');
                        return view('new_term_session', ['start_date'=>$start_date, 'end_date'=>$end_date, 'term'=>$term]);
                    }

                }
            }
            //insert the term date into db
            $set_new_term = DB::table('term_sessions')
                              ->insert([
                                'year'=>$year,
                                'term'=>$term,
                                'term_start_date'=>$term_start_date,
                                'term_end_date'=>$term_end_date,
                                'status'=>'active'
                              ]);

            if($set_new_term == 1){
                //term successfully set
                $request->session()->flash('term_successfully_set', 'The term dates has been set successfully');
                return redirect('/term_sessions/current_session');
            } else{
                //term not set
                $request->session()->flash('term_not_set', 'The term dates not set. Please contact admin for more information');
                return redirect('/term_sessions/current_session');
            }




           // return "days are postive".$diff->days;
        }

      //  printf("date diff is: ".($diff->format($differenceFormat)));
        // return (!$absolute and $diff->invert) ? - $diff->days : $diff->days;
        //print("numbers of days is: ".$diff->days);
        //validate data and set errors or success through flash session data
        

    }



    //function for editing term dates
    public function edit_term_session(Request $request){

        //get the data from the form
        $term_id = $request->input('term_id');
        $term_start_date = date_create_from_format("Y-m-d", $request->input('term_start_date'));
        $term_end_date = date_create_from_format("Y-m-d", $request->input('term_end_date'));

        $term_start_date_string = $request->input('term_start_date');
        $term_end_date_string = $request->input('term_end_date');

        $current_date_string = date("Y-m-d");
        $current_date = date_create_from_format("Y-m-d", $current_date_string);


        //check for valid term dates
        if($current_date > $term_start_date){
            $request->session()->flash('term_start_date_error', 'The term cannot begin at a past date!! You entered '.$term_start_date_string);
            return redirect('/term_sessions/current_session');
        }

        if($current_date > $term_end_date){
            $request->session()->flash('term_end_date_error', 'The term cannot end at a past date!! You entered '.$term_end_date_string);
            return redirect('/term_sessions/current_session');
        }

        //get the exam sessions within the term
        $exam_sessions = DB::table('exam_sessions')
                           ->where('term_id', $term_id)
                           ->get();

        if(!$exam_sessions->isEmpty()){
            foreach($exam_sessions as $exam){
                $exam_start_date = date_create_from_format('Y-m-d', $exam->exam_start_date);
                $exam_end_date = date_create_from_format('Y-m-d', $exam->exam_end_date);

                if($term_start_date >= $exam_start_date && $term_start_date <= $exam_end_date){
                    $request->session()->flash('term_start_exam_collide', 'There will be '.$exam->exam_type.' session on the term start date you entered. The input was on '.$term_start_date_string);
                    return redirect('/term_sessions/current_session');
                }

                if($term_end_date >= $exam_start_date && $term_end_date <= $exam_end_date){
                    $request->session()->flash('term_end_exam_collide', 'There will be '.$exam->exam_type.' session on the term end date you entered. The input was on '.$term_end_date_string);
                    return redirect('/term_sessions/current_session');
                }
            }
        }

        //update the term session details
        $update_term = DB::table('term_sessions')
                         ->where('term_id', $term_id)
                         ->update([
                             'term_start_date'=>$term_start_date,
                             'term_end_date'=>$term_end_date
                         ]);
        
        if($update_term == 1){
            $request->session()->flash('term_update_successful', 'Term session dates were successfully updated');
            return redirect('/term_sessions/current_session');
        } else{
            $request->session()->flash('term_update_failed', 'Failed to update term session dates! Please contact admin for more information');
            return redirect('/term_sessions/current_session');
        }



    }


    //function for ending term sessions
    public function end_term_session(Request $request){
        //get the term id
        $term_id = $request->input('term_id');
        $end_date = $request->input('end_date');

        $end_term = DB::table('term_sessions')
                     ->where('term_id', $term_id)
                     ->update([
                         'term_end_date'=>$end_date,
                         'status'=>'past'
                     ]);

        
        if($end_term == 1){

            $end_term_exam_sessions = DB::table('exam_sessions')
                                        ->where('term_id', $term_id)
                                        ->update([
                                            'exam_status'=>'past'
                                        ]); 

            $request->session()->flash('term_ended_success', 'The term session has ended successfully');
            return redirect('/term_sessions/current_session');
        } else{
            $request->session()->flash('term_ended_failed', 'Failed to end term session, please contact admin for more information');
            return redirect('/term_sessions/current_session');
        }
    }
//function that returns a form for setting exam sessions
public function new_exam_session(Request $request, $term_id){

    //get the term id
    $id = $term_id;

    //get the term details
    $term_details = DB::table('term_sessions')
                      ->where('term_id', $id)
                      ->get();

    if(!$term_details->isEmpty()){
        //get the details
        foreach($term_details as $term_set){
            $year = $term_set->year;
            $term = $term_set->term;
        }

        return view('exams.set_exam_session', ['year'=>$year, 'term'=>$term, 'term_id'=>$id]);
    } else{
        return redirect('/term_sessions/current_session');
    }
    

}

//function that sets a new exam session
public function set_exam_session(Request $request){

    //get the data from the form
    $term_id = $request->input("term_id");
    $year = $request->input("year");
    $term = $request->input("term");
    $exam_type = $request->input("exam_type");
    $exam_start_date= $request->input("exam_start_date");
    $exam_end_date = $request->input("exam_end_date");

    //get the term start dates
    $term_details = DB::table('term_sessions')
                      ->where('term_id', $term_id)
                      ->get();

    if(!$term_details->isEmpty()){
        //get the term start dates
        foreach($term_details as $term_detail){
            //get the term start and end dates
            $term_start_date_string = $term_detail->term_start_date;
            $term_end_date_string = $term_detail->term_end_date;
            $term_start_date = date_create_from_format("Y-m-d", $term_detail->term_start_date);
            $term_end_date = date_create_from_format("Y-m-d", $term_detail->term_end_date);
        }

        //check if exam session dates are in term session dates range
        $start_date = date_create_from_format("Y-m-d", $request->input("exam_start_date"));
        $end_date = date_create_from_format("Y-m-d", $request->input("exam_end_date"));

        $absolute = false;

        $start_start_difference = date_diff($term_start_date, $start_date);
        $start_end_difference = date_diff($start_date, $term_end_date);

        $end_start_difference = date_diff($term_start_date, $end_date);
        $end_end_difference = date_diff($end_date, $term_end_date);
        $exam_dates_diff = date_diff($start_date, $end_date);

        //handle for incorrect days
        if(!$absolute and $start_start_difference->invert){
            //exam start date is before the term start date
            $request->session()->flash('start_start_error', 'The exam cannot start before the term session begins. Term session starts on '.$term_start_date_string);
            return view('exams.set_exam_session', ['exam_type'=>$exam_type, 'exam_start_date'=>$exam_start_date, 'exam_end_date'=>$exam_end_date, 'term'=>$term, 'year'=>$year, 'term_id'=>$term_id]);
        }

        //handle for incorrect days
        if(!$absolute and $start_end_difference->invert){
            //exam start date is before the term start date
            $request->session()->flash('start_end_error', 'The exam cannot start after the term session ends. Term session ends on '.$term_end_date_string);
            return view('exams.set_exam_session', ['exam_type'=>$exam_type, 'exam_start_date'=>$exam_start_date, 'exam_end_date'=>$exam_end_date, 'term'=>$term, 'year'=>$year, 'term_id'=>$term_id]);
        }

        //handle for incorrect days
        if(!$absolute and $end_start_difference->invert){
            //exam start date is before the term start date
            $request->session()->flash('end_start_error', 'The exam cannot end before the term session begins. Term session starts on '.$term_start_date_string);
            return view('exams.set_exam_session', ['exam_type'=>$exam_type, 'exam_start_date'=>$exam_start_date, 'exam_end_date'=>$exam_end_date, 'term'=>$term, 'year'=>$year, 'term_id'=>$term_id]);
        }

        //handle for incorrect days
        if(!$absolute and $end_end_difference->invert){
            //exam start date is before the term start date
            $request->session()->flash('end_end_error', 'The exam cannot end after the term session ends. Term session ends on '.$term_end_date_string);
            return view('exams.set_exam_session', ['exam_type'=>$exam_type, 'exam_start_date'=>$exam_start_date, 'exam_end_date'=>$exam_end_date, 'term'=>$term, 'year'=>$year, 'term_id'=>$term_id]);
        }

        //handle for incorrect days
        if(!$absolute and $exam_dates_diff->invert){
            //exam start date is before the term start date
            $request->session()->flash('dates_error', 'The exam end date cannot be before exam start date!');
            return view('exams.set_exam_session', ['exam_type'=>$exam_type, 'exam_start_date'=>$exam_start_date, 'exam_end_date'=>$exam_end_date, 'term'=>$term, 'year'=>$year, 'term_id'=>$term_id]);
        }

        

        //check if the exam type dates are already set
        $exam_type_set = DB::table('term_sessions')
                           ->join('exam_sessions', 'term_sessions.term_id', 'exam_sessions.term_id')
                           ->where('term_sessions.term_id', $term_id)
                           ->where('exam_sessions.exam_type', $exam_type)
                           ->get();
        
        //exam type dates already set
        if(!$exam_type_set->isEmpty()){
            //exam type dates already set, set error message
            $request->session()->flash('exam_type_set_error', $exam_type.' dates are already set!');
            return view('exams.set_exam_session', ['exam_type'=>$exam_type, 'exam_start_date'=>$exam_start_date, 'exam_end_date'=>$exam_end_date, 'term'=>$term, 'year'=>$year, 'term_id'=>$term_id]);
        
        }


        //check for other exam dates in between

        $exam_dates_collide =DB::table('term_sessions')
                                ->join('exam_sessions', 'term_sessions.term_id', 'exam_sessions.term_id')
                                ->where('term_sessions.term_id', $term_id)
                                ->get();

        if(!$exam_dates_collide->isEmpty()){
            foreach($exam_dates_collide as $dates_collision){
                $other_exam_start_dates = date_create_from_format('Y-m-d', $dates_collision->exam_start_date);
                $other_exam_end_dates = date_create_from_format('Y-m-d', $dates_collision->exam_end_date);
                
                //check for other exam dates collision
                if($start_date >= $other_exam_start_dates && $start_date <= $other_exam_end_dates){
                    $request->session()->flash('exam_start_date_collide', $exam_type.' start date error! There will be an ongoing '.$dates_collision->exam_type.' on '.$exam_start_date);
                    return view('exams.set_exam_session', ['exam_type'=>$exam_type, 'exam_start_date'=>$exam_start_date, 'exam_end_date'=>$exam_end_date, 'term'=>$term, 'year'=>$year, 'term_id'=>$term_id]);
                
                }

                if($end_date >= $other_exam_start_dates && $end_date <= $other_exam_end_dates){
                    $request->session()->flash('exam_end_date_collide', $exam_type.' end date error! There will be an ongoing '.$dates_collision->exam_type.' on '.$exam_end_date);
                    return view('exams.set_exam_session', ['exam_type'=>$exam_type, 'exam_start_date'=>$exam_start_date, 'exam_end_date'=>$exam_end_date, 'term'=>$term, 'year'=>$year, 'term_id'=>$term_id]);
                
                }
            }
        }

        //insert the exam session into DB
        $insert_exam_session = DB::table('exam_sessions')
                                 ->insert([
                                    'term_id'=>$term_id,
                                    'exam_type'=>$exam_type,
                                    'exam_start_date'=>$exam_start_date,
                                    'exam_end_date'=>$exam_end_date,
                                    'exam_status'=>'Undue'
                                 ]);

        if($insert_exam_session == 1){
            $request->session()->flash('exam_session_set_successful', $exam_type.' dates have been set successfully');
            return redirect('/term_sessions/current_session');
        
        }

        //insert details into db
        //$set_exam_dates = DB::table('exam_sessions')

    } else{
        //set message in flash session
        $request->session()->flash('no_active_term', 'The term session does not exist');
        return redirect('/term_session/set_exam_session/'.$term_id);
    }
}

//function for removing exam session
public function remove_exam_session(Request $request){

    //get the exam id
    $exam_id = $request->input('exam_id');

    //delete exam session record from DB
    $delete_record = DB::table('exam_sessions')
                       ->where('exam_id', $exam_id)
                       ->delete();

    if($delete_record == 1){
        //set success message in flash session
        $request->session()->flash('exam_session_removed', 'The exam session has been removed successfully');
        return redirect('/term_sessions/current_session');
    } else{
        //set error message in flash session
        $request->session()->flash('exam_session_fail', 'Failed to remove exam session. Please contact admin for more information!');
        return redirect('/term_sessions/current_session');
    }
}

//function for editing exam sessions
public function edit_exam_session(Request $request){

    //get the details from the form
    $exam_id = $request->input('exam_id');
    $term_id = $request->input('term_id');
    $exam_type = $request->input('exam_type');
    $exam_start_date = date_create_from_format("Y-m-d", $request->input('exam_start_date'));
    $exam_end_date = date_create_from_format("Y-m-d", $request->input('exam_end_date'));
    

    $exam_start_date_string = $request->input('exam_start_date');
    $exam_end_date_string = $request->input('exam_end_date');


    //get the term start dates
    $term_details = DB::table('term_sessions')
                      ->where('term_id', $term_id)
                      ->get();

    if(!$term_details->isEmpty()){
        //get the term start dates
        foreach($term_details as $term_detail){
            //get the term start and end dates
            $term_start_date_string = $term_detail->term_start_date;
            $term_end_date_string = $term_detail->term_end_date;
            $term_start_date = date_create_from_format("Y-m-d", $term_detail->term_start_date);
            $term_end_date = date_create_from_format("Y-m-d", $term_detail->term_end_date);
        }

        //check if exam dates is in term dates range
        if(!($exam_start_date >= $term_start_date && $exam_start_date <= $term_end_date)){
            $request->session()->flash('start_date_out', 'The exam start date is out of term session start date. Term starts on '.$term_start_date_string. ' and your input for the exam start date is '.$exam_start_date_string);
            return redirect('/term_sessions/current_session');
        }

        if(!($exam_end_date >= $term_start_date && $exam_end_date <= $term_end_date)){
            $request->session()->flash('end_date_out', 'The exam end date is out of term session end date. Term ends on '.$term_end_date_string.' and your input for exam end date is '.$exam_end_date_string);
            return redirect('/term_sessions/current_session');
        }

        //check for other exam sessions dates
        $other_exam_sessions = DB::table('exam_sessions')
                                 ->where('term_id', $term_id)
                                 ->where('exam_id', '!=', $exam_id)
                                 ->get();

        if(!$other_exam_sessions->isEmpty()){
            foreach($other_exam_sessions as $exam){
                $other_exam_start_date = date_create_from_format("Y-m-d", $exam->exam_start_date);
                $other_exam_end_date = date_create_from_format("Y-m-d", $exam->exam_end_date);

                //check if dates collides
                if($exam_start_date >= $other_exam_start_date && $exam_start_date <= $other_exam_end_date){
                    $request->session()->flash('start_date_collide', 'Exam start date error! There will be another ongoing '.$exam->exam_type.' on the date '.$exam_start_date_string);
                    return redirect('/term_sessions/current_session');
                }

                if($exam_end_date >= $other_exam_start_date && $exam_end_date <= $other_exam_end_date){
                    $request->session()->flash('end_date_collide', 'Exam end date error! There will be another ongoing '.$exam->exam_type.' on the date '.$exam_end_date_string);
                    return redirect('/term_sessions/current_session');
                }

            }
        }

        //all errors catered for, now update the exam session dates
        $update_exam_session = DB::table('exam_sessions')
                                 ->where('exam_id', $exam_id)
                                 ->update([
                                     'exam_start_date'=>$exam_start_date,
                                     'exam_end_date'=>$exam_end_date
                                 ]);

        if($update_exam_session == 1){
            //update successful
            $request->session()->flash('exam_session_update_successful', $exam_type.' dates have been updated successfully');
            return redirect('/term_sessions/current_session');
        } else{
            //update failed
            $request->session()->flash('exam_session_update_failed', $exam_type.' dates failed to be updated! Please contact the admin for more information');
            return redirect('/term_sessions/current_session');
        }
                                


    }
}

}
