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

<table class="table table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl" id="teachers_details_table" width="100%">
    <thead>
        <th>S/NO</th>
        <th>Name</th>
        <th>Phone no.</th>
        <th>TSC no.</th>
        <th>ID no</th>
        <th>Subject 1</th>
        <th>Subject 2</th>
    </thead>

    <tbody>

        
        <?php
        foreach ($teachers_details as $teacher ){ 
            ?>
        <tr data-href='/teachers_details/{{$teacher->id}}'>
            <td><?php echo $i++; ?></td>
            <td><?php echo $teacher->first_name; echo " ";  echo $teacher->middle_name; echo " ";   echo $teacher->last_name;  ?></td>
            <td><?php echo $teacher->phone_no; ?></td>
            <td><?php echo $teacher->tsc_no; ?></td>
            <td><?php echo $teacher->id_no; ?></td>
            <td><?php echo $teacher->subject_1; ?></td>
            <td><?php echo $teacher->subject_2; ?></td>
        </tr>
      <?php      
    }
    ?>
    </tbody>

</table>
    
@if ($teachers_details->isEmpty())

            <p style="color: red;">There are no teachers available!!</p>
 @endif

@endsection
