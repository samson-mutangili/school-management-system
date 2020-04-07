@extends('layouts.dashboard')


@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Reports</h1>
    </div>
</div>
<?php $i = 1; ?>
<div class="panel panel-default w-auto">
<div class="panel-heading">
  Finance department reports
</div>
   <div class="panel-body">
        <a href="/finance_department/reports/download" class="btn btn-outline-primary" style="float: right; margin-bottom: 10px;" target="_blank">Download</a>
        <br>
        <P>Total number of students: {{$students_no}} </P>
       <p>Number of students who have cleared school fees as per class stream</p>

 
   <table width="100%" style="border-collapse: collapse; border:0px;">
           <tr>
               <th style="border: 1px solid;  padding: 5px;" align="left" width="5%">#NO</th>
               <th style="border: 1px solid; padding: 5px;"  align="left" width="15%" >Class</th>
               <th style="border: 1px solid; padding: 5px;"  align="left"width="45%">Class stream</th>
               <th style="border: 1px solid; padding: 5px;" align="left"  >No. of students who have cleared fees</th>

           </tr>

           <tr>
                <td style="border: 1px solid; padding: 5px;"><?php echo $i++; ?></td>
                <td style="border: 1px solid; padding: 5px;">Form 1</td>
                <td style="border: 1px solid; padding: 5px;">1 E</td>
                <td style="border: 1px solid; padding: 5px;">{{$form1_E}}</td>
            </tr> 
            
            <tr>
                    <td style="border: 1px solid; padding: 5px;"><?php echo $i++; ?></td>
                    <td style="border: 1px solid; padding: 5px;">Form 1</td>
                    <td style="border: 1px solid; padding: 5px;">1 W</td>
                    <td style="border: 1px solid; padding: 5px;">{{$form1_W}}</td>
            </tr> 

            <tr>
                <td style="border: 1px solid; padding: 5px;"><?php echo $i++; ?></td>
                <td style="border: 1px solid; padding: 5px;">Form 2</td>
                <td style="border: 1px solid; padding: 5px;">2 E</td>
                <td style="border: 1px solid; padding: 5px;">{{$form2_E}}</td>
            </tr> 

            <tr>
                    <td style="border: 1px solid; padding: 5px;"><?php echo $i++; ?></td>
                    <td style="border: 1px solid; padding: 5px;">Form 2</td>
                    <td style="border: 1px solid; padding: 5px;">2 W</td>
                    <td style="border: 1px solid; padding: 5px;">{{$form2_W}}</td>
            </tr> 

            <tr>
                    <td style="border: 1px solid; padding: 5px;"><?php echo $i++; ?></td>
                    <td style="border: 1px solid; padding: 5px;">Form 3</td>
                    <td style="border: 1px solid; padding: 5px;">3 E</td>
                    <td style="border: 1px solid; padding: 5px;">{{$form3_E}}</td>
            </tr> 
                
                <tr>
                        <td style="border: 1px solid; padding: 5px;"><?php echo $i++; ?></td>
                        <td style="border: 1px solid; padding: 5px;">Form 3</td>
                        <td style="border: 1px solid; padding: 5px;">3 W</td>
                        <td style="border: 1px solid; padding: 5px;">{{$form3_W}}</td>
                </tr> 
    
                <tr>
                    <td style="border: 1px solid; padding: 5px;"><?php echo $i++; ?></td>
                    <td style="border: 1px solid; padding: 5px;">Form 4</td>
                    <td style="border: 1px solid; padding: 5px;">4 E</td>
                    <td style="border: 1px solid; padding: 5px;">{{$form4_E}}</td>
                </tr> 
    
                <tr>
                        <td style="border: 1px solid; padding: 5px;"><?php echo $i++; ?></td>
                        <td style="border: 1px solid; padding: 5px;">Form 4</td>
                        <td style="border: 1px solid; padding: 5px;">4 W</td>
                        <td style="border: 1px solid; padding: 5px;">{{$form4_W}}</td>
                </tr> 
   </table>   

   <br>
   
   <p>Total number of students who have completed fee: {{$cleared_fee}}</p>
   <p>Percentage of students who have completed fee: {{$percentage_cleared}} %</p>
   <p>Total amount collected: {{$amount_collected}}</p>

   </div>
</div>

    
@endsection