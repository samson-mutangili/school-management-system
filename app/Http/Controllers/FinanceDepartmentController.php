<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\FeeBalances;
use App\Student;

class FinanceDepartmentController extends Controller
{

    public function displayDashboard(){

        //get the number of students
        $students_no = DB::table('students')
                         ->where('status', 'active')
                         ->count();

        //get percentage of students who have cleared school fees
        $cleared_fee = DB::table('students')
                         ->join('fee_balances', 'students.id', 'fee_balances.id')
                         ->where('students.status', 'active')
                         ->where('fee_balances.balance', 0)
                         ->count();

        $percentage_clear = ($cleared_fee / $students_no) * 100;
        $percentage_cleared = round($percentage_clear, 2);

        //get the sum of amount collected that term
        $amount_collected = DB::table('fee_transactions')->sum('amount');

        return view('finance_dashboard', ['students_no'=>$students_no, 'percentage_cleared'=>$percentage_cleared, 'amount_collected'=>$amount_collected]);
    }

    public function take_fees($class_name){


        //get the class name
        $className = $class_name;

        if($className == "1W" || $className == "1E"){
            $classForm = "Form 1";
        } else if($className == "2W" || $className == "2E"){
            $classForm = "Form 2";
        } else if($className == "3W" || $className == "3E"){
            $classForm = "Form 3"; 
        } else if($className == "4W" || $className == "4E"){
            $classForm = "Form 4";
        }

        $term_session = DB::table('term_sessions')->where('status', 'active')->get();
            if(!$term_session->isEmpty()){
                foreach($term_session as $term_ses){
                    $year = $term_ses->year;
                    $term = $term_ses->term;
                }
            }


        //get the total fees for the term
        $total_fees = DB::table('fee_structures')
                        ->select('fee')
                        ->where('year', $year)
                        ->where('class', $classForm)
                        ->where('term', $term)
                        ->get();
        
        $fees = 0;
        if(!$total_fees->isEmpty()){
            foreach($total_fees as $class_fee){
                $fees = $class_fee->fee;                
            }
        }


        //get the students in that class
        $students = DB::table('students')
                      ->join('student_classes', 'students.id', 'student_classes.student_id')
                      ->where('student_classes.stream', $className)
                      ->where('students.status', 'active')
                      ->where('student_classes.status', 'active')
                      ->get();
        
        //get the details from fee balances
        $fee_balances = FeeBalances::all();

                
        return view('take_fees', ['students'=>$students, 'term'=>$term, 'class_name'=>$className,'fees'=>$fees, 'fee_balances'=>$fee_balances]);
    }


    public function displayInputForm(Request $request, $student_id){

        //get the student id
        $id = $student_id;

        //get the fee balance
        $fee_details = DB::table('fee_balances')
                         ->select('balance')
                         ->where('student_id', $id)
                         ->get();

        $fee_balance = null;
        if(!$fee_details->isEmpty()){
            foreach($fee_details as $details){
                $fee_balance = $details->balance;
            }
        }

        //get the student details
        $student_details = DB::table('students')
                             ->where('id', $id)
                             ->where('status', 'active')
                             ->get();
        if(!$student_details->isEmpty()){
            foreach($student_details as $student){
                $student_name = $student->first_name.' '. $student->middle_name.' '.$student->last_name;
                $class_name = $student->class;
                $adm_no = $student->admission_number;
                
                //check whether student has ever paid fees
                if($fee_balance == null){
                    
                    $classForm;
                                        
                    if($student->class == "1W" || $student->class == "1E"){
                        $classForm = "Form 1";
                    } else if($student->class == "2W" || $student->class == "2E"){
                        $classForm = "Form 2";
                    } else if($student->class == "3W" || $student->class == "3E"){
                        $classForm = "Form 3"; 
                    } else if($student->class == "4W" || $student->class == "4E"){
                        $classForm = "Form 4";
                    }

                    $year = date("Y");
                    $term = $this->getPeriod();
                    //get the fee
                    $fee = DB::table('fee_structures')
                             ->select('fee')
                             ->where('year', $year)
                             ->where('class', $classForm)
                             ->where('term', $term)
                             ->get();
                    
                    if(!$fee->isEmpty()){
                        foreach($fee as $new_fee){
                            $fee_balance = $new_fee->fee;
                        }
                    }
                }
            }
        } else{
            return 'Error!! The student does not exist';
        }

        //return view that has the fee form
        return view('fee_input', ['id'=>$id, 'student_name'=>$student_name, 'adm_no'=>$adm_no, 'class_name'=>$class_name, 'fee_balance'=>$fee_balance]);
    }


