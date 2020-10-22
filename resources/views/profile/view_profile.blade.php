@extends('layouts.dashboard')

@section('content')

<?php

$year = date("Y");

?>
<div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">User profile</h1>

                </div>
            </div>
            <a href="/users/profile/edit" style="float:right;"><button>Edit profile</button></a>
            <div>
                @if ( Session::get('invalid_user') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('invalid_user')}}
                </div>
            
                @endif
            </div>   
            
            <div>
                @if ( Session::get('profile_updated_successfully') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('profile_updated_successfully')}}
                </div>
            
                @endif
            </div>  

            @if(!$user_details->isEmpty())
                    @foreach ($user_details as $user)

                        
                        <form  method = "POST" name="student_edit_form">
                                @csrf
                    <div class="row" style=" margin:10px 0 10px 0; margin-top: 20px; ">
                        
                            <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-xs-12">
                            
                                <div >
                                <div class="row">
                                        <div class="row">
                                                <div class="col-xm-12 col-sm-6 col-md-12 col-lg-12 col-xl-12">
                                                        @if($user->profile_pic != null)
                                                                <img class="img-profile rounded-circle" style="width: 170px; height: 170px;" src="{{URL::asset('images/'.$user->profile_pic)}}" alt="profile picture" />

                                                        @else
                                                                <img class="img-profile rounded-circle" style="width: 170px; height: 170px;" src="{{URL::asset('images/default_profile_pic.png')}}" alt="profile picture" />

                                                        @endif
                                                </div>
                                        </div>
                                        <div class="col-xm-12 col-sm-6 col-md-9 col-lg-9 col-xl-9">
                                                <div class="row">
                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-10 col-xl-10">
                                                        <div class="form-group" id="name_div">
                                                                <label class="control-table" for="first_name">Name</label>
                                                                <input type="text" name="name" id="name" class="form-control"  value="{{$user->first_name}} {{  $user->middle_name }} {{$user->last_name}}" readonly/>
                                                                <div id="name_error"></div>
                                                        </div>	
                                                </div>
                            
                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-10 col-xl-10">
                                                        <div class="form-group" id="email_div">
                                                                <label class="control-table" for="email">Email</label>
                                                                <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}" readonly />
                                                                <div id="email_error"></div>
                                                        </div>	
                                                </div>
                            
                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
                                                        <div class="form-group" id="phone_no_div">
                                                                <label class="control-table" for="phone_no">Phone number</label>
                                                                <input type="number" name="phone_no" id="phone_no" class="form-control" value="{{$user->phone_no}}"  readonly/>
                                                                <div id="phone_no_error"></div>
                                                        </div>	
                                                </div>
                        
                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
                                                        <div class="form-group" id="tsc_no_div">
                                                                <label class="control-table" for="tsc_no">TSC number</label>
                                                                <input type="text" name="tsc_no" id="tsc_no" class="form-control" value="{{$user->tsc_no}}" readonly/>
                                                                <div id="tsc_no_error"></div>
                                                        </div>
                                                    
                                                </div>
                        
                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
                                                        <div class="form-group" id="id_no_div">
                                                                <label for="id_no">ID number</label>
                                                                <input type="number" class="form-control" name="id_no"  value="{{$user->id_no}}" readonly/>
                                                                <div id="id_no_error"></div>
                                                            </div>
                                                    
                                                </div>
                        
                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
                                                        <div class="form-groupgender_div">
                                                                <label for="date_of_birth">Gender</label>
                                                                <input type="textgender" class="form-control" name="gender" value="{{$user->gender}}" readonly/>
                                                                <div id="gender"></div>
                                                            </div>
                                                    
                                                </div>
                        
                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
                                                        <div class="form-group" id="nationality_div">
                                                                <label for="nationality">Nationality</label>
                                                                <input type="text" id="nationality" class="form-control" name="nationality" value="{{$user->nationality}}" readonly/>
                                                                <div id="nationality_error"></div>
                                                        </div>
                                                    
                                                </div>
                        
                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-5 col-xl-5 ">
                                                        <div class="form-group" id="religion_div">
                                                                <label for="religion">Religion</label>
                                                                <input type="text" id="religion" class="form-control" name="religion" value="{{$user->religion}}" readonly/>
                                                                <div id="religion_error"></div>
                                                        </div>
                                            
                                                </div>
                        
                                                
                                                
                                                </div>
                                        </div>
                
                                        
                
                                    </div>
                                </div>
                            
                        </div>
                    
                </form>
                        
                    @endforeach
            @else
                <p style="color:red;">No user!!</p>
            @endif

        </div>
</div>
    



@endsection