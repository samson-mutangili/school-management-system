<?php

namespace App\Http\Controllers;

use App\FeeStructureModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FeeStructure extends Controller
{
    //function that is used to save the fee structure data in to db
    public function submit(Request $request){

        //get the inputs from the form
        $year = $request->input('year');
        $class_name = $request->input('class_name');
        $term = $request->input('term');
        $fee = $request->input('total_fees');

        //check if the fee had been set before
        if($class_name == "All"){

            $form1_fee_set = FeeStructureModel::where('year', $year)
                                              ->where('class', 'Form 1')
                                              ->where('term', $term)
                                              ->get();


            $form2_fee_set = FeeStructureModel::where('year', $year)
                                              ->where('class', 'Form 2')
                                              ->where('term', $term)
                                              ->get();

            $form3_fee_set = FeeStructureModel::where('year', $year)
                                              ->where('class', 'Form 3')
                                              ->where('term', $term)
                                              ->get();

            $form4_fee_set = FeeStructureModel::where('year', $year)
                                              ->where('class', 'Form 4')
                                              ->where('term', $term)
                                              ->get();
            
            if(!$form1_fee_set->isEmpty()){
                $request->session()->flash('form1_fee_set', 'Fee structure for form 1, Term '.$term.', '.$year. ' has already been set!!');
            }

            if(!$form2_fee_set->isEmpty()){
                $request->session()->flash('form2_fee_set', 'Fee structure for form 2, Term '.$term.', '.$year. ' has already been set!!');
            }

            if(!$form3_fee_set->isEmpty()){
                $request->session()->flash('form3_fee_set', 'Fee structure for form 3, Term '.$term.', '.$year. ' has already been set!!');
            }

            if(!$form4_fee_set->isEmpty()){
                $request->session()->flash('form4_fee_set', 'Fee structure for form 4, Term '.$term.', '.$year. ' has already been set!!');
            }


            if( !$form1_fee_set->isEmpty() || !$form2_fee_set->isEmpty() || !$form3_fee_set->isEmpty() || !$form4_fee_set->isEmpty()){

                return redirect('/new_fee_structure');
            }
        }
        else{

            //check the specific class
            $fee_set = FeeStructureModel::where('year', $year)
                                        ->where('class', $class_name)
                                        ->where('term', $term)
                                        ->get();
            //if there is some data, set an error message in a flash session                     
            if(!$fee_set->isEmpty()){
                $request->session()->flash('fee_set', 'Fee structure for '.$class_name.', Term '.$term.', '.$year. ' has already been set!!');
            }   
            
            if(!$fee_set->isEmpty()){
                //redirect to the fee structure form
                return redirect('/new_fee_structure'); 
            }
        }


        

        if($class_name == "All"){
            //insert corresponding fees for each class
            $fee_structure1 = new FeeStructureModel;
            $fee_structure1->year = $year;
            $fee_structure1->class = 'Form 1';
            $fee_structure1->term = $term;
            $fee_structure1->fee = $fee;
            $fee_structure1->save();

            $fee_structure2 = new FeeStructureModel;
            $fee_structure2->year = $year;
            $fee_structure2->class = 'Form 2';
            $fee_structure2->term = $term;
            $fee_structure2->fee = $fee;
            $fee_structure2->save();

            $fee_structure3 = new FeeStructureModel;
            $fee_structure3->year = $year;
            $fee_structure3->class = 'Form 3';
            $fee_structure3->term = $term;
            $fee_structure3->fee = $fee;
            $fee_structure3->save();

            $fee_structure4 = new FeeStructureModel;
            $fee_structure4->year = $year;
            $fee_structure4->class = 'Form 4';
            $fee_structure4->term = $term;
            $fee_structure4->fee = $fee;
            $fee_structure4->save();

            $request->session()->flash('fee_strucure_saved', 'Fee structure details have been saved successfully');
            return redirect('/current_fee_structures');
        }
        else{
            //insert the specific class fee structure
            $fee_structure5 = new FeeStructureModel;
            $fee_structure5->year = $year;
            $fee_structure5->class = $class_name;
            $fee_structure5->term = $term;
            $fee_structure5->fee = $fee;
            $fee_structure5->save();

            $request->session()->flash('fee_strucure_saved', 'Fee structure details have been saved successfully');
            return redirect('/current_fee_structures');
        }

    }


    public function showCurrentFeeStructure(){

       
        $year;
        $term;

        //get the current active term
        $term_period = DB::table('term_sessions')
                         ->where('status', 'active')
                         ->get();

        if(!$term_period->isEmpty()){

            foreach($term_period as $period){
                $year = $period->year;
                $term = $period->term;
            }

                //get the data from the database
            $fee_structure = FeeStructureModel::where('year', $year)
                                                ->where('term', $term)
                                                ->get();
            if($fee_structure->isEmpty()){
                $request->session->flash('fee_structure_not_set', 'No fee structure has been set');
            }

            return view('current_fee_structure', ['fee_structure'=>$fee_structure]);
        }
        else{
            $request->session()->flash('no_active_session', 'There is no active term session!');
            return view('current_fee_structure', ['no_term_session'=>'NO active term session']);
        }

        
    }



    //function to update fee structure details
    public function update(Request $request){


        //get the details from the form
        $id = $request->input('id');
        $class_name = $request->input('class_name');
        $fees = $request->input('total_fees');


        if($fees == "" or $fees == null){
            //set data in a flash session
             $request->session()->flash('fee_failed', 'Can not update with an empty value');
             return redirect('/current_fee_structures');
        }

        if($fees <= 0){
            //set data in a flash session
             $request->session()->flash('fee_failed', 'Total fees can not be zero or a negative value. You entered '.$fees. ' ');
             return redirect('/current_fee_structures');
        }

        if($fees < 100 || $fees > 100000){
            //set data in a flash session
             $request->session()->flash('fee_failed', 'Unreasonable total fees. You entered '.$fees.' ');
             return redirect('/current_fee_structures');
        }


        $get_data = DB::table('fee_structures')->where('id', $id)->get();

        if(!$get_data->isEmpty()){

            foreach($get_data as $data){
                $class_form = $data->class;
                $old_fee = $data->fee;
                $year = $data->year;
            }

        } else{
            return redirect('/current_fee_structures'); 
        }

        if($class_form == "Form 1"){
            $stream1 = "1E";
            $stream2 = "1W";
        } else if($class_form == "Form 2"){
            $stream1 = "2E";
            $stream2 = "2W";
        } else if($class_form == "Form 3"){
            $stream1 = "3E";
            $stream2 = "3W";
        } else if($class_form == "Form 4"){
            $stream1 = "4E";
            $stream2 = "4W";
        }

        $fee_difference = $fees - $old_fee;

        //get the students in  the classes
        $students = DB::table('students')
                      ->join('student_classes', 'students.id', 'student_classes.student_id')
                      ->where('students.status', 'active')
                      ->where('student_classes.status', 'active')
                      ->where('student_classes.class_name', $class_form)
                      ->get();


        $overpay = 0;
        $fee_balance = 0;
        //loop through each student and update the fee balances
        foreach($students as $student){
            //get the student in db
            $student_fee_details = DB::table('fee_balances')->where('student_id', $student->id)->get();
            if(!$student_fee_details->isEmpty()){
                foreach($student_fee_details as $fee_detail){
                    if($fee_detail->student_id == $student->id){
                        $new_student_total_fee = $fee_detail->total_fees + $fee_difference;
                        if($new_student_total_fee > $fee_detail->amount_paid){
                            $fee_balance = $new_student_total_fee - $fee_detail->amount_paid;
                            
                        } else{
                            $overpay = $fee_detail->amount_paid - $new_student_total_fee;

                        }

                        //update student details
                        $student_update = DB::table('fee_balances')
                                            ->where('student_id', $student->id)
                                            ->update([
                                                'total_fees'=>$new_student_total_fee,
                                                'balance'=>$fee_balance,
                                                'overpay'=>$overpay
                                            ]);

                    }

                }
                
            } else{

                //insert a new record
                $insert_new = DB::table('fee_balances')
                                ->insert([
                                    'student_id'=>$student->id,
                                    'total_fees'=>$fees,
                                    'amount_paid'=>0,
                                    'balance'=>$fees,
                                    'overpay'=>$overpay
                                ]);

            }
        }

        




        //query to update
        $update_fee = DB::table('fee_structures')
                        ->where('id', $id)
                        ->update([
                            'fee'=>$fees
                        ]);

        
        //set data in a flash session
        $request->session()->flash('fee_updated_successfully', 'Total fees for '.$class_name. ' has been updated successfully');

        return redirect('/current_fee_structures');



    }



       //function that gets the time period
       public function getPeriod(){

        //get the academic year, term and exam type
        //get the year, term and exam type
        $year = date("Y");
        $month = date("m");
        $term;

       if($month >= 1 && $month <= 4){
           $term = 1;
          
       }
       else if($month >= 5 && $month <= 8){
           $term = 2;
           
       } 
       else if($month >= 9 && $month <= 12){
           $term = 3;
       }

       return array($year, $term);

    }
}
