@extends('layouts.dashboard')

@section('content')

<div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Archived Teachers details </h4> 
            <a href="/teachers/archived"><i class="fa fa-arrow-left" ></i>Back</a>

    
        </div>
    </div>
    
    
    <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#bio_data">Bio data</a>
            </li>
                            
          </ul>

          <div style="margin-top: 10px;">
           

        

<div>
@if ( Session::get('teacher_class_withdrawn') != null)

<div class="alert alert-success">
        <strong>Success</strong> : {{ Session::get('teacher_class_withdrawn')}}
</div>

@endif
</div>


          </div>

          <div style="margin-top: 20px;">

          <div class="tab-content">
                <div id="bio_data" class="tab-pane container active">
                     
                     <div class="panel panel-default w-auto" >
                             <div class="panel-heading">
                               Teacher's bio data
                             </div>                    
                             <div class="panel-body">
                                @foreach ($specific_archived_teacher as $teacher)
                                <div class="row">

                                        <div class="col-xm-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                                @if ($teacher->profile_pic != null)
                                                  <img class="img-profile rounded-circle" style="width: 170px; height: 170px;" src="{{URL::asset('images/'.$teacher->profile_pic)}}" alt="profile picture" />
                                                @else
                                                <img class="img-profile rounded-circle" style="width: 170px; height: 170px;" src="{{URL::asset('images/default_profile_pic.png')}}" alt="profile picture" />
                
                                                @endif
                                               
                                        </div>
                
                                        <div class="col-xm-12 col-sm-6 col-md-8 col-lg-9 col-xl-9">
                
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12 col-xl-12">
                                                        <table cellspacing="7" cellpadding="7">
       
                                                                <tbody>
                                                                    <tr>
                                                                        <td align="left">Name</td>
                                                                        <td>: {{ $teacher->first_name}} {{$teacher->middle_name}} {{$teacher->last_name}}</td>
                                                                    </tr>
                                                        
                                                                    <tr>
                                                                        <td align="left"> Phone number</td>
                                                                        <td>: {{$teacher->phone_no}}</td>
                                                                    </tr>
                                                        
                                                                    <tr>
                                                                            <td align="left"> Email address</td>
                                                                            <td>: {{$teacher->email}}</td>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                            <td align="left"> ID Number</td>
                                                                            <td>: {{$teacher->id_no}}</td>
                                                                    </tr>
                                                        
                                                        
                                                                    <tr>
                                                                            <td align="left"> TSC number</td>
                                                                            <td>: {{$teacher->tsc_no}}</td>
                                                                    </tr>  
                                                                    
                                                                    <tr>
                                                                            <td align="left"> Gender</td>
                                                                            <td>: {{$teacher->gender}}</td>
                                                                    </tr>
                                                        
                                                                    <tr>
                                                                            <td align="left"> Teaching subject 1</td>
                                                                            <td>: {{$teacher->subject_1}}</td>
                                                                    </tr>
                                                        
                                                                    <tr>
                                                                            <td align="left"> Teaching subject 2</td>
                                                                            <td>: {{$teacher->subject_2}}</td>
                                                                    </tr>
                                                        
                                                                    <tr>
                                                                            <td align="left"> Nationality</td>
                                                                            <td>: {{$teacher->nationality}}</td>
                                                                    </tr>  
                                                                  
                                                                    <tr>
                                                                            <td align="left"> Date of hire</td>
                                                                            <td>: {{$teacher->date_hired}}</td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td align="left"> Date left</td>
                                                                        <td>: {{$teacher->date_left}}</td>
                                                                     </tr>
                                                        
                                                                     <tr>
                                                                        <td align="left"> Status</td>
                                                                        <td style="color: red;">: {{$teacher->status}}</td>
                                                                     </tr>
                                                                </tbody>
                                                            </table>
                                                         
                                                       
                                                            <button name="unarchive" id="{{$teacher->id}}" data-toggle="modal" data-target="#unarchive_modal{{$teacher->id}}" style="margin-top: 20px; width: 7em; margin-left: 30px;"  class="btn btn-outline-primary">Unarchive</button>
                                                          
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-xs-12 col-lg-12 col-xl-12">
                                                                        <div class="modal" id="unarchive_modal{{$teacher->id}}" tabindex="-1">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title pull-left" >Unarchive Teacher</h4>
                                                                                        <button class="close" data-dismiss="modal">&times;</button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form action="/unarchive_teacher" method = "POST">
                                                                                        @csrf
                                                                                        <input type="hidden" name="teacher_id" value='{{$teacher->id}}'/>
                                                                                        <div class="row">
                                                                                            <p>Do you want to unarchive {{ $teacher->first_name}} {{$teacher->last_name}}</p>                                     
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">NO, Cancel</button>
                                                                                                    <input type="submit" class="btn btn-success" value="Yes, Unarchive"></input>
                                                                                        </div>
                                                                                        </form>	
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                </div>
                                            </div>

                                        </div>

                                </div>
                                @endforeach
                             </div>
                     </div>
                </div>
          

                </div>
          </div>


	
@endsection