    //function for handling new fee records
    public function record_new_fees(Request $request){
      
        $is_alumni = null;
        $student_name = $request->input('name');
        $adm_no = $request->input('admission_no');
        $return_fee = $request->input('fee_balance');

        $is_alumni = $request->input('is_alumni');

        //get the student class
        $className = $request->input('class_name');
        
        $classForm = $this->getClassForm($className);

        //get the data from the form
        $student_id = $request->input('id');
        $branch_name = $request->input('branch_name');
        $transaction_no = $request->input('ref_no');
        $date_paid = $request->input('date_paid');
        $amount = $request->input('amount');

        //check if the transaction number had already been used
        $check_no = DB::table('fee_transactions')
                      ->where('transaction_no', $transaction_no)
                      ->get();

           
        if($is_alumni == null){
            if(!$check_no->isEmpty()){
                $transaction_no_error_message = "The transaction number has already been used.";
                return view('fee_input', ['id'=>$student_id,
                 'student_name'=>$student_name, 
                 'adm_no'=>$adm_no, 
                 'class_name'=>$className, 
                 'fee_balance'=>$return_fee,
                 'transaction_no'=>$transaction_no,
                 'date_paid'=>$date_paid,
                 'amount'=>$amount,
                 'transaction_no_error_message'=>$transaction_no_error_message
                 ]);
            }
        } else{
            if(!$check_no->isEmpty()){
                $transaction_no_error_message = "The transaction number has already been used.";
                return view('alumni.alumni_input_fee_form', ['id'=>$student_id,
                 'student_name'=>$student_name, 
                 'adm_no'=>$adm_no, 
                 'is_alumni'=>'the student is an alumni',
                 'fee_balance'=>$return_fee,
                 'transaction_no'=>$transaction_no,
                 'date_paid'=>$date_paid,
                 'amount'=>$amount,
                 'transaction_no_error_message'=>$transaction_no_error_message
                 ]);
            }
        }
        

        //get the id of the staff doing the transaction
        $non_teaching_staff_id = $request->Session()->get('non_teaching_staff_id');

        $date_recorded = date("Y-m-d h:m:s");
        
        //recored the transaction into database
        $insert_transaction = DB::table('fee_transactions')
                                ->insert([
                                    'student_id'=>$student_id,
                                    'branch'=>$branch_name,
                                    'transaction_no'=>$transaction_no,
                                    'date_paid'=>$date_paid,
                                    'amount'=>$amount,
                                    'date_recorded'=>$date_recorded,
                                    'emp_id'=>$non_teaching_staff_id
                                ]);

        //get the student details from the fee balances transactions
        $student_fee_balance_record = DB::table('fee_balances')
                                        ->where('student_id', $student_id)
                                        ->get();


        if(!$student_fee_balance_record->isEmpty()){

            foreach($student_fee_balance_record as $student_fee_balances){
                $old_total_fees = $student_fee_balances->total_fees;
                $old_paid = $student_fee_balances->amount_paid;
                $old_balance = $student_fee_balances->balance;
                $old_overpay = $student_fee_balances->overpay;

                $total_new_paid = $old_paid + $amount;
                $current_new_balance = $old_total_fees - $total_new_paid;
                $student_balance = $current_new_balance;
                $new_overpay = $old_overpay;

                if($current_new_balance < 0){
                    $student_balance = 0;
                    $new_overpay = $total_new_paid - $old_total_fees;
                }

                //update the student fee balance record
                $update_fee_balances = DB::table('fee_balances')
                                         ->where('student_id', $student_id)
                                         ->update([
                                            'amount_paid'=>$total_new_paid,
                                            'balance'=>$student_balance,
                                            'overpay'=>$new_overpay
                                         ]);

            }

        } else{
            //there are no student records in the fee balances, so insert a new record
            
            $term_session = DB::table('term_sessions')->where('status', 'active')->get();
            if(!$term_session->isEmpty()){
                foreach($term_session as $term_ses){
                    $year = $term_ses->year;
                    $term = $term_ses->term;
                }
            }

            

            //get the total fees
            $total_fee = DB::table('fee_structures')
                           ->select('fee')
                           ->where('year', $year)
                           ->where('class', $classForm)
                           ->where('term', $term)
                           ->get();

            $fee_total;
            if(!$total_fee->isEmpty()){
                foreach($total_fee as $fees_total){
                    $fee_total = $fees_total->fee;
                }
            }

            $balance = $fee_total - $amount;
            $new_balance = $balance;
            $overpay = 0;
            if($balance <= 0 ){
                $new_balance = 0;
                $overpay = $amount - $fee_total;
            }
            
            //insert a new record
            $new_record = DB::table('fee_balances')
                            ->insert([
                                'student_id'=>$student_id,
                                'total_fees'=>$fee_total,
                                'amount_paid'=>$amount,
                                'balance'=>$new_balance,
                                'overpay'=>$overpay
                            ]);
        }

        //return redirect

        if($is_alumni != null){
            $request->session()->flash('fee_recorded_successfully', 'Student fees has been recorded successfully');
            return redirect('/finance_department/alumni/take_fees/');
        } else{
            $request->session()->flash('fee_recorded_successfully', 'Student fees has been recorded successfully');
             return redirect('/finance_department/take_fees/'.$className);
        }
        
    }


