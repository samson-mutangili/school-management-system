@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Students who have cleared school fees</h1>
    </div>
</div>
<?php $i = 1; 
    $no_student = true;
?>
<div class="panel panel-default w-auto">
<div class="panel-heading">
  List of {{$class_name}} students who have cleared school fees
</div>
   <div class="panel-body">
       @if (!$students->isEmpty())
            <a href="/finance_department/clean_students/download/{{$classForm}}" class="btn btn-outline-primary" style="float: right; margin-bottom: 10px;" target="_blank">Download</a>
       @endif
        <table width="100%" style="border-collapse: collapse; border:0px;">
                <tr>
                    <th style="border: 1px solid;  padding: 5px;" align="left" width="5%">#NO</th>
                    <th style="border: 1px solid; padding: 5px;"  align="left" width="10%" >ADM NO.</th>
                    <th style="border: 1px solid; padding: 5px;"  align="left"width="45%">Student name</th>
                    <th style="border: 1px solid; padding: 5px;" align="left" width="10%" >Class</th>

                    
                </tr>

                @if (!$students->isEmpty())
                        @foreach ($students as $student )

                            @foreach ($fee_balances as $fee)
                                @if ($student->id == $fee->student_id)
                                    @if ($fee->balance == 0)
                                        <tr>
                                                <td style="border: 1px solid; padding: 5px;"><?php echo $i++; ?></td>
                                                <td style="border: 1px solid; padding: 5px;">{{$student->admission_number}}</td>
                                                <td style="border: 1px solid; padding: 5px;">{{$student->first_name}}  {{$student->middle_name}}  {{$student->last_name}}</td>
                                                <td style="border: 1px solid; padding: 5px;">{{$student->class}}</td>
                                        </tr>  
                                        <?php $no_student = false; ?>                                      
                                    @endif
                                    
                                @endif
                            @endforeach
                            
                        @endforeach
                
                @endif
                
        </table>   
        
        @if ($no_student && !$students->isEmpty())
        <p style="color: red;"> No student has cleared school fees!!</p>
        @endif

        @if ($students->isEmpty())
        <p style="color: red;"> There are no students in the class!!</p>

        @endif
   </div>
</div>

    
@endsection