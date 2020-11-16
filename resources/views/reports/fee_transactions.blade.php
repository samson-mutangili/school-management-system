@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Fees Transactions Reports</h1>
    </div>
</div>
<?php $i = 1; ?>
<div class="panel panel-default w-auto">
<div class="panel-heading">
  
</div>
   <div class="panel-body">
        
    <h4 style="text-align: center; margin-bottom: 20px; text-decoration: underline;">Filter reports by date and transaction type</h4>

    <form action="/finance_department/fee_tansactions/get_report" method="post" class="form-horizontal" name="report_filter_form">

        
        @csrf
<input type="hidden" name="current_date" value="{{date('Y-m-d')}}" />

        <div class="row">

            <div class="col-md-4 col-lg-3 col-xl-3">
                    <div class="form-group row" id="date_from_div">
                     
                            <label class="col-lg-3  col-xl-3 col-md-3  control-label" for="Old">Date From</label>
                    
                         <div class="col-lg-9 col-xl-9 col-md-9">
                             <input type="date" class="form-control" id="date_from" name="date_from" placeholder="Date from" required />
                             <div id="date_from_error"></div>
                         </div>
                  </div>

            </div>

            <div class="col-md-4 col-lg-3 col-xl-3">
                    <div class="form-group row" id="date_to_div">
                     
                            <label class="col-lg-3  col-xl-3 col-md-3  control-label" style="valign: center;" for="date_to">Date To</label>
                    
                         <div class="col-lg-9 col-xl-9 col-md-9">
                             <input type="date" class="form-control" id="date_to" name="date_to" placeholder="Date to" required />
                             <div id="date_to_error"></div>
                         </div>
                  </div>

            </div>

            <div class="col-md-4 col-lg-4 col-xl-4">
                <div class="form-group row" id="date_to_div">
                 
                        <label class="col-lg-4  col-xl-4 col-md-4  control-label" style="valign: center;" for="date_to">Transactions type</label>
                
                     <div class="col-lg-8 col-xl-8 col-md-8">
                         <select class="form-control" name="transaction_type" id="transaction_type" required>
                             <option value=""></option>
                             <option value="all">All transactions</option>
                             <option value="bank transactions">Bank transactions</option>
                             <option value="mpesa transactions">Mpesa transactions</option>
                         </select>
                         <div id="transaction_type_error"></div>
                     </div>
              </div>

        </div>

            <div class="col-md-2 col-lg-2 col-xl-2">
                <button type="submit" name="submit" class="btn btn-success" onclick=" return validateDates()">Get report</button>

            </div>

        </div>

        
  

    </form>

     <div style="margin-top: 20px;">
        @if (Session::get('no_reports') != "")
            <p style="color: red; font-size: 20px;">{{ Session::get('no_reports')}}</p>
        @endif
    </div>

    <!-- view report data-->
    @if($transaction_type == "all")

        @if (!$transactions->isEmpty())

        <a target="_blank" href="/finance_department/fee_transactions/reports/download/{{$date_from}},{{$date_to}},{{$transaction_type}}"    style="float: right; margin-top: 5px; margin-bottom: 5px;"><i class="fa fa-download"></i>Download report</a>

    
        
            <br>
        <p style="text-decoration: underline; font-size: 20px;">Report of fee transactions via bank as from {{$date_from}} to {{$date_to}}</p>
        
        <table class="table table-hover table-responsive-sm table-responsive-md responsive-lg table-responsive-xl " id="fee_reports_table">
                <thead class="active">
                    <th width="5%">#NO</th>
                    <th>Bank branch</th>
                    <th>Reference Number</th>
                    <th>Transaction date</th>
                    <th>Amount</th>
                </thead>

                <tbody>

                        @foreach ($transactions as $transaction)
                            <tr >
                                <td>{{$i++}}</td>                            
                                <td>{{$transaction->branch}} </td>

                                <td>{{$transaction->transaction_no}}</td>
                                <td>{{$transaction->date_paid}} </td>
                                <td>{{$transaction->amount}}</td>
                                
                            </tr>
                        @endforeach
                    
                        <tr>
                            <td colspan="4" align="right" >Total</td>
                            <td>{{$sum}}</td>
                        </tr>
                </tbody>
        </table>

        @else
            <div style="margin-top: 20px;">
                @if (Session::get('no_bank_transactions') != "")
                    <p style="color: red; font-size: 20px;">{{ Session::get('no_bank_transactions')}}</p>
                @endif
            </div>
        @endif
        
    

    <br>

    @if (!$mpesa_transactions->isEmpty())

    <?php $j = 1;?>
        <br>
    <p style="text-decoration: underline; font-size: 20px;">Report of fee transactions via mpesa as from {{$date_from}} to {{$date_to}}</p>
    
    <table class="table table-hover table-responsive-sm table-responsive-md responsive-lg table-responsive-xl " id="mpesa_transactions_table">
            <thead class="active">
                <th width="5%">#NO</th>
                <th>Phone number</th>
                <th>Transaction code</th>
                <th>Transaction date</th>
                <th>Amount</th>
            </thead>

            <tbody>

                    @foreach ($mpesa_transactions as $mpesaTransaction)
                        <tr >
                            <td>{{$j++}}</td>                            
                            <td>{{$mpesaTransaction->phone_no}} </td>

                            <td>{{$mpesaTransaction->transaction_code}}</td>
                            <td>{{$mpesaTransaction->transaction_date}} </td>
                            <td>{{$mpesaTransaction->amount}}</td>
                            
                        </tr>
                    @endforeach
                
                    <tr>
                        <td colspan="4" align="right" >Total</td>
                        <td>{{$mpesa_total}}</td>
                    </tr>
            </tbody>
    </table>

    @else
        <div style="margin-top: 20px;">
            @if (Session::get('no_mpesa_transactions') != "")
                <p style="color: red; font-size: 20px;">{{ Session::get('no_mpesa_transactions')}}</p>
            @endif
        </div>
    @endif
    
