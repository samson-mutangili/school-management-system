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
        
    <h4 style="text-align: center; margin-bottom: 20px; text-decoration: underline;">Filter reports by date</h4>

    <form action="/finance_department/fee_tansactions/get_report" method="post" class="form-horizontal" name="login_form">

        
        @csrf

        <div class="row">

            <div class="col-md-5 col-lg-5 col-xl-5">
                    <div class="form-group row" id="date_from_div">
                     
                            <label class="col-lg-4  col-xl-4 col-md-4  control-label" for="Old">Date From</label>
                    
                         <div class="col-lg-7 col-xl-7 col-md-7">
                             <input type="date" class="form-control" id="date_from" name="date_from" placeholder="Date from" required />
                             <div id="date_from_error"></div>
                         </div>
                  </div>

            </div>

            <div class="col-md-5 col-lg-5 col-xl-5">
                    <div class="form-group row" id="date_to_div">
                     
                            <label class="col-lg-3  col-xl-3 col-md-3  control-label" style="valign: center;" for="date_to">Date To</label>
                    
                         <div class="col-lg-7 col-xl-7 col-md-7">
                             <input type="date" class="form-control" id="date_to" name="date_to" placeholder="Date to" required />
                             <div id="date_to_error"></div>
                         </div>
                  </div>

            </div>

            <div class="col-md-2 col-lg-2 col-xl-2">
                <button type="submit" name="submit" class="btn btn-success">Get report</button>

            </div>

        </div>

        
  

    </form>

     <div style="margin-top: 20px;">
        @if (Session::get('no_reports') != "")
            <p style="color: red; font-size: 20px;">{{ Session::get('no_reports')}}</p>
        @endif
    </div>

    <!-- view report data-->

    @if (!$transactions->isEmpty())

     <a target="_blank" href="/finance_department/fee_transactions/reports/download/{{$date_from}},{{$date_to}}"    style="float: right; margin-top: 5px; margin-bottom: 5px;"><i class="fa fa-download"></i>Download report</a>

   
    
        <br>
    <h3>Fee transactions report as from {{$date_from}} to {{$date_to}}</h3>
    
    <table class="table table-hover table-responsive-sm table-responsive-md responsive-lg table-responsive-xl " id="fee_reports_table">
            <thead class="active">
                <th width="5%">#NO</th>
                <th>Bank branch</th>
                <th>Reference Number</th>
                <th>Date paid</th>
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
    @endif
       

   </div>
</div>

@endsection