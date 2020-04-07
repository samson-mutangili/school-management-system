@extends('layouts.dashboard')

@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Fees Statements</h1>
        </div>
    </div>
    <?php $i = 1; ?>
    <div class="panel panel-default w-auto">
    <div class="panel-heading">
      Student Fee statement
    </div>
       <div class="panel-body">

        <div style="margin-bottom: 30px;">
            <a href="/finance_department/fee_statements/{{$class_name}}" class="btn btn-outline-primary" style="float: left;">Back</a>
            <a href="/finance_department/download_fee_statement/{{$student_id}}" class="btn btn-outline-primary" target="_blank" style="float: right;">Download</a>
        </div>
        <div style="margin-top: 50px;">
            <table width="100%">
                <tr>
                    <th width="15%"></th>
                    <th></th>
                </tr>
                @foreach ($student_details as $student)
                    <tr>
                        <td> ADM NO.  </td>
                        <td>    : {{$student->admission_number}}</td>
                        
                    </tr>
                    <tr>
                            <td>Name </td>
                            <td>    : {{$student->first_name}} {{$student->middle_name}} {{$student->last_name}} </td>

                    </tr>

                    <tr>
                            <td>Date </td>
                                <td>    :  <?php echo date("d-m-Y"); ?></td>

                    </tr>
                @endforeach

                
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

                    @foreach ($fee_transactions as $fee_transaction )
                        <tr>
                                <td style=" padding: 5px;"><?php echo $i++; ?></td>
                                <td style=" padding: 5px;">{{$fee_transaction->branch}}</td>
                                 <td style=" padding: 5px;">{{$fee_transaction->transaction_no}}</td>
                                 <td style=" padding: 5px;">{{$fee_transaction->date_paid}}</td>
                                <td style=" padding: 5px;" >{{$fee_transaction->amount}}</td>
                        </tr>
                    @endforeach
                    
                    <tr>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                             <td style="border-bottom: 1px solid; padding: 5px;"></td>
                             <td style="border-bottom: 1px solid; padding: 5px;"></td>
                            <td style="border-bottom: 1px solid; padding: 5px;"></td>
                    </tr>

                   @foreach ($student_details as $student)
                        <tr>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;">Sum total of amount paid</td>
                                <td style=" padding: 5px;">{{$student->amount_paid}}</td>
                        </tr>
                        <tr>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;">Total fees</td>
                                <td style=" padding: 5px;">{{$student->total_fees}}</td>
                        </tr>

                        <tr>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;">Fees balance</td>
                                <td style=" padding: 5px;">{{$student->balance}}</td>
                        </tr>

                        <tr>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;"></td>
                                <td style=" padding: 5px;">Overpay</td>
                                <td style=" padding: 5px;">{{$student->overpay}}</td>
                        </tr>
                   @endforeach



            </table>
        </div>
       </div>
    </div>
    
    
@endsection