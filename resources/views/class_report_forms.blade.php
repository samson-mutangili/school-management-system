@extends('layouts.dashboard')

@section('content')

<?php 
$i = 1;

?>
<h3 style="text-align: center; text-decoration: underline; color: green; margin-bottom: 10px;">Report forms for {{$class_name}}, {{$year}}, Term {{$term}} {{$exam_type}} exams</h3>

<table class="table table-hover table-condensed">
        <thead class="active">
                <th class="table-secondary">S/NO</th>
                <th class="table-secondary">Name</th>
                <th class="table-secondary">Admission number</th>
                <th class="table-secondary">Class</th>
                <th class="table-secondary">Gender</th>
                <th class="table-secondary">Action</th>
        </thead>

        <tbody>
            @foreach ($students as $student )
            <?php $id = $student->id; ?>
                <tr>
                    <td>{{ $i++ }}</td>
                     <td>{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}} </td>
                     <td>{{$student->admission_number}}</td>
                     <td>{{$student->class}}</td>
                     <td>{{$student->gender}}</td>
                     <td>
                         <form action="/view_student_report_form" method="POST">
                            @csrf
                            <input type="hidden" name="student_id" value="{{$student->id}}"/>
                            <input type="hidden" name="class_name" value="{{$class_name}}"/>
                           <button type="submit" name="submit" value="{{$student->id}}" style="border: 1px solid black; width: auto; border-radius: 5px; padding: 3px; background-color: #fff; color:blue; width: 60px;" >View</button>
                        
                           <a href="/report_form/{{$student->id}},{{$class_name}}" style="border: 1px solid black; width: auto; border-radius: 5px; padding: 6px; color: blue; ">Download</a> 
                        </form>
                     </td>
                </tr>
            @endforeach
        </tbody> 

</table>


@endsection