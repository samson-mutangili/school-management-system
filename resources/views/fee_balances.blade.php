@extends('layouts.dashboard')

@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Fees Balances</h1>
        </div>
</div>
    <?php $i = 1; ?>
<div class="panel panel-default w-auto">
    <div class="panel-heading">
      Fees balances for {{$class_name}}
    </div>
       <div class="panel-body">
        <a href="/finance_department/download_fee_balance/{{$class_name}}" target="_blank" class="btn btn-outline-primary" style="float: right; margin-bottom: 10px;">Download</a>
            <table width="100%" style="border-collapse: collapse; border:0px;">
                    <tr>
                        <th style="border: 1px solid; padding: 5px;" align="left" width="5%">#NO</th>
                        <th style="border: 1px solid; padding: 5px;"  align="left" width="10%" >ADM. NO</th>
                        <th style="border: 1px solid; padding: 5px;"  align="left"width="45%">Student name</th>
                        <th style="border: 1px solid; padding: 5px;" align="left" width="10%" >Fees Balance</th>
                        
          
                    </tr>

                    @foreach ($students as $student )
                        <tr>
                                <td style="border: 1px solid; padding: 5px;"><?php echo $i++; ?></td>
                                <td style="border: 1px solid; padding: 5px;">{{$student->admission_number}}</td>
                        <td style="border: 1px solid; padding: 5px;">{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}</td>

                                <?php
                                    $fee_balance = $fees;
                                    if(!$students_fee_balances->isEmpty()){
                                        foreach ($students_fee_balances as $student_balance) {
                                            if($student_balance->student_id == $student->id){
                                                $fee_balance = $student_balance->balance;
                                            }
                                        }
                                    }
                                ?>
                                <td style="border: 1px solid; padding: 5px;">{{$fee_balance}}</td>
                        </tr>
                    @endforeach
                    
            </table>
                    

       </div>

</div>

@endsection