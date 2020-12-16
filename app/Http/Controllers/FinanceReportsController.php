<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceReportsController extends Controller
{
    //

    public function showForm(){
        //assign arbitrary value to transactions variable
        $transactions = DB::table('fee_transactions')->where('id', '8765rfghg')->get();
        $mpesa_transactions = DB::table('mpesa_transactions')->where('transaction_id', '8765rfghg')->get();
        $bank_total = 0;
        $mpesa_total = 0;
        $date_from = "";
        $date_to = "";
        $transaction_type = "";

        return view('reports.fee_transactions', [
            'transactions'=>$transactions,
            'sum'=>$bank_total,
            'mpesa_transactions'=>$mpesa_transactions,
            'mpesa_total'=>$mpesa_total,
            'date_from'=>$date_from,
            'date_to'=>$date_to,
            'transaction_type'=>$transaction_type
            ]);
    }

    public function getReport(Request $request){

        //get the dates  and transaction types
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
        $transaction_type = $request->input('transaction_type');

        if($transaction_type == "all"){
            //handle for both mpesa transactions and bank transactions
             $mpesa_transactions = DB::table('mpesa_transactions')
                                ->whereBetween('transaction_date', [$date_from, $date_to])
                                ->orderBy('transaction_date', 'Asc')
                                ->get();

            $mpesa_total = DB::table('mpesa_transactions')
                    ->whereBetween('transaction_date', [$date_from, $date_to])
                    ->sum('amount');

             $transactions = DB::table('fee_transactions')
                                ->whereBetween('date_paid', [$date_from, $date_to])
                                ->orderBy('date_paid', 'Asc')
                                ->get();

            $bank_total = DB::table('fee_transactions')
                    ->whereBetween('date_paid', [$date_from, $date_to])
                    ->sum('amount');

            if($mpesa_transactions->isEmpty() && $transactions->isEmpty()){
                $request->session()->flash('no_reports', 'There are neither bank nor mpesa transactions records as from the date '.$date_from.' to date '.$date_to);
            }

            if($transactions->isEmpty()){
                $request->session()->flash('no_bank_transactions', 'There are no bank transactions record as from the date '.$date_from.' to date '.$date_to);
            }

            if($mpesa_transactions->isEmpty()){
                $request->session()->flash('no_mpesa_transactions', 'There are no mpesa transactions record as from the date '.$date_from.' to date '.$date_to);
            }



            return view('reports.fee_transactions', [
                'transactions'=>$transactions,
                'sum'=>$bank_total,
                'mpesa_transactions'=>$mpesa_transactions,
                'mpesa_total'=>$mpesa_total,
                'date_from'=>$date_from,
                'date_to'=>$date_to,
                'transaction_type'=>$transaction_type
                ]);

        } 

        if($transaction_type == "bank transactions"){
            //handle for bank transactions
            $transactions = DB::table('fee_transactions')
                                ->whereBetween('date_paid', [$date_from, $date_to])
                                ->orderBy('date_paid', 'Asc')
                                ->get();

            $bank_total = DB::table('fee_transactions')
                    ->whereBetween('date_paid', [$date_from, $date_to])
                    ->sum('amount');

            $mpesa_transactions = DB::table('mpesa_transactions')->where('transaction_id', 'hgyu')->get();
            $mpesa_total = DB::table('mpesa_transactions')->where('transaction_id', 'hgyu')->sum('amount');
            

            if($transactions->isEmpty()){
                $request->session()->flash('no_reports', 'There are no bank transactions record as from the date '.$date_from.' to date '.$date_to);
            }


            return view('reports.fee_transactions', [
                'transactions'=>$transactions,
                'sum'=>$bank_total,
                'mpesa_transactions'=>$mpesa_transactions,
                'mpesa_total'=>$mpesa_total,
                'date_from'=>$date_from,
                'date_to'=>$date_to,
                'transaction_type'=>$transaction_type
                ]);
    

        }

        if($transaction_type == "mpesa transactions"){
            //handle for mpesa transactions
             $mpesa_transactions = DB::table('mpesa_transactions')
                                ->whereBetween('transaction_date', [$date_from, $date_to])
                                ->orderBy('transaction_date', 'Asc')
                                ->get();

            $mpesa_total = DB::table('mpesa_transactions')
                    ->whereBetween('transaction_date', [$date_from, $date_to])
                    ->sum('amount');

            $transactions = DB::table('fee_transactions')->where('id', 'hgyu')->get();
            $bank_total = DB::table('fee_transactions')->where('id', 'hgyu')->sum('amount');
            

            if($mpesa_transactions->isEmpty()){
                $request->session()->flash('no_reports', 'There are no mpesa transactions record as from the date '.$date_from.' to date '.$date_to);
            }


            return view('reports.fee_transactions', [
                'transactions'=>$transactions,
                'sum'=>$bank_total,
                'mpesa_transactions'=>$mpesa_transactions,
                'mpesa_total'=>$mpesa_total,
                'date_from'=>$date_from,
                'date_to'=>$date_to,
                'transaction_type'=>$transaction_type
                ]);

        }

        

        if($transactions->isEmpty()){
            $request->session()->flash('no_reports', 'There are no fee transactions record as from the date '.$date_from.' to date '.$date_to);
        }


        return view('reports.fee_transactions', ['transactions'=>$transactions, 'sum'=>$sum, 'date_from'=>$date_from, 'date_to'=>$date_to]);
    }

    public function downloadReport($date_from, $date_to, $transaction_type){


        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->getReportPDF($date_from, $date_to, $transaction_type));
        return $pdf->stream();

    }

    public function getReportPDF($date_from, $date_to, $transaction_type){

        //query to get data

        
        if($transaction_type == "all"){
            //handle for both mpesa transactions and bank transactions
             $mpesa_transactions = DB::table('mpesa_transactions')
                                ->whereBetween('transaction_date', [$date_from, $date_to])
                                ->orderBy('transaction_date', 'Asc')
                                ->get();

            $mpesa_total = DB::table('mpesa_transactions')
                    ->whereBetween('transaction_date', [$date_from, $date_to])
                    ->sum('amount');

             $transactions = DB::table('fee_transactions')
                                ->whereBetween('date_paid', [$date_from, $date_to])
                                ->orderBy('date_paid', 'Asc')
                                ->get();

            $bank_total = DB::table('fee_transactions')
                    ->whereBetween('date_paid', [$date_from, $date_to])
                    ->sum('amount');

           

        } 

        if($transaction_type == "bank transactions"){
            //handle for bank transactions
            $transactions = DB::table('fee_transactions')
                                ->whereBetween('date_paid', [$date_from, $date_to])
                                ->orderBy('date_paid', 'Asc')
                                ->get();

            $bank_total = DB::table('fee_transactions')
                    ->whereBetween('date_paid', [$date_from, $date_to])
                    ->sum('amount');


            $mpesa_transactions = DB::table('mpesa_transactions')->where('transaction_id', 'hgyu')->get();
            $mpesa_total = DB::table('mpesa_transactions')->where('transaction_id', 'hgyu')->sum('amount');          
 

        }

        if($transaction_type == "mpesa transactions"){
            //handle for mpesa transactions
             $mpesa_transactions = DB::table('mpesa_transactions')
                                ->whereBetween('transaction_date', [$date_from, $date_to])
                                ->orderBy('transaction_date', 'Asc')
                                ->get();

            $mpesa_total = DB::table('mpesa_transactions')
                    ->whereBetween('transaction_date', [$date_from, $date_to])
                    ->sum('amount');

            $transactions = DB::table('fee_transactions')->where('id', 'hgyu')->get();
            $bank_total = DB::table('fee_transactions')->where('id', 'hgyu')->sum('amount');
           

        }

        

        $current_date = date("Y-m-d");
         $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg" alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>
        <p style="float: right;"> Printed on: '.$current_date.' </p>
        
        ';

        //handle for both bank and mpesa transactions

        if($transaction_type == "all"){

            if(!$transactions->isEmpty()){

                        $output .='
                
                        <p style="text-decoration: underline; font-size: 18px;">Report of fee transactions via bank as from '.$date_from.' to '.$date_to.'</p>
                
                        </table>
                    
                        <table width="100%" style="border-collapse: collapse; border:0px;">
                                <tr>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid;  padding: 5px;" align="left" width="5%">#NO</th>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"  >Bank Branch</th>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"width="30%">Reference number</th>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="20%" >Transaction date</th>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="right" width="15%" >Amount</th>

                                    
                                </tr>
                    ';
                    $i = 1;

                    foreach ($transactions as $fee_transaction ){
                        $output .='
                                <tr>
                                        <td style=" padding: 5px;">'.$i++.'</td>
                                        <td style=" padding: 5px;">'.$fee_transaction->branch.'</td>
                                        <td style=" padding: 5px;">'.$fee_transaction->transaction_no.'</td>
                                        <td style=" padding: 5px;">'.$fee_transaction->date_paid.'</td>
                                        <td style=" padding: 5px;" align="right" >'.number_format($fee_transaction->amount, 2).'</td>
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
                    ';

                    $output .='
                         <tr>
                                    <td style="border-bottom: 1px solid; padding: 5px;" colspan="4" align="right">Total</td>
                                    <td style="border-bottom: 1px solid; padding: 5px;" align="right">'.number_format($bank_total, 2).'</td>
                            </tr>

                            </table>
                            <br>
                    ';

            } else{
                $output .= '
                <p style="color: red; font-size: 20px;">There are no bank transactions as from date '.$date_form.' to  date '.$date_to.'</p>
                ';
            }

            if(!$mpesa_transactions->isEmpty()){
              
                   $output .='
                
                        <p style="text-decoration: underline; font-size: 18px;">Report of fee transactions via mpesa as from '.$date_from.' to '.$date_to.'</p>
                
                        </table>
                    
                        <table width="100%" style="border-collapse: collapse; border:0px;">
                                <tr>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid;  padding: 5px;" align="left" width="5%">#NO</th>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"  >Phone number</th>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left">Transaction code</th>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left"  >Transaction date</th>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="right" width="15%" >Amount</th>

                                    
                                </tr>
                    ';
                    $j = 1;

                    foreach ($mpesa_transactions as $mpesaTransaction ){
                        $output .='
                                <tr>
                                        <td style=" padding: 5px;">'.$j++.'</td>
                                        <td style=" padding: 5px;">'.$mpesaTransaction->phone_no.'</td>
                                        <td style=" padding: 5px;">'.$mpesaTransaction->transaction_code.'</td>
                                        <td style=" padding: 5px;">'.$mpesaTransaction->transaction_date.'</td>
                                        <td style=" padding: 5px;" align="right" >'.number_format($mpesaTransaction->amount, 2).'</td>
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
                    ';

                    $output .='
                         <tr>
                                    <td style="border-bottom: 1px solid; padding: 5px;" colspan="4" align="right">Total</td>
                                    <td style="border-bottom: 1px solid; padding: 5px;" align="right">'.number_format($mpesa_total, 2).'</td>
                            </tr>

                            </table>
                    ';
            } else{
                $output .= '
                <p style="color: red; font-size: 20px;">There are no mpesa transactions as from date '.$date_form.' to  date '.$date_to.'</p>
                ';
            }

            return $output;
        }


        //handle for only bank transactions
        if($transaction_type == "bank transactions"){

             if(!$transactions->isEmpty()){

                        $output .='
                
                        <p style="text-decoration: underline; font-size: 18px;">Report of fee transactions via bank as from '.$date_from.' to '.$date_to.'</p>
                
                        </table>
                    
                        <table width="100%" style="border-collapse: collapse; border:0px;">
                                <tr>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid;  padding: 5px;" align="left" width="5%">#NO</th>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"  >Bank Branch</th>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"width="30%">Reference number</th>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="20%" >Transaction date</th>
                                    <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="right" width="15%" >Amount</th>

                                    
                                </tr>
                    ';
                    $i = 1;

                    foreach ($transactions as $fee_transaction ){
                        $output .='
                                <tr>
                                        <td style=" padding: 5px;">'.$i++.'</td>
                                        <td style=" padding: 5px;">'.$fee_transaction->branch.'</td>
                                        <td style=" padding: 5px;">'.$fee_transaction->transaction_no.'</td>
                                        <td style=" padding: 5px;">'.$fee_transaction->date_paid.'</td>
                                        <td style=" padding: 5px;" align="right" >'.number_format($fee_transaction->amount, 2).'</td>
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
                    ';

                    $output .='
                         <tr>
                                    <td style="border-bottom: 1px solid; padding: 5px;" colspan="4" align="right">Total</td>
                                    <td style="border-bottom: 1px solid; padding: 5px;" align="right">'.number_format($bank_total, 2).'</td>
                            </tr>

                            </table>
                    ';

            } else{
                $output .= '
                <p style="color: red; font-size: 20px;">There are no bank transactions as from date '.$date_form.' to  date '.$date_to.'</p>
                ';
            }

            return $output;

        }

        //handle for only mpesa transactions

        if($transaction_type == "mpesa transactions"){

            if(!$mpesa_transactions->isEmpty()){
              
                $output .='
             
                     <p style="text-decoration: underline; font-size: 18px;">Report of fee transactions via mpesa as from '.$date_from.' to '.$date_to.'</p>
             
                     </table>
                 
                     <table width="100%" style="border-collapse: collapse; border:0px;">
                             <tr>
                                 <th style="border-bottom: 1px solid; border-top: 1px solid;  padding: 5px;" align="left" width="5%">#NO</th>
                                 <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"  >Phone number</th>
                                 <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;"  align="left"width="30%">Transaction code</th>
                                 <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="left" width="20%" >Transaction date</th>
                                 <th style="border-bottom: 1px solid; border-top: 1px solid; padding: 5px;" align="right" width="15%" >Amount</th>

                                 
                             </tr>
                 ';
                 $j = 1;

                 foreach ($mpesa_transactions as $mpesaTransaction ){
                     $output .='
                             <tr>
                                     <td style=" padding: 5px;">'.$j++.'</td>
                                     <td style=" padding: 5px;">'.$mpesaTransaction->phone_no.'</td>
                                     <td style=" padding: 5px;">'.$mpesaTransaction->transaction_code.'</td>
                                     <td style=" padding: 5px;">'.$mpesaTransaction->transaction_date.'</td>
                                     <td style=" padding: 5px;" align="right" >'.number_format($mpesaTransaction->amount, 2).'</td>
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
                 ';

                 $output .='
                      <tr>
                                 <td style="border-bottom: 1px solid; padding: 5px;" colspan="4" align="right">Total</td>
                                 <td style="border-bottom: 1px solid; padding: 5px;" align="right">'.number_format($mpesa_total, 2).'</td>
                         </tr>

                         </table>
                 ';
         } else{
             $output .= '
             <p style="color: red; font-size: 20px;">There are no mpesa transactions as from date '.$date_form.' to  date '.$date_to.'</p>
             ';
         }

         return $output;
        }

       

        return $output;

    }
}
