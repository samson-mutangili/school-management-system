@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Accommodation history</h1>
    </div>
</div>
<?php $i=1; ?>

<div class="panel panel-default w-auto">
    <div class="panel-heading">
      
    </div>
       <div class="panel-body">

        @if (!$student_details->isEmpty())          
        
    
        <a href="/accommodation_facility/all_students/history" style="float: left;"><i class="fa fa-arrow-left"></i>Back</a>

        @if (!$accommodation_details->isEmpty())
        <a href="/accommodation_facility/all_students/history/{{$student_id}}/download" target="_blank" style="float: right;"><button type="button" class="btn btn-outline-primary"><i class="fa fa-download"></i>Download</button></a>
       @endif
        <table cellspacing="7" cellpadding="7" style="margin-top: 35px;">
       
          @foreach ($student_details as $student)
                <tbody>
                    <tr>
                        <td align="left">Student name</td>
                        <td>: {{ $student->first_name}} {{$student->middle_name}} {{$student->last_name}}</td>
                    </tr>

                    <tr>
                        <td align="left"> Admission number</td>
                        <td>: {{$student->admission_number}}</td>
                    </tr>

                    <tr>
                            <td align="left"> Gender</td>
                            <td>: {{$student->gender}}</td>
                    </tr>

                </tbody>
            </table>
          @endforeach

        <p style="font-style: 18px; text-decoration: underline; margin-top: 20px;"> Student accommodation history</p>

            <table class="table table-hover table-responsive-sm table-responsive-md " >
                    <thead class="active">
                        <th>#NO</th>
                        <th>Dormitory</th>
                        <th>Room number</th>
                        <th>Date allocated</th>
                        <th>Date left</th>
                        <th>Status</th>
                    </thead>

                    <tbody>
                       @if (!$accommodation_details->isEmpty())
                                @foreach ($accommodation_details as $accommodation)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$accommodation->name}}</td>
                                    <td>{{$accommodation->room_no}} </td>
                                    <td>{{$accommodation->date_from}}</td>  
                                    @if ($accommodation->date_to == null)
                                        <td>--</td>
                                    @else
                                        <td>{{$accommodation->date_to}}</td>
                                    @endif                                  
                                    
                                    @if ($accommodation->allocation_status == "active")
                                            <td style="color: green;">{{$accommodation->allocation_status}}</td>
                                    @else
                                            <td>{{$accommodation->allocation_status}}</td>
                                    @endif                                 
                                    

                                    
                                </tr>
                            @endforeach
                       @endif
                    </tbody>
            </table>

            @if ($accommodation_details->isEmpty())
            
            <p style="color: red;">No accommodation history found for the student.</p>
                
            @endif

            @else
            <p style="color: red;">Student does not exists</p>
        @endif
       </div>
</div>

                
    
@endsection