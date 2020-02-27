@extends('layouts.dashboard')


@section('content')

<?php 

$i = 1;

?>

<h4 style="color: green; text-decoration: underline;">Non teaching staff details</h4>
<form action="/nonTeachingStaffDetails" method="GET" class="form-inline" style="margin-bottom: 20px;">
    <div class="form-group" style="margin-right: 30px;">
        <label class="control-table" style="margin-right: 10px;">Select number to show: </label>
        <select name="no_to_paginate" oninput="this.form.submit()">
            <option value=""></option>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>

    <div class="form-group">
            <label class="control-table">Sort by category:</label>
            <select name="sort_order" oninput="this.form.submit()">
                <option value=""><option>
                <option value="all">All</option>
                <option value="bursar">Bursar</option>
                 <option value="secretary">Secretary</option>
                 <option value="cook">Cook</option>
                 <option value="Cleaning">Cleaning</option>
                 <option value="security">Security</option>
            </select>
        </div>
        <div class="form-group">
            <label style="margin-left: 40px; margin-right: 10px;">Search</label>
            <input style="height: 23px;" type="text" name="search" placeholder="Search here..."/> 
        </div>
</form>

@if (Session::get('staff_archived') != null)
<div class="alert alert-success">
        <strong>Success</strong> : {{ Session::get('staff_archived')}}
</div>
@endif
<table class="table table-hover">
    <thead class="active">
        <th class="table-secondary">S/NO</th>
        <th class="table-secondary">Name</th>
        <th class="table-secondary">Phone number</th>
        <th class="table-secondary">ID number</th>
        <th class="table-secondary">Employee number</th>
        <th class="table-secondary">Category</th>
    </thead>

    <tbody>

        <?php

            if($non_teaching_staff->isEmpty()){
                echo '<p style="color: red;">There are no non teaching staff available!!</p>';
            }
        ?>

        @foreach ($non_teaching_staff as $staff )
        <tr data-href='/staff_details/{{$staff->id}}'>
            <td>{{ $i++ }}</td>
            <td>{{ $staff->first_name }} {{ $staff->middle_name}}  {{ $staff->last_name }} </td>
            <td>{{ $staff->phone_no }}</td>
            <td>{{ $staff->id_no }}</td>
            <td>{{ $staff->emp_no }}</td>
            <td>{{ $staff->category }}</td>
        </tr>
            
        @endforeach

        
    </tbody>

</table>


<div style="float: right;">
        {{ $non_teaching_staff->links() }}
    </div>

    
@endsection