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
  Fees statements for {{$class_name}}
</div>
   <div class="panel-body">

        <table class="table table-hover table-responsive-md table-responsive-sm table-md table-responsive-lg table-responsive-xl"  width="100%" id="students_fee_statements_table">
                <thead>
                    <th  width="5%">#NO</th>
                    <th  width="15%">ADM NO.</th>
                    <th >Student name</th>
                    <th  >Action</th>
                </thead>
            
                <tbody>
                
                    @foreach ($students as $student)
                            
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{$student->admission_number}}</td>
                            <td>{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}</td>
                            <td>
                                <a href="/finance_department/view_fee_statement/{{$class_name}},{{$student->id}}" class="btn btn-outline-success btn-sm">View</a>
                                <a href="/finance_department/download_fee_statement/{{$student->id}}" class="btn btn-outline-primary btn-sm" target="_blank">Download</a>
                            </td>
                        </tr>

                    @endforeach
                </tbody>
        </table>

   </div>
</div>

@endsection