    public function viewFeeBalances($className){

        $term_session = DB::table('term_sessions')->where('status', 'active')->get();
        if(!$term_session->isEmpty()){
            foreach($term_session as $term_ses){
                $year = $term_ses->year;
                $term = $term_ses->term;
            }
        }


        $specific_class = $className;
        $classForm = $this->getClassForm($specific_class);

        //get the total fees for the class
        $total_fees = DB::table('fee_structures')
                        ->select('fee')
                        ->where('year', $year)
                        ->where('class', $classForm)
                        ->where('term', $term)
                        ->get();


        if(!$total_fees->isEmpty()){
            foreach($total_fees as $term_fee){
                $fees = $term_fee->fee;
            }
        }
        //get the students from that class
        $students = DB::table('students')
                      ->join('student_classes', 'students.id', 'student_classes.student_id')
                      ->where('students.status', 'active')
                      ->where('student_classes.stream', $specific_class)
                      ->where('student_classes.status', 'active')
                      ->get();


        
        //get the students from the fee balances
        $students_fee_balances = DB::table('fee_balances')->get();

        return view('fee_balances', ['class_name'=>$specific_class, 'students'=>$students, 'students_fee_balances'=>$students_fee_balances, 'fees'=>$fees]);
    }


    //function that converts fee balances data to pdf format
    public function downloadFeeBalances(Request $request, $class_name){
        
        //get the class name
        $specific_class_name = $class_name;        

        //get the full url 
        $reference_link = $request->fullUrl();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->getFeeBalancesPDF($specific_class_name, $reference_link));
        return $pdf->stream();       

    }

    public function getFeeBalancesPDF($class_name, $reference_link){

        $specific_classname = $class_name;
        $term_session = DB::table('term_sessions')->where('status', 'active')->get();
        if(!$term_session->isEmpty()){
            foreach($term_session as $term_ses){
                $year = $term_ses->year;
                $term = $term_ses->term;
            }
        }
        $SpecificForm = $this->getClassForm($specific_classname);

        $day_date = date("Y-m-d");

        //get the total fees for the class
        $total_fees = DB::table('fee_structures')
                        ->select('fee')
                        ->where('year', $year)
                        ->where('class', $SpecificForm)
                        ->where('term', $term)
                        ->get();


        if(!$total_fees->isEmpty()){
            foreach($total_fees as $term_fee){
                $fees = $term_fee->fee;
            }
        }
        //get the students from that class
        $students = DB::table('students')
                      ->where('class', $specific_classname)
                      ->get();
        
        //get the students from the fee balances
        $students_fee_balances = DB::table('fee_balances')->get();
        $space = " \t\t             ";

        $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg"  alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>
        <ul style="list-style: none; ">
            <li style="float: left; font-size: 17px;" >
                School fees balances for Form '.$specific_classname.'
            </li>

            <li style="float: right;">
                Date : '.$day_date.'
            </li>
        </ul>
        <br>
        ';

        $output .='<br>
                <table width="100%" style="border-collapse: collapse; border:0px;">
                <tr>
                    <th style="border: 1px solid; padding: 5px;" align="left" width="5%">#NO</th>
                    <th style="border: 1px solid; padding: 5px;"  align="left" width="10%" >ADM. NO</th>
                    <th style="border: 1px solid; padding: 5px;"  align="left"width="45%">Student name</th>
                    <th style="border: 1px solid; padding: 5px;" align="left" width="10%" >Fees Balance</th>
                    

                </tr>
        ';
        $i = 1;

        foreach($students as $student){
            $output .=' <tr>
                                <td style="border: 1px solid; padding: 5px;">'.$i++.'</td>
                                <td style="border: 1px solid; padding: 5px;">'.$student->admission_number.'</td>
                        <td style="border: 1px solid; padding: 5px;">'.$student->first_name.' '.$student->middle_name.' '.$student->last_name.'</td>
                ';
                               
                                    $fee_balance = $fees;
                                    if(!$students_fee_balances->isEmpty()){
                                        foreach ($students_fee_balances as $student_balance) {
                                            if($student_balance->student_id == $student->id){
                                                $fee_balance = $student_balance->balance;
                                            }
                                        }
                                    }
            $output .='
                                <td style="border: 1px solid; padding: 5px;">'.$fee_balance.'</td>
                        </tr>
                        
                        ';
        }

        $output .= '
        </table>
        <br>
        <br>
        Printed on : '.$day_date. '
                <br>
                Reference link : <a href="" style="text-decoration: none;"> '.$reference_link.'</a>
        ';
        

        return $output;
       

    }


    public function allClassFeeStatements($class_name){

        //get the class name
        $className = $class_name;

        //select all students in the class
        $students = DB::table('students')
                      ->join('student_classes', 'students.id', 'student_classes.student_id')
                      ->where('students.status', 'active')
                      ->where('student_classes.stream', $className)
                      ->where('student_classes.status', 'active')
                      ->get();
                      
        //return view
        return view('fee_statements', ['students'=>$students, 'class_name'=>$className]);
    }

    //function for viewing student fee statement
    public function viewFeeStatement($class_name, $student_id){

        $studentID = $student_id;
        $specific_classname = $class_name;

        $student_details = DB::table('students')
                             ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                             ->where('students.id', $studentID)
                             ->get();
               

        $fee_transactions = DB::table('fee_transactions')
                               ->where('student_id', $studentID)
                               ->get();

        $bank_transactions_amount = DB::table('fee_transactions')
                               ->where('student_id', $studentID)
                               ->sum('amount');
         $mpesa_transactions = DB::table('mpesa_transactions')
                                ->where('student_id', $studentID)
                                ->get();

         $mpesa_total = DB::table('mpesa_transactions')
                          ->where('student_id', $studentID)
                          ->sum('amount');

   
                          

        return view('student_fee_statement', [
            'student_id'=>$studentID,
            'class_name'=>$specific_classname,
            'student_details'=>$student_details,
            'fee_transactions'=>$fee_transactions,
            'mpesa_transactions'=>$mpesa_transactions,
            'mpesa_total'=>$mpesa_total,
            'bank_transactions_amount'=>$bank_transactions_amount
            ]);

    }

    //function that downloads the student fee statement in PDF format
    public function downloadFeeStatement(Request $request, $student_id){

        //get the full url 
        $reference_link = $request->fullUrl();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->getFeeStatementPDF($student_id, $reference_link));
        return $pdf->stream();       

    }


    public function getFeeStatementPDF($student_id, $reference_link){

        //get the student id
        $studentID = $student_id;

        $student_details = DB::table('students')
                             ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                             ->where('students.id', $studentID)
                             ->get();
               

        $fee_transactions = DB::table('fee_transactions')
                               ->where('student_id', $studentID)
                               ->get();

        $bank_transactions_amount = DB::table('fee_transactions')
                               ->where('student_id', $studentID)
                               ->sum('amount');
         $mpesa_transactions = DB::table('mpesa_transactions')
                                ->where('student_id', $studentID)
                                ->get();

         $mpesa_total = DB::table('mpesa_transactions')
                          ->where('student_id', $studentID)
                          ->sum('amount');

        $sum_total_paid = $bank_transactions_amount + $mpesa_total;


        $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg"  alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>
        <p style="text-align: center; font-size: 17px;">FEES STATEMENT</p>

        ';

        
        $output .='
        <table width="100%">
        <tr>
            <th width="15%"></th>
            <th></th>
        </tr>';

        $day_date = date("d-m-Y");

        foreach ($student_details as $student){
           
        $output .='
            <tr>
                <td> ADM NO.  </td>
                <td>    : '.$student->admission_number.'</td>
                
            </tr>
            <tr>
                    <td>Name </td>
                    <td>    : '.$student->first_name.' '.$student->middle_name.' '.$student->last_name.' </td>

            </tr>

            <tr>
                    <td>Date </td>
                        <td>    :  '.$day_date.'</td>

            </tr> ';
        }

        $output .='
        
                </table>
            <br>
            <p style="text-decoration: underline; ">Fee transactions through the bank</p>  
                <table width="100%" style="border-collapse: collapse; border:0px;">
                        <tr>
                            <th style="border-bottom: 1px solid; border-top: 1px solid;  padding: 5px;" align="left" width="5%">#NO</th>
                            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"  >Bank Branch</th>
                            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"width="30%">Reference number</th>
                            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="20%" >Date paid</th>
                            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="15%" >Amount</th>

                            
                        </tr>
             ';
             $i = 1;
            foreach ($fee_transactions as $fee_transaction ){
               $output .='
                        <tr>
                                <td style=" padding: 5px;">'.$i++.'</td>
                                <td style=" padding: 5px;">'.$fee_transaction->branch.'</td>
                                <td style=" padding: 5px;">'.$fee_transaction->transaction_no.'</td>
                                <td style=" padding: 5px;">'.$fee_transaction->date_paid.'</td>
                                <td style=" padding: 5px;" >'.$fee_transaction->amount.'</td>
                        </tr> 
                ';
            }
            
            $output .='
                    <tr>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                    </tr>

                    <tr>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;">Total</td>
                    <td style=" padding: 5px;">'.$bank_transactions_amount.'</td>
                </tr>  
            ';

          
           $output .='
    </table>';

    
    if(!$mpesa_transactions->isEmpty()){ 

     $j = 1;
    $output .='<p style="text-decoration: underline;">Fee transactions though mpesa</p>
    <table width="100%" style="border-collapse: collapse; border:0px;">
        <tr>
            <th style="border-bottom: 1px solid; border-top: 1px solid;  padding: 5px;" align="left" width="5%">#NO</th>
            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"  >Phone Number</th>
            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"width="30%">Transaction code</th>
            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="20%" >Date paid</th>
            <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="15%" >Amount</th>

            
        </tr>
            ';
        foreach ($mpesa_transactions as $mpesa_transaction ){ 
          $output .='  <tr>
                    <td style=" padding: 5px;">'.$j++.'></td>
                    <td style=" padding: 5px;">'.$mpesa_transaction->phone_no.'</td>
                     <td style=" padding: 5px;">'.$mpesa_transaction->transaction_code.'</td>
                     <td style=" padding: 5px;">'.$mpesa_transaction->transaction_date.'</td>
                    <td style=" padding: 5px;" >'.$mpesa_transaction->amount.'</td>
            </tr>
            ';
        }
        

        $output .=' <tr>
                <td style="border-bottom: 1px solid; padding: 5px;"></td>
                <td style="border-bottom: 1px solid; padding: 5px;"></td>
                 <td style="border-bottom: 1px solid; padding: 5px;"></td>
                 <td style="border-bottom: 1px solid; padding: 5px;"></td>
                <td style="border-bottom: 1px solid; padding: 5px;"></td>
        </tr>

        <tr>
            <td style=" padding: 5px;"></td>
            <td style=" padding: 5px;"></td>
            <td style=" padding: 5px;"></td>
            <td style=" padding: 5px;">Total</td>
            <td style=" padding: 5px;">'.$mpesa_total.'</td>
        </tr> 

    </table>

'; 
    }
$output .='

<table width="100%" style="border-collapse: collapse; border:0px;">
    <tr>
        <th style="padding: 5px;" align="left" width="5%"></th>
        <th style="padding: 5px;"  align="left"  ></th>
        <th style="padding: 5px;"  align="left"width="30%"></th>
        <th style="padding: 5px;" align="left" width="20%" ></th>
        <th style="padding: 5px;" align="left" width="15%" ></th>

        
    </tr>
' ;
       foreach ($student_details as $student){ 
            
          $output .='  <tr>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;">Total fees</td>
                    <td style=" padding: 5px;">'.$student->total_fees.'</td>
            </tr>

            <tr>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;">Total amount paid</td>
                    <td style=" padding: 5px;">'.$student->amount_paid.'</td>
            </tr>

            <tr>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;">Fees balance</td>
                    <td style=" padding: 5px;">'.$student->balance.'</td>
            </tr>

            <tr>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;"></td>
                    <td style=" padding: 5px;">Overpay</td>
                    <td style=" padding: 5px;">'.$student->overpay.'</td>
            </tr>
       ';

       }

   $output .='

</table>

    <br>
    <br>
    <p>Date printed: '.$day_date.'</p>
    <p> Reference link: <a href="'.$reference_link.'" style="text-decoration: none;" target="_blank">'.$reference_link.'</a></p>
    ';



    return $output;

    }

    public function cleanStudents($class_name){
        $className = $class_name;
        $classes_names = $this->getClassStreams($class_name);

        $stream1 = $classes_names[0];
        $stream2 = $classes_names[1];

        $students = DB::table('students')
                      ->join('student_classes', 'students.id', 'student_classes.student_id')
                      ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                      ->where(function ($query) use($stream1){
                                                      $query->where('fee_balances.balance',  0)
                                                            ->where('students.status', 'active')
                                                            ->where('student_classes.stream', $stream1)
                                                            ->where('student_classes.status', 'active');
                                                  })->orWhere(function($query) use($stream2){
                                                      $query->where('fee_balances.balance',  0)
                                                            ->where('students.status', 'active')
                                                            ->where('student_classes.stream', $stream2)
                                                            ->where('student_classes.status', 'active');
                                                  })->get();
                      

        $fee_balances = DB::table('fee_balances')
                          ->get();

        
        return view('clean_students', ['class_name'=>$classes_names[2], 'students'=>$students, 'fee_balances'=>$fee_balances, 'classForm'=>$className]);
    }

    //function for doenloading list of students who have cleared school fees
    public function downloadCleanStudents(Request $request, $class_name){

        $className = $class_name;
        
        //get the full url 
        $reference_link = $request->fullUrl();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->getCleanStudentsPDF($className, $reference_link));
        return $pdf->stream();    

    }

    public function getCleanStudentsPDF($className, $reference_link){

        $classes_names = $this->getClassStreams($className);
        $stream1 = $classes_names[0];
        $stream2 = $classes_names[1];

         $students = DB::table('students')
                      ->join('student_classes', 'students.id', 'student_classes.student_id')
                      ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                      ->where(function ($query) use($stream1){
                                                      $query->where('fee_balances.balance',  0)
                                                            ->where('students.status', 'active')
                                                            ->where('student_classes.stream', $stream1)
                                                            ->where('student_classes.status', 'active');
                                                  })->orWhere(function($query) use($stream2){
                                                      $query->where('fee_balances.balance',  0)
                                                            ->where('students.status', 'active')
                                                            ->where('student_classes.stream', $stream2)
                                                            ->where('student_classes.status', 'active');
                                                  })->get();

        $fee_balances = DB::table('fee_balances')
                          ->get();
        $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg"  alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>
        <p style="text-align: center; font-size: 20px; text-decoration: underline;">List of '.$classes_names[2].' students who have cleared school fees</p>

        <br>
        ';
        $i = 1;
        $no_student = true;
        $output .='
            <table width="100%" style="border-collapse: collapse; border:0px;">
                    <tr>
                        <th style="border: 1px solid;  padding: 5px;" align="left" width="5%">#NO</th>
                        <th style="border: 1px solid; padding: 5px;"  align="left" width="10%" >ADM NO.</th>
                        <th style="border: 1px solid; padding: 5px;"  align="left"width="45%">Student name</th>
                        <th style="border: 1px solid; padding: 5px;" align="left" width="10%" >Class</th>

                        
                    </tr>
            ';
                if (!$students->isEmpty()){
                        foreach ($students as $student ){

        $output .='
                                        <tr>
                                                <td style="border: 1px solid; padding: 5px;">'. $i++.'</td>
                                                <td style="border: 1px solid; padding: 5px;">'.$student->admission_number.'</td>
                                                <td style="border: 1px solid; padding: 5px;">'.$student->first_name.'  '.$student->middle_name.'  '.$student->last_name.'</td>
                                                <td style="border: 1px solid; padding: 5px;">'.$student->class.'</td>
                                       
                                       ';
                                       $no_student = false;
                                       $output .='
                                                </tr>  
                    ';                                   
                                    
                            
                        }
                
                }

                $day_date = date("m-d-Y");
      $output .='          
        </table>  
        ';
        if($no_student && !$students->isEmpty()){
            $output .='
            <p style="color: red;"> No student has cleared school fees!!</p>
         ';
        } 

        $output .='
        <br> 
        <P>Printed on: '.$day_date.'</p>
        <p>Reference link: <a href="" style="text-decoration: none;">'.$reference_link.'</a></p>
        ';
        return $output;

    }


    public function view_reports(){

        $form1_E = DB::table('students')
                     ->join('student_classes', 'students.id', 'student_classes.student_id')
                     ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                     ->where('students.status', 'active')
                     ->where('student_classes.stream', '1E')
                     ->where('student_classes.status', 'active')
                     ->where('fee_balances.balance', 0)                                             
                     ->count();

        $form1_W = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')  
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '1W')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();

        $form2_E = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '2E')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();

        $form2_W = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')  
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '2W')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();

        $form3_W = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '3W')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();

        $form3_E = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '3E')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();


        $form4_W = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '4W')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();

        $form4_E = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '4E')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();


        //get the number of students
        $students_no = DB::table('students')
                         ->where('status', 'active')
                         ->count();

        //get percentage of students who have cleared school fees
        $cleared_fee = DB::table('students')
                         ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                         ->where('students.status', 'active')
                         ->where('fee_balances.balance', 0)
                         ->count();



        $percentage_clear = ($cleared_fee / $students_no) * 100;
        $percentage_cleared = round($percentage_clear, 2);

        //get the sum of amount collected that term
        $amount_collected = DB::table('fee_transactions')->sum('amount');

        return view('finance_reports',[
                        'form1_E'=>$form1_E,
                        'form1_W'=>$form1_W,
                        'form2_E'=>$form2_E,
                        'form2_W'=>$form2_W, 
                        'form3_E'=>$form3_E,
                        'form3_W'=>$form3_W, 
                        'form4_E'=>$form4_E,
                        'form4_W'=>$form4_W ,
                        'students_no'=>$students_no,
                        'percentage_cleared'=>$percentage_cleared,
                        'cleared_fee'=>$cleared_fee,
                        'amount_collected'=>$amount_collected

                        ]);
    }



    public function getReport(Request $request){

        //get the full url 
        $reference_link = $request->fullUrl();

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->getReportPDF($reference_link));
        return $pdf->stream();       

    }

    public function getReportPDF($reference_link){

       $form1_E = DB::table('students')
                     ->join('student_classes', 'students.id', 'student_classes.student_id')
                     ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                     ->where('students.status', 'active')
                     ->where('student_classes.stream', '1E')
                     ->where('student_classes.status', 'active')
                     ->where('fee_balances.balance', 0)                                             
                     ->count();

        $form1_W = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')  
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '1W')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();

        $form2_E = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '2E')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();

        $form2_W = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')  
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '2W')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();

        $form3_W = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '3W')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();

        $form3_E = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '3E')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();


        $form4_W = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '4W')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();

        $form4_E = DB::table('students')
                    ->join('student_classes', 'students.id', 'student_classes.student_id')
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'active')
                    ->where('student_classes.stream', '4E')
                    ->where('student_classes.status', 'active')
                    ->where('fee_balances.balance', 0)
                    ->count();


        //get the number of students
        $students_no = DB::table('students')
                         ->where('status', 'active')
                         ->count();

        //get percentage of students who have cleared school fees
        $cleared_fee = DB::table('students')
                         ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                         ->where('students.status', 'active')
                         ->where('fee_balances.balance', 0)
                         ->count();

        $percentage_clear = ($cleared_fee / $students_no) * 100;
        $percentage_cleared = round($percentage_clear, 2);

        //get the sum of amount collected that term
        $amount_collected = DB::table('fee_transactions')->sum('amount');

        $day_date = date("m-d-Y");


        $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg"  alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>
        <p style="text-align: center; font-size: 17px;">FINANCE DEPARTMENT REPORT</p>
        <p style="text-align: center; font-size: 17px; float: right;">Date : '.$day_date.'</p>

        ';
        $i = 1;
        $output .='

        <P style="font-size: 17px;">Total number of students: '.$students_no.' </P>
        <p style="font-size: 17px;">Number of students who have cleared school fees as per class stream</p>
 
  
    <table width="100%" style="border-collapse: collapse; border:0px;">
            <tr>
                <th style="border: 1px solid;  padding: 5px;" align="left" width="5%">#NO</th>
                <th style="border: 1px solid; padding: 5px;"  align="left" width="15%" >Class</th>
                <th style="border: 1px solid; padding: 5px;"  align="left"width="45%">Class stream</th>
                <th style="border: 1px solid; padding: 5px;" align="left"  >No. of students who have cleared fees</th>
 
            </tr>
 
            <tr>
                 <td style="border: 1px solid; padding: 5px;">'.$i++.' </td>
                 <td style="border: 1px solid; padding: 5px;">Form 1</td>
                 <td style="border: 1px solid; padding: 5px;">1 E</td>
                 <td style="border: 1px solid; padding: 5px;">'.$form1_E.'</td>
             </tr> 
             
             <tr>
                     <td style="border: 1px solid; padding: 5px;">'.$i++.'</td>
                     <td style="border: 1px solid; padding: 5px;">Form 1</td>
                     <td style="border: 1px solid; padding: 5px;">1 W</td>
                     <td style="border: 1px solid; padding: 5px;">'.$form1_W.'</td>
             </tr> 
 
             <tr>
                 <td style="border: 1px solid; padding: 5px;">'.$i++.'</td>
                 <td style="border: 1px solid; padding: 5px;">Form 2</td>
                 <td style="border: 1px solid; padding: 5px;">2 E</td>
                 <td style="border: 1px solid; padding: 5px;">'.$form2_E.'</td>
             </tr> 
 
             <tr>
                     <td style="border: 1px solid; padding: 5px;">'.$i++.'</td>
                     <td style="border: 1px solid; padding: 5px;">Form 2</td>
                     <td style="border: 1px solid; padding: 5px;">2 W</td>
                     <td style="border: 1px solid; padding: 5px;">'.$form2_W.'</td>
             </tr> 
 
             <tr>
                     <td style="border: 1px solid; padding: 5px;">'.$i++.' </td>
                     <td style="border: 1px solid; padding: 5px;">Form 3</td>
                     <td style="border: 1px solid; padding: 5px;">3 E</td>
                     <td style="border: 1px solid; padding: 5px;">'.$form3_E.'</td>
             </tr> 
                 
                 <tr>
                         <td style="border: 1px solid; padding: 5px;">'.$i++.'</td>
                         <td style="border: 1px solid; padding: 5px;">Form 3</td>
                         <td style="border: 1px solid; padding: 5px;">3 W</td>
                         <td style="border: 1px solid; padding: 5px;">'.$form3_W.'</td>
                 </tr> 
     
                 <tr>
                     <td style="border: 1px solid; padding: 5px;">'.$i++.'</td>
                     <td style="border: 1px solid; padding: 5px;">Form 4</td>
                     <td style="border: 1px solid; padding: 5px;">4 E</td>
                     <td style="border: 1px solid; padding: 5px;">'.$form4_E.'</td>
                 </tr> 
     
                 <tr>
                         <td style="border: 1px solid; padding: 5px;">'.$i++.'</td>
                         <td style="border: 1px solid; padding: 5px;">Form 4</td>
                         <td style="border: 1px solid; padding: 5px;">4 W</td>
                         <td style="border: 1px solid; padding: 5px;">'.$form4_W.'</td>
                 </tr> 
    </table>   
 
    <br>
    
    <p style="font-size: 17px;">Total number of students who have completed fee: '.$cleared_fee.'</p>
    <p style="font-size: 17px;">Percentage of students who have completed fee: '.$percentage_cleared.' %</p>
    <p style="font-size: 17px;">Total amount collected: '.$amount_collected.'</p>
    ';

    $output .='
        <br> 
        <P style="font-size: 17px;">Printed on: '.$day_date.'</p>
        <p style="font-size: 17px;">Reference link: <a href="" style="text-decoration: none;">'.$reference_link.'</a></p>
        ';

    return $output;
    }

    public function getClassStreams($class_name){

        $stream1;
        $stream2;
        $classForm;

        if($class_name == "form1"){
            $stream1 = "1E";
            $stream2 = "1W";
            $classForm = "Form 1";
        } else if($class_name == "form2"){
            $stream1 = "2E";
            $stream2 = "2W";
            $classForm = "Form 2";
        } else if($class_name == "form3"){
            $stream1 = "3E";
            $stream2 = "3W";
            $classForm = "Form 3";
        } else if($class_name == "form4"){
            $stream1 = "4E";
            $stream2 = "4W";
            $classForm = "Form 4";
        }

        return array($stream1, $stream2, $classForm);
    }
   

    //function for getting the class
    public function getClassForm($className){

        if($className == "1W" || $className == "1E"){
            $classForm = "Form 1";
        } else if($className == "2W" || $className == "2E"){
            $classForm = "Form 2";
        } else if($className == "3W" || $className == "3E"){
            $classForm = "Form 3"; 
        } else if($className == "4W" || $className == "4E"){
            $classForm = "Form 4";
        } else{
            $classForm = null;
        }

        return $classForm;
    }



    //handling alumni or students who have finished school
    public function takeFeesForAlumni(){

        //get the alumni students
        $alumni = DB::table('students')
                    ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                    ->where('students.status', 'cleared')
                    ->whereNotNull('students.date_left')
                    ->get();

                    

        return view('alumni.take_fees', ['alumni'=>$alumni]);
    }


    //function for displaying fee input form for alumni
    public function alumni_fee_input_form(Request $request, $student_id){
         //get the student id
         $id = $student_id;

         //get the fee balance
         $fee_details = DB::table('fee_balances')
                          ->select('balance')
                          ->where('student_id', $id)
                          ->get();
 
         $fee_balance = null;
         if(!$fee_details->isEmpty()){
             foreach($fee_details as $details){
                 $fee_balance = $details->balance;
             }
         }
 
         //get the student details
         $student_details = DB::table('students')
                              ->where('id', $id)
                              ->where('status', 'cleared')
                              ->get();
         if(!$student_details->isEmpty()){
             foreach($student_details as $student){
                 $student_name = $student->first_name.' '. $student->middle_name.' '.$student->last_name;
                
                 $adm_no = $student->admission_number;                 
                
             }
         } else{
             return 'Error!! The student does not exist';
         }
 
         //return view that has the fee form
         return view('alumni.alumni_input_fee_form', ['id'=>$id, 'student_name'=>$student_name, 'adm_no'=>$adm_no, 'fee_balance'=>$fee_balance, 'is_alumni'=>'student is alumni']);
    
    }

    //function for showing the alumi details for purpose of fee statements
    public function alumniFeeStatement(Request $request){
    

        //select all students in the class
        $alumni = DB::table('students')
                      ->whereNotNull('date_left')
                      ->where('status', 'cleared')
                      ->get();
                      
        //return view
        return view('alumni.alumni_fee_statements', ['alumni'=>$alumni]);

    }

    //function for viewing alumni fee statement
    public function viewAlumniFeeStatement($student_id){

        $is_alumni = "is alumni";
        $studentID = $student_id;

       return $this->viewFeeStatement($is_alumni, $studentID);
    }
}
