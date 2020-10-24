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
 Alumni fees statements 
</div>
   <div class="panel-body">

        <table class="table table-hover table-responsive-sm table-responsive-md " id="alumni_fee_statements_table">
                <thead class="active">
                    <th width="5%">#NO</th>
                    <th>ADM NO.</th>
                    <th>Student name</th>
                    <th>Gender</th>
                    <th >Action</th>
                </thead>
            
                <tbody>
                
                    @foreach ($alumni as $student)
                            
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$student->admission_number}}</td>
                            <td>{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}</td>
                            <td>{{$student->gender}}</td>
                            <td>
                                <a href="/finance_department/alumni/view_fee_statement/{{$student->id}}" class="btn btn-outline-success btn-sm">View</a>
                                <a href="/finance_department/download_fee_statement/{{$student->id}}" class="btn btn-outline-primary btn-sm" target="_blank">Download</a>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
        </table>

   </div>
</div>

@endsection