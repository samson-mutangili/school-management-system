<?php

namespace App\Http\Controllers;

use App\MpesaTransaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Transactions extends Controller
{

    


    /**
     * Lipa na M-PESA password
     * */
    public function Password()
    {
        $lipa_time = Carbon::rawParse('now')->format('YmdHms');
        $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $BusinessShortCode = 174379;
        $timestamp =$lipa_time;
        $lipa_na_mpesa_password = base64_encode($BusinessShortCode.$passkey.$timestamp);
        return $lipa_na_mpesa_password;
    }


    /**
     * Lipa na M-PESA STK Push method
     * */
    public function customerSTKPush(Request $request)
    {

        //get the parent id
        $parent_id = $request->input('parent_id');

        //get the details from the form
        $student_id = $request->input('student_id');
        $adm_no = $request->input('adm_no');
        $phone_no = $request->input('phone_no');
        $amount = $request->input('amount');

        // // //store parentID and student id in flash session
        // $request->session()->put('ParentID' , $parent_id);
        // $request->session()->put('StudentID' , $student_id);

        //edit the phone number
         $user_input = $phone_no;
         //remove the 0
         $trimmed_input = ltrim($user_input, $user_input[0]);
         //add 254
         $final_phone_no = substr_replace($trimmed_input, '254', 0, 0);
 
        
        try {
            //normal flow
            $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
            $curl_post_data = [
                //Fill in the request parameters with valid values
                'BusinessShortCode' => 174379,
                'Password' => $this->Password(),
                'Timestamp' => Carbon::rawParse('now')->format('YmdHms'),
                'TransactionType' => 'CustomerPayBillOnline',
                'Amount' => $amount,
                'PartyA' => $final_phone_no, // your phone number
                'PartyB' => 174379,
                'PhoneNumber' => $final_phone_no, //  your phone number
                'CallBackURL' => 'https://42dd75772783.ngrok.io/api/school/stk/push/callback/url',
                'AccountReference' => $adm_no,
                'TransactionDesc' => "Pay school fees through mpesa"
            ];
            $data_string = json_encode($curl_post_data);
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->generateAccessToken($parent_id, $student_id)));
            
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            $curl_response = curl_exec($curl);

            $decode_response = json_decode($curl_response);

            if(isset($decode_response->ResponseCode)){
                $ResponseCode = $decode_response->ResponseCode;
                 if($ResponseCode == '0'){
                     //insert partially into db
                     $insert_data = DB::table('mpesa_transactions')
                                        ->insert([
                                            'student_id'=>$student_id,
                                            'parent_id'=>$parent_id
                                        ]);
                 }

                 
                return redirect('/parent/child/'.$parent_id.','.$student_id);
       
            }

            if(isset($decode_response->errorCode)){
                $error_message = $decode_response->errorMessage;
                 //inform user of error
                return redirect('/parent/child/'.$parent_id.','.$student_id);
       
            }

            
            
            // return $curl_response;


        } catch (Exception $ex) {
            //inform user of error
            // $request->session()->flash('error_occured', 'An error occured. '.$ex->getMessage());
            return redirect('/parent/child/'.$parent_id.','.$student_id);
        }
        
    }

    //
    public function generateAccessToken($parent_id, $student_id)
    {

        try {
            //normal flow
            $consumer_key="uaR4QQEIuoR01AHLIBvWqJPsdI0rqV72";
            $consumer_secret="zANVt17IDKhHqbRI";
            $credentials = base64_encode($consumer_key.":".$consumer_secret);
    
            $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials, "Content-Type:application/json"));
            curl_setopt($curl, CURLOPT_HEADER,false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);
    
            $access_token=json_decode($curl_response);
            return $access_token->access_token;

        } catch (Exception $ex) {
             //inform user of error
             $request->session()->flash('error_occured', 'An error occured. '.$ex->getMessage());
             return redirect('/parent/child/'.$parent_id.','.$student_id);
        
        }
       
    }


    /**
     * J-son Response to M-pesa API feedback - Success or Failure
     */
    public function createValidationResponse($result_code, $result_description){
        $result=json_encode(["ResultCode"=>$result_code, "ResultDesc"=>$result_description]);
        $response = new Response();
        $response->headers->set("Content-Type","application/json; charset=utf-8");
        $response->setContent($result);
        return $response;
    }
    /**
     *  M-pesa Validation Method
     * Safaricom will only call your validation if you have requested by writing an official letter to them
     */
    public function Validation(Request $request)
    {
        $result_code = "0";
        $result_description = "Accepted validation request.";
        return $this->createValidationResponse($result_code, $result_description);
    }
    /**
     * M-pesa Transaction confirmation method, we save the transaction in our databases
     */
    public function Confirmation(Request $request)
    {
       try {

        // $parent_id = $request->session()->get('ParentID');
        // $student_id = $request->session()->get('StudentID');


           //normal flow of execution
            // $content=json_decode($request->getContent());
            $content=$request->getContent();   

            $content_data = json_decode($content, true);

            $result_code = $content_data['Body']['stkCallback']['ResultCode'];

            //check if result code is 0, for success, else handle the errors
            if($result_code == '0'){

                
                //get the details of the transaction
                $items = $content_data['Body']['stkCallback']['CallbackMetadata']['Item'];

                $total_amount = 0;
                $receipt_number = "";
                $phone_no = "";
                $i = 1;
                foreach($items as $anItem){
                    foreach($anItem as $key=>$val){
                        if($i == 1){
                            if($key == 'Name')
                            {
                                
                            }
                            if($key == 'Value'){
                                $total_amount = $val;
                            }
                        }
    
                        if($i == 2){
                            if($key == 'Name')
                            {
                                
                            }
                            if($key == 'Value'){
                                $receipt_number = $val;
                            }
                        }
    
                        if($i == 5){
                            if($key == 'Name')
                            {
                                
                            }
                            if($key == 'Value'){
                                $phone_no = $val;
                            }
                        }
    
                    
                    }
                    $i++;
    
                }

                $parent_id = 1;
                $student_id = 1;

                $get_details = DB::table('mpesa_transactions')
                                ->where('amount', null)
                                ->get();

                if(!$get_details->isEmpty()){
                    foreach($get_details as $detail){
                        $student_id = $detail->student_id;
                        $parent_id = $detail->parent_id;
                    }
                }

                //save the data into the database
                $save_transaction = DB::table('mpesa_transactions')
                                      ->where('amount', null)
                                      ->update([
                                          'transaction_code'=>$receipt_number,
                                          'phone_no'=>$phone_no,
                                          'transaction_date'=>now(),
                                          'amount'=>$total_amount,
                                          'created_at'=>now(),
                                          'updated_at'=>now()
                                      ]);

                            
            
    
                // $response = new Response();
                // $response->headers->set("Content-Type","text/xml; charset=utf-8");
                // $response->setContent(json_encode(["C2BPaymentConfirmationResult"=>"Success"]));
                // return $response;

                if($save_transaction == 1){
                    //set success message in flash session
                    //$request->session()->flash('transaction_successful', 'Fee transaction was successful');

                    //update the student fees
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

                            $total_new_paid = $old_paid + $total_amount;
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

                    }


                    return redirect('/parent/child/'.$parent_id.','.$student_id); 

                }


            } else{
                // //handle errors
                // if($result_code == '1037'){
                //     $request->session()->flash('time_out', 'Transaction took longer than expected!! Time out!!');
                // } else if($result_code == '1032'){
                //     $request->session()->flash('cancelled_by_user', 'The transaction was canclelled by user!');
                // } else if($result_code == '2001'){
                //     $request->session()->flash('invalid_password', 'User entered invalid password!');
                // } else{
                //     //get the error message
                //     $errorCode = $content_data['Body']['stkCallback']['errorCode'];

                //     $errorMessage = $content_data['Body']['stkCallback']['errorMessage'];

                //     $request->session()->flash('general_error', 'An error occured. Error code : '.$errorCode.' Error description : '.$errorMessage);
                // }

                $delete_null_values = DB::table('mpesa_transactions')
                                        ->where('amount', null)
                                        ->delete();

                return redirect('/parent/child/'.$parent_id.','.$student_id); 

            }

           
       } catch (Exception $ex) {
             //inform user of error
            //  $request->session()->flash('error_occured', 'An error occured. '.$ex->getMessage());
             return redirect('/parent/child/'.$parent_id.','.$student_id); 
       }

      //  return "Result code is : ".$result_code." and amount is: ".$total_amount;
        // $amount = $content_data->Body->stkCallback->CallbackMetadata->Item->Name->{'Amount'}->Value;
        // $phone_no = $content_data->Body->stkCallback->CallbackMetadata->Item->Name->{'PhoneNumber'}->Value;
        // $receipt_number = $content_data->Body->stkCallback->CallbackMetadata->Item->Name->{'MpesaReceiptNumber'}->Value;


        // foreach($content_data as $key=>$value){

        //     if(!is_array($value)){

        //     } else{
        //         foreach($value as $key=>$val){
        //             if(!is_array($val)){

        //             } else{
        //                 foreach($val as $con=>$va){
                            
        //                     //get metadata call back items
        //                     if(is_array($con)){
        //                         foreach($con as $i=>$j){
        //                             $fourth = "done";
        //                             if($i->Name == "PhoneNumber"){
        //                                 $got = "yes";
        //                                 $phone_no = $j->value;
        //                             }
        //                         }

        //                     }
        //                 }
        //             }
        //         }
        //     }

            
        // }

       

       // print_r( "the body is : ".$content_data['Body']);
      //  return 'Result code is : '.$result_code.' \n Amount is: '.$total_amount.' \n Phone number is : '.$phone_no.' \n receipt number is : '.$receipt_number;
 
        // $mpesa_transaction = new MpesaTransaction();
        // $mpesa_transaction->TransactionType = $content->TransactionType;
        // $mpesa_transaction->TransID = $content->TransID;
        // $mpesa_transaction->TransTime = $content->TransTime;
        // $mpesa_transaction->TransAmount = $content->TransAmount;
        // $mpesa_transaction->BusinessShortCode = $content->BusinessShortCode;
        // $mpesa_transaction->BillRefNumber = $content->BillRefNumber;
        // $mpesa_transaction->InvoiceNumber = $content->InvoiceNumber;
        // $mpesa_transaction->OrgAccountBalance = $content->OrgAccountBalance;
        // $mpesa_transaction->ThirdPartyTransID = $content->ThirdPartyTransID;
        // $mpesa_transaction->MSISDN = $content->MSISDN;
        // $mpesa_transaction->FirstName = $content->FirstName;
        // $mpesa_transaction->MiddleName = $content->MiddleName;
        // $mpesa_transaction->LastName = $content->LastName;

        // $mpesa_transaction->save();

        // $save_data = DB::table('mpesa_transactions')
        //                ->insert([
        //                 'TransactionType'=>$content->TransactionType,
        //                 'TransID'=>$content->TransID,
        //                 'TransTime'=>$content->TransTime,
        //                 'TransAmount'=>$content->TransAmount,
        //                 'BusinessShortCode'=>$content->BusinessShortCode,
        //                 'BillRefNumber'=>$content->BillRefNumber,
        //                 'InvoiceNumber'=>$content->InvoiceNumber,
        //                 'OrgAccountBalance'=>$content->OrgAccountBalance,
        //                 'ThirdPartyTransID'=>$content->ThirdPartyTransID,
        //                 'MSISDN'=>$content->MSISDN,
        //                 'FirstName'=>$content->FirstName,
        //                 'MiddleName'=>$content->MiddleName,
        //                 'LastName'=>$content->LastName,
        //                 'response'=>'hello',
        //                 'created_at'=>now(),
        //                 'updated_at'=>now()               
        //                ]);
        // Responding to the confirmation request


        // $response = $request->getContent();
        // $save = DB::table('mpesa_transactions')
        //             ->insert([
        //                 'response'=>json_encode($response)
        //             ]);
        
    }


    /**
     * M-pesa Register Validation and Confirmation method
     */
    public function RegisterUrls()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl');
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: Bearer '. $this->generateAccessToken()));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(array(
            'ShortCode' => "600141",
            'ResponseType' => 'Completed',
            'ConfirmationURL' => "https://f1059c3c735d.ngrok.io/api/v1/transaction/confirmation",
            'ValidationURL' => "https://f1059c3c735d.ngrok.io/api/v1/validation"
        )));
        $curl_response = curl_exec($curl);
        echo $curl_response;
    }
}
