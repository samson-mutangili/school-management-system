@extends('layouts.dashboard')

@section('content')
    

<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Merit List</h4>

    </div>
</div>


<div class="panel panel-default w-auto">
    <div class="panel-heading">
      No available merit list
    </div>
      @csrf
       <div class="panel-body">
            <div style="margin-top: 10px;">
                    @if ( Session::get('merit_list_not_ready') != null)
                
                    <p style="color: red;">{{ session::get('merit_list_not_ready')}}</p>
                
                    @endif

                    @if ( Session::get('no_exam_session') != null)
                
                    <p style="color: red;">{{ session::get('no_exam_session')}}</p>
                
                    @endif

                    @if ( Session::get('class_not_valid') != null)
                
                    <p style="color: red;">{{ session::get('class_not_valid')}}</p>
                
                    @endif
                </div>


       </div>
</div>

@endsection