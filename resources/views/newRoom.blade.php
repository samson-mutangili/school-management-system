@extends('layouts.dashboard')

@section('content')

            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">{{$dormName}} dormitory</h1>
                        
                </div>
            </div>

            

            <div class="row">
                        
    
                <div class="col-sm-10 offset-sm-1  col-md-10 0ffset-md-1  col-lg-10   col-xl-8 offset-xl-2">
                    
                    <div>
                        @if ( Session::get('room_available') != null)
                    
                        <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Failed</strong> : {{ Session::get('room_available')}}
                        </div>
                    
                        @endif
                    </div>    
        
                        <div class="panel panel-primary w-auto">
                             <div class="panel-heading">
                               Add new room
                             </div>
                             <form action="/accommodation_facility/Dormitory/saveNewRoom" method="post" class="form-horizontal" name="new_dormRoom_form">
                                @csrf
                                <div class="panel-body">
                             
                             <input type="hidden" name="dormName" value="{{$dormName}}" />

                             <input type="hidden" name="dorm_id" value="{{$dormID}}" />
                             
                             <div class="form-group row" id="room_no_div">
                                 
                                        <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="year">Room number</label>
                                
                                     <div class="col-lg-7 col-xl-7">
                                         <input type="text" class="form-control" id="room_no" name="room_no" placeholder="Enter room number" value="{{$room_no ?? ''}}" />
                                         <div id="room_no_error"></div>
                                     </div>
                              </div>

                              <div class="form-group row" id="room_capacity_div">
                                 
                                        <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="room_capacity">Room capacity</label>
                                
                                     <div class="col-lg-7 col-xl-7">
                                         <input type="number" class="form-control" id="room_capacity" name="room_capacity" placeholder="Enter room capacity" value="{{$room_capacity ?? ''}}" />
                                         <div id="room_capacity_error"></div>
                                     </div>
                              </div>
                                 
                                 
                                 
                                 <div class="form-group row" id="room_status_div">
                                     <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="room_status"> Room status</label>
                                     <div class="col-lg-7 col-xl-7">
                                          <select class="form-control" name="room_status" id="room_status">
                                                  <option value="">Select room status</option>
                                                  <option>Good</option>
                                                  <option>Under maintenance</option>
                                          </select>
                                          <div id="room_status_error"></div>
                                     </div>
                                 </div>

                                                    
                             <div class="form-group row">
                                     <div class="col-lg-7 offset-lg-4 col-xl-7 offset-xl-4">
                                         <button type="submit" name="Add" class="btn btn-primary "  onclick="return validateDormRoom()">Add </button>
                                     </div>
                                 </div>
                              
                             
                             </div>
                             </form>
                             
                              
                                
                              </div>
                                 
                             </div>
                                 </div>
   


@endsection