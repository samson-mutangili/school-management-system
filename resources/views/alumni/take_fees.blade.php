@extends('layouts.dashboard')

@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Take Fees for alumni</h1>
        </div>
</div>
<?php $i = 1;?>

<div>
    @if ( Session::get('fee_recorded_successfully') != null)

    <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success</strong> : {{ Session::get('fee_recorded_successfully')}}
    </div>

    @endif
</div>  

<div class="panel panel-default w-auto">
        <div class="panel-heading">
          Alumni students
        </div>
           <div class="panel-body">
                <table class="table table-hover table-responsive-sm table-responsive-md " id="take_fees_for_alumni_table">
                        <thead class="active">
                            <th class="table-secondary">#NO</th>
                            <th class="table-secondary">ADM No.</th>
                            <th class="table-secondary">Name</th>
                            <th class="table-secondary">Gender</th>
                            <th class="table-secondary">Balance</th>
                            <th class="table-secondary">Action</th>
                        </thead>
                    
                        <tbody>
                           @foreach ($alumni as $alumni_student)
                               <tr>
                                   <td><?php echo $i++; ?></td>
                                   <td>{{$alumni_student->admission_number}}</td>
                                   <td>{{$alumni_student->first_name}} {{$alumni_student->middle_name}} {{$alumni_student->last_name}} </td>                              
                                   
                                   <td>{{$alumni_student->gender}}</td>
                                    <td>{{$alumni_student->balance}}
                                   <td>
                                       <a href="/finance_department/alumni/take_fees/{{$alumni_student->student_id}}" class="btn btn-sm btn-outline-primary">Take fees</a>
                                   </td>
                               </tr>
                           @endforeach
                        </tbody>
                </table>
           </div>
</div>
    
@endsection