@endif

        {{-- reports for only bank transactions --}}
        @if ($transaction_type == "bank transactions")

        @if (!$transactions->isEmpty())

                <a target="_blank" href="/finance_department/fee_transactions/reports/download/{{$date_from}},{{$date_to}},{{$transaction_type}}"    style="float: right; margin-top: 5px; margin-bottom: 5px;"><i class="fa fa-download"></i>Download report</a>

            
                
                    <br>
                <p style="text-decoration: underline; font-size: 20px;">Report of fee transactions via bank as from {{$date_from}} to {{$date_to}}</p>
                
                <table class="table table-hover table-responsive-sm table-responsive-md responsive-lg table-responsive-xl " id="fee_reports_table">
                        <thead class="active">
                            <th width="5%">#NO</th>
                            <th>Bank branch</th>
                            <th>Reference Number</th>
                            <th>Transaction date</th>
                            <th>Amount</th>
                        </thead>

                        <tbody>

                                @foreach ($transactions as $transaction)
                                    <tr >
                                        <td>{{$i++}}</td>                            
                                        <td>{{$transaction->branch}} </td>

                                        <td>{{$transaction->transaction_no}}</td>
                                        <td>{{$transaction->date_paid}} </td>
                                        <td>{{$transaction->amount}}</td>
                                        
                                    </tr>
                                @endforeach
                            
                                <tr>
                                    <td colspan="4" align="right" >Total</td>
                                    <td>{{$sum}}</td>
                                </tr>
                        </tbody>
                </table>

                @else
                    <div style="margin-top: 20px;">
                        @if (Session::get('no_bank_transactions') != "")
                            <p style="color: red; font-size: 20px;">{{ Session::get('no_bank_transactions')}}</p>
                        @endif
                    </div>
                @endif
            
        @endif


        <!-- reports for only mpesa transactions -->
        @if ($transaction_type == "mpesa transactions")

        @if (!$mpesa_transactions->isEmpty())

            <?php $j = 1;?>
                <br>
            <p style="text-decoration: underline; font-size: 20px;">Fee transactions via mpesa report as from {{$date_from}} to {{$date_to}}</p>

            <table class="table table-hover table-responsive-sm table-responsive-md responsive-lg table-responsive-xl " id="mpesa_transactions_table">
                    <thead class="active">
                        <th width="5%">#NO</th>
                        <th>Phone number</th>
                        <th>Transaction code</th>
                        <th>Transaction date</th>
                        <th>Amount</th>
                    </thead>

                    <tbody>

                            @foreach ($mpesa_transactions as $mpesaTransaction)
                                <tr >
                                    <td>{{$j++}}</td>                            
                                    <td>{{$mpesaTransaction->phone_no}} </td>

                                    <td>{{$mpesaTransaction->transaction_code}}</td>
                                    <td>{{$mpesaTransaction->transaction_date}} </td>
                                    <td>{{$mpesaTransaction->amount}}</td>
                                    
                                </tr>
                            @endforeach
                        
                            <tr>
                                <td colspan="4" align="right" >Total</td>
                                <td>{{$mpesa_total}}</td>
                            </tr>
                    </tbody>
            </table>

            @else
                <div style="margin-top: 20px;">
                    @if (Session::get('no_mpesa_transactions') != "")
                        <p style="color: red; font-size: 20px;">{{ Session::get('no_mpesa_transactions')}}</p>
                    @endif
                </div>
            @endif
            
        @endif

   </div>
</div>

@endsection