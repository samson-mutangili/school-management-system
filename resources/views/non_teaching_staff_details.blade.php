@extends('layouts.dashboard')


@section('content')

<?php 

$i = 1;

?>



<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Non teaching staff details</h4>

    </div>
</div>


<div class="panel panel-default w-auto">
    <div class="panel-heading">
     Available non teaching staff
    </div>
      @csrf
       <div class="panel-body">
     
        <div>
            @if ( Session::get('staff_archived') != null)
        
            <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success</strong> : {{ Session::get('staff_archived')}}
            </div>
        
            @endif
        </div>  

<table class="table table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl" id="non_teaching_staff_details_table">
    <thead class="active">
        <th>S/NO</th>
        <th>Name</th>
        <th>Phone number</th>
        <th>ID number</th>
        <th>Employee number</th>
        <th>Category</th>
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



       </div>
</div> 
@endsection