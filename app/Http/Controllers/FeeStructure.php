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

            if(!$form3_fee_set->isEmpty()){
                $request->session()->flash('form4_fee_set', 'Fee structure for form 3, Term '.$term.', '.$year. ' has already been set!!');
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

        //get the current year and term;
        $period = $this->getPeriod();
        $year = $period[0];
        $term = $period[1];

        //get the data from the database
        $fee_structure = FeeStructureModel::where('year', $year)
                                          ->where('term', $term)
                                          ->get();
        
        return view('current_fee_structure', ['fee_structure'=>$fee_structure]);
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
