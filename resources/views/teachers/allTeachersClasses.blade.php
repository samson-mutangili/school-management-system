@extends('layouts.dashboard')


@section('content')
<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Teachers classes </h4> 
    

    </div>
</div>


<div class="panel panel-primary w-auto">
    <div class="panel-heading">
     
    </div>
      @csrf
       <div class="panel-body">
        


<?php $i = 1; ?>
<table class="table table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl" id="teachers_details_table">
    <thead>
        <th>S/NO</th>
        <th>Subject</th>
        <th>Class</th>
        <th>Assigned teacher</th>
        <th>Teacher's phone number</th>
    </thead>

    <tbody>

        @if (!$teacher_classes->isEmpty())
            @foreach ($teacher_classes as $teacher_class)
               
            @if ($teacher_class->subject1 != null)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$teacher_class->subject1}}</td>
                    <td>Form {{$teacher_class->class_name}}</td>
                    <td>{{$teacher_class->first_name}} {{$teacher_class->middle_name}} {{$teacher_class->last_name}}</td>
                    <td>{{$teacher_class->phone_no}}</td>
                </tr>
            @endif

            @if ($teacher_class->subject2 != null)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$teacher_class->subject2}}</td>
                    <td>Form {{$teacher_class->class_name}}</td>
                    <td>{{$teacher_class->first_name}} {{$teacher_class->middle_name}} {{$teacher_class->last_name}}</td>
                    <td>{{$teacher_class->phone_no}}</td>
                </tr>
            @endif
            @endforeach
        @endif
    </tbody>

</table>
    
@if ($teacher_classes->isEmpty())

            <p style="color: red;">There are no teachers available!!</p>
 @endif


       </div>

</div>

@endsection
