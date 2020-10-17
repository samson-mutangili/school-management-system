@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Current disciplinary cases</h1>
    </div>
</div>
<?php $i = 1;

?>
 

<div class="panel panel-default w-auto">
    <div class="panel-heading">
      Disciplinary cases
    </div>
       <div class="panel-body">
            <div>
                    @if ( Session::get('case_reported_successfully') != null)
                
                    <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success</strong> : {{ Session::get('case_reported_successfully')}}
                    </div>
                
                    @endif
                </div> 
                 <div>
                        @if ( Session::get('case_not_cleared') != null)
                    
                        <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Failed</strong> : {{ Session::get('case_not_cleared')}}
                        </div>
                    
                        @endif
                    </div>  
                    <div>
                        @if ( Session::get('case_cleared_successfully') != null)
                    
                        <div class="alert alert-success alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success</strong> : {{ Session::get('case_cleared_successfully')}}
                        </div>
                    
                        @endif
                    </div> 
                    <div>
                            @if ( Session::get('case_not_cleared') != null)
                        
                            <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Success</strong> : {{ Session::get('case_not_cleared')}}
                            </div>
                        
                            @endif
                        </div> 
                     <div>
                            @if ( Session::get('case_not_reported') != null)
                        
                            <div class="alert alert-warning alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Failed</strong> : {{ Session::get('case_not_reported')}}
                            </div>
                        
                            @endif
                        </div>  
            <table class="table table-hover table-responsive-sm table-responsive-md " id="current_disciplinary_cases">
                    <thead class="active">
                        <th width="15%">Case NO.</th>
                        <th>ADM No.</th>
                        <th>Name</th>
                        <th>Case category</th>
                    </thead>

                    <tbody>

                        @if (!$current_cases->isEmpty())
                            @foreach ($current_cases as $case)
                                <tr data-href='/disciplinary_case/{{$case->case_id}}/{{$case->student_id}}/{{$case->teacher_id}}'>
                                    <td>{{$i++}}</td>
                                    <td>{{$case->admission_number}}</td>
                                    <td>{{$case->first_name}} {{$case->middle_name}} {{$case->last_name}}</td>
                                    <td>{{$case->case_category}}</td>
                                   
                                </tr>
                                
                            @endforeach
                        @endif
                    </tbody>
            </table>
       </div>
</div>

                
    
@endsection