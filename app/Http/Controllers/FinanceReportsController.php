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
        $sum = 0;
        $date_from = "";
        $date_to = "";

        return view('reports.fee_transactions', ['transactions'=>$transactions, 'sum'=>$sum, 'date_from'=>$date_from, 'date_to'=>$date_to]);

    }

    public function getReport(Request $request){

        //get the dates 
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        //query to get data

        $transactions = DB::table('fee_transactions')
                          ->whereBetween('date_paid', [$date_from, $date_to])
                          ->orderBy('date_paid', 'Asc')
                          ->get();

        $sum = DB::table('fee_transactions')
                          ->whereBetween('date_paid', [$date_from, $date_to])
                          ->sum('amount');

        if($transactions->isEmpty()){
            $request->session()->flash('no_reports', 'There are no fee transactions record as from the date '.$date_from.' to date '.$date_to);
        }


        return view('reports.fee_transactions', ['transactions'=>$transactions, 'sum'=>$sum, 'date_from'=>$date_from, 'date_to'=>$date_to]);
    }

    public function downloadReport($date_from, $date_to){


        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->getReportPDF($date_from, $date_to));
        return $pdf->stream();

    }

    public function getReportPDF($date_from, $date_to){

        //query to get data

        $transactions = DB::table('fee_transactions')
                          ->whereBetween('date_paid', [$date_from, $date_to])
                          ->orderBy('date_paid', 'Asc')
                          ->get();

        $sum = DB::table('fee_transactions')
                          ->whereBetween('date_paid', [$date_from, $date_to])
                          ->sum('amount');

        $current_date = date("Y-m-d");
         $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg" alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>
        <h3 style="text-align:center; text-decoration: underline;">Fee transactions report as from date '.$date_from.' to date '.$date_to.' </h3>
        <p style="float: right;"> Printed on: '.$current_date.' </p>
        ';

        $output .='
        
                </table>
            <br>
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

             foreach ($transactions as $fee_transaction ){
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
     ';

     $output .='
     <tr>
                     <td style="border-bottom: 1px solid; padding: 5px;" colspan="4" align="right">Total</td>
                     <td style="border-bottom: 1px solid; padding: 5px;">'.$sum.'</td>
             </tr>

             </table>
     ';

        return $output;

    }
}
