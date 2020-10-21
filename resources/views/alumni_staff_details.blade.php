@extends('layouts.dashboard')



@section('content')


<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Alumni non teaching staff details</h4>

    </div>
</div>


<div class="panel panel-default w-auto">
    <div class="panel-heading">
     Available alumni non teaching staff details
    </div>
      @csrf
       <div class="panel-body">
 

<table class="table table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl" id="alumni_non_teaching_staff_details_table">
    <thead class="active">
        <th>S/NO</th>
        <th>Name</th>
        <th>Phone number</th>
        <th>ID number</th>
        <th>Employee number</th>
        <th>Category</th>
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
       </div>
</div>
    
@endsection