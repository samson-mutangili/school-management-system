@extends('layouts.dashboard')


@section('content')

<h4 style="color: green; ">Teachers details</h4>

@if ( Session::get('archived_successfully') != null)

    <div class="alert alert-success">
            <strong>Success</strong> : {{ Session::get('archived_successfully')}}
    </div>

@endif

<form action="/teachers_details" method="GET" class="form-inline" style="margin-bottom: 20px;">
    <div class="form-group" style="margin-right: 30px;">
        <label class="control-table" style="margin-right: 10px;">Select number to show: </label>
        <select name="no_to_paginate" onchange="this.form.submit()">
            <option value=""></option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>

    <div class="form-group">
            <label class="control-table" style="margin-right: 10px;">Sort by teaching subject: </label>
            <select name="subject" onchange="this.form.submit()">
                <option value=""><option>
                <option value="all">All</option>
                <option value="english">English</option>
                <option value="kiswahili">Kiswahili</option>
                <option value="mathematics">Mathematics</option>
                <option value="chemistry">Chemistry</option>
                <option value="biology">Biology</option>
                <option value="physics">Physics</option>
                <option value="geography">Geography</option>
                <option value="history">History</option>
                <option value="cre">Christian Religious Education</option>
                <option value="agriculture">Agriculture</option>
                <option value="business_studies">Business studies</option>
            </select>
     </div>
     
        <div class="form-group">
            <label style="margin-left: 40px; margin-right: 10px;">Search</label>
            <input style="height: 23px;" type="text" name="search" placeholder="Search here..."/> 
        </div>
</form>

<table class="table table-hover">
    <thead class="active">
        <th class="table-secondary">S/NO</th>
        <th class="table-secondary">Name</th>
        <th class="table-secondary">Phone no.</th>
        <th class="table-secondary">TSC no.</th>
        <th class="table-secondary">ID no</th>
        <th class="table-secondary">Subject 1</th>
        <th class="table-secondary">Subject 2</th>
    </thead>

    <tbody>

        

        @foreach ($teachers_details as $teacher )
        <tr data-href='/teachers_details/{{$teacher->id}}'>
            <td>{{ $i++ }}</td>
            <td>{{ $teacher->first_name }} {{ $teacher->middle_name}}  {{ $teacher->last_name }} </td>
            <td>{{ $teacher->phone_no }}</td>
            <td>{{ $teacher->tsc_no }}</td>
            <td>{{ $teacher->id_no }}</td>
            <td>{{ $teacher->subject_1 }}</td>
            <td>{{ $teacher->subject_2 }}
        </tr>
            
        @endforeach
    </tbody>

</table>
    
@if ($teachers_details->isEmpty())

            <p style="color: red;">There are no teachers available!!</p>
 @endif
<div style="float: right;">
    {{ $teachers_details->links() }}
</div>

@endsection