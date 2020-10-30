@extends('layouts.dashboard')


@section('content')
<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Teachers details </h4> 
    

    </div>
</div>


<div class="panel panel-primary w-auto">
    <div class="panel-heading">
     Available teachers
    </div>
      @csrf
       <div class="panel-body">
        

        <div>
            @if ( Session::get('archived_successfully') != null)
        
            <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success</strong> : {{ Session::get('archived_successfully')}}
            </div>
        
            @endif
        </div> 

        <div>
            @if ( Session::get('teacher_registered_successfully') != null)
        
            <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success</strong> : {{ Session::get('teacher_registered_successfully')}}
            </div>
        
            @endif
        </div> 

<?php $i = 1; ?>
<table class="table table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl" id="teachers_details_table">
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


       </div>

</div>

@endsection
