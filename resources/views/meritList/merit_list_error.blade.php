@extends('layouts.dashboard')

@section('content')
    

<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Merit List</h4>

    </div>
</div>


<div class="panel panel-danger w-auto">
    <div class="panel-heading">
      No available merit list
    </div>
      @csrf
       <div class="panel-body">
            <div style="margin-top: 10px;">
                    @if ( Session::get('merit_list_not_ready') != null)
                    <div class="alert alert-danger">
                    <p style="color: red;"><i class="fa fa-exclamation-triangle"></i> {{ session::get('merit_list_not_ready')}}</p>
                    </div>
                    @endif

                    @if ( Session::get('no_exam_session') != null)
                    <div class="alert alert-danger">
                    <p style="color: red;"><i class="fa fa-exclamation-triangle"></i> {{ session::get('no_exam_session')}}</p>
                    </div>
                    @endif
                    
                    @if ( Session::get('class_not_valid') != null)
                    <div class="alert alert-danger">
                    <p style="color: red;"><i class="fa fa-exclamation-triangle"></i> {{ session::get('class_not_valid')}}</p>
                    </div>
                    @endif
                </div>


       </div>
</div>

@endsection