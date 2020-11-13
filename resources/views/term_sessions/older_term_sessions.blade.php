@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Older term sessions</h1>
    </div>
</div>
<?php $i = 1;

?>
 

<div class="panel panel-primary w-auto">
    <div class="panel-heading">
      
    </div>
       <div class="panel-body">

           
            <div>
                    @if ( Session::get('student_added_successfully') != null)
                
                    <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success</strong> : {{ Session::get('student_added_successfully')}}
                    </div>
                
                    @endif
            </div>  
       
            <table class="table table-hover table-responsive-sm table-responsive-md responsive-lg table-responsive-xl " id="older_term_sessions_table">
                    <thead class="active">
                        <th width="5%">#NO</th>
                        <th>Year</th>
                        <th>Term</th>
                        <th>Term start date</th>
                        <th>Term end date</th>
                        <th>Status</th>
                    </thead>

                    <tbody>

                        @if (!$older_term_sessions->isEmpty())
                            @foreach ($older_term_sessions as $older_term)
                                <tr data-href='/term_sessions/older/specific/{{$older_term->term_id}}'>
                                    <td>{{$i++}}</td>
                                    <td>{{$older_term->year}}</td>                                   
                                    <td>{{$older_term->term}}</td>
                                    <td>{{$older_term->term_start_date}}</td>
                                    <td>{{$older_term->term_end_date}}</td>
                                    <td>{{$older_term->status}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
            </table>


            @if ($older_term_sessions->isEmpty())
              <p style="color: red;">There are no older term sessions</p>  
            @endif
       </div>
</div>

                
    
@endsection