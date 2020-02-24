@extends('layouts.dashboard')


@section('content')


<h4 style="color: green; text-decoration: underline;">Alumni non teaching staff details</h4>
<form action="/alumniStaff" method="GET" class="form-inline" style="margin-bottom: 20px;">
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
            <label class="control-table">Sort by category:</label>
            <select name="sort_order" onchange="this.form.submit()">
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

       
        @foreach ($alumni_staff_details as $alumni_staff )
        <tr data-href='/alumniStaff/{{$alumni_staff->id}}'>
            <td>{{ $i++ }}</td>
            <td>{{ $alumni_staff->first_name }} {{ $alumni_staff->middle_name}}  {{ $alumni_staff->last_name }} </td>
            <td>{{ $alumni_staff->phone_no }}</td>
            <td>{{ $alumni_staff->id_no }}</td>
            <td>{{ $alumni_staff->emp_no }}</td>
            <td>{{ $alumni_staff->category }}</td>
        </tr>
            
        @endforeach

        
    </tbody>

</table>


<div style="float: right;">
        {{ $alumni_staff_details->links() }}
    </div>
    <?php

    if($alumni_staff_details->isEmpty()){
        echo '<p style="color: red;">There are no alumni non teaching staff available!!</p>';
    }
?>

    
@endsection