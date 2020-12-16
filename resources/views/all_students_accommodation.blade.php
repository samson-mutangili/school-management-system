@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Accommodation history for all students</h1>
    </div>
</div>
<?php $i=1; ?>

<div class="panel panel-default w-auto">
    <div class="panel-heading">
      
    </div>
       <div class="panel-body">
       
            <table class="table table-hover table-responsive-sm table-responsive-md " id="student_rooms_table">
                    <thead class="active">
                        <th>#NO</th>
                        <th>ADM No.</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Status</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                       @if (!$all_students->isEmpty())
                                @foreach ($all_students as $student)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$student->admission_number}}</td>
                                    <td>{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}</td>
                                    <td>{{$student->gender}}</td>

                                    @if ($student->status == "active")
                                            <td style="color: green;">{{$student->status}}</td>
                                    @else
                                            <td style="color: red;">{{$student->status}}</td>
                                    @endif
                                    
                                    


                                    <td>
                                        
                                        <a href="/accommodation_facility/student/accommodation-history/{{$student->id}}"><button type="button"  class="btn btn-outline-primary btn-sm">View history</button></a>
                        
                                    </td>  

                                    
                                </tr>
                            @endforeach
                       @endif
                    </tbody>
            </table>
       </div>
</div>

                
    
@endsection