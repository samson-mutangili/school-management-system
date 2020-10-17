<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;

use Closure;

class TermSessionChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //get current date
        $date = date('Y-m-d');
        $current_date = date_create_from_format('Y-m-d', $date);
        $year = date('Y');

        //check for valid term dates
        $terms = DB::table('term_sessions')
                   ->where('year', $year)
                   ->get();

        if(!$terms->isEmpty()){
            foreach($terms as $term_session){
                $term_start_date = date_create_from_format('Y-m-d', $term_session->term_start_date);
                $term_end_date = date_create_from_format('Y-m-d', $term_session->term_end_date);

                if($current_date >= $term_start_date && $current_date <= $term_end_date){
                    //update the term to active
                    $update_active = DB::table('term_sessions')
                                     ->where('term_id', $term_session->term_id)
                                     ->update([
                                         'status'=>'active'
                                     ]);
                }

                if($current_date > $term_end_date){
                    //update the term to past
                    $update_past = DB::table('term_sessions')
                                     ->where('term_id', $term_session->term_id)
                                     ->update([
                                         'status'=>'past'
                                     ]);
                }

                if($current_date < $term_start_date){
                    //update the term to undue
                    $update_undue = DB::table('term_sessions')
                                     ->where('term_id', $term_session->term_id)
                                     ->update([
                                         'status'=>'undue'
                                     ]);
                }
                
            }
        }

        //update term sessions depending on the active term
        $active_term = DB::table('term_sessions')
                        ->join('exam_sessions', 'term_sessions.term_id', 'exam_sessions.term_id')
                        ->where('term_sessions.status', 'active')
                        ->get();

        if(!$active_term->isEmpty()){
            //update the exam session status
            foreach($active_term as $term_session){

                //get the exams start and end dates
                $exam_start_date = date_create_from_format('Y-m-d', $term_session->exam_start_date);
                $exam_end_date = date_create_from_format('Y-m-d', $term_session->exam_end_date);

                if($current_date >= $exam_start_date && $current_date <= $exam_end_date){
                    $update_to_active = DB::table('exam_sessions')
                                          ->where('exam_id', $term_session->exam_id)
                                          ->update([
                                                'exam_status'=>'active'
                                          ]);
                }

                if($current_date > $exam_end_date){
                    $update_to_past = DB::table('exam_sessions')
                                          ->where('exam_id', $term_session->exam_id)
                                          ->update([
                                                'exam_status'=>'past'
                                          ]);
                }

                if($current_date < $exam_start_date){
                    $update_to_undue = DB::table('exam_sessions')
                                          ->where('exam_id', $term_session->exam_id)
                                          ->update([
                                                'exam_status'=>'undue'
                                          ]);
                }
            }
        }
        
        return $next($request);
    }
}
