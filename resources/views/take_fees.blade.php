@extends('layouts.dashboard')

@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Take Fees</h1>
        </div>
</div>
<?php $i = 1;?>

<div>
    @if ( Session::get('fee_recorded_successfully') != null)

    <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success</strong> : {{ Session::get('fee_recorded_successfully')}}
    </div>

    @endif
</div>  

<div class="panel panel-default w-auto">
        <div class="panel-heading">
          Take fees for Form {{$class_name}}
        </div>
           <div class="panel-body">
                <table class="table table-hover table-responsive-sm table-responsive-md " id="take_fees_table">
                        <thead class="active">
                            <th class="table-secondary">#NO</th>
                            <th class="table-secondary">Name</th>
                            <th class="table-secondary">ADM No.</th>
                            <th class="table-secondary" style="text-align: right;" align="right">Term {{$term}} fee</th>
                            <th class="table-secondary" style="text-align: right;" align="right">Balance</th>
                            <th class="table-secondary">Action</th>
                        </thead>
                    
                        <tbody>
                           @foreach ($students as $student)
                               <tr>
                                   <td><?php echo $i++; ?></td>
                                   <td>{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}} </td>
                                   <td>{{$student->admission_number}}</td>
                                   <td align="right">{{number_format($fees, 2)}}</td>

                                   <?php
                                        $student_fee_balance = $fees;

                                        if(!$fee_balances->isEmpty()){
                                            foreach($fee_balances as $fee_balance){
                                                if($fee_balance->student_id == $student->id){
                                                    $student_fee_balance = $fee_balance->balance; 
                                                }
                                            }  
                                        }
                                                                            
                                   ?>
                                   <td align="right">{{number_format($student_fee_balance, 2)}}</td>
                                   

                                   <td>
                                       <a href="/finance_department/take_fees/student/{{$student->id}}" class="btn btn-sm btn-outline-primary">Take fees</a>
                                   </td>
                               </tr>
                           @endforeach
                        </tbody>
                </table>
           </div>
</div>
    
@endsection