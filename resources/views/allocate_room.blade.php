@extends('layouts.dashboard')

@section('content')

<?php 
    
use Illuminate\Support\Facades\DB;

function getAvailableCapacity($room_id){
    

    $occupied_capacity = 0;
    
            //get the sum of students who have occupied that room
         $occupied = DB::table('student_dorm_rooms')
                          ->where('room_id', $room_id)
                          ->where('status', 'active')
                          ->count();

            $occupied_capacity += $occupied;
       
    //get the dorm total capacity
    $room_capacity = DB::table('dormitories_rooms')
                        ->select('room_capacity')
                        ->where('id', $room_id)
                        ->where('deleted', 'NO')
                        ->where('room_status', 'Good')
                        ->get();

    $final_room_capacity = 0;
    if(!$room_capacity->isEmpty()){
        foreach ($room_capacity as $room) {
            $final_room_capacity = $room->room_capacity;
        }
    }

    $available_capacity = $final_room_capacity - $occupied_capacity;

    if($available_capacity > 0){
        return "space available";
    } else {
        return "space not available";
    }

}


$i = 1; ?>

            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Student rooms</h1>
                        
                </div>
            </div>

            <?php $room_selected = false; ?>

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
                               Allocate room
                             </div>
                             <form action="/accommodation_facility/studentRooms/allocateRoom" method="post" class="form-horizontal" name="allocate_room_form">
                                @csrf
                                <div class="panel-body">

                                    <input type="hidden" name="student_id" value="{{$student_id}}" />
                                    <input type="hidden" name="class_name" value="{{$class_name}}" />
                             
                             <div class="form-group row" id="student_name_div">
                                 
                                        <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="student_name">Student name</label>
                                
                                     <div class="col-lg-7 col-xl-7">
                                         <input type="text" class="form-control" id="student_name" name="student_name" readonly value="{{$student_name}}" />
                                         <div id="student_name_error"></div>
                                     </div>
                              </div>

                              <div class="form-group row" id="adm_no_div">
                                 
                                        <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="adm_no">ADM number</label>
                                
                                     <div class="col-lg-7 col-xl-7">
                                         <input type="number" class="form-control" id="adm_no" name="adm_no" readonly value="{{$adm_no}}" />
                                         <div id="adm_no_error"></div>
                                     </div>
                              </div>
                                 
                                 
                                 
                                 <div class="form-group row" id="dorm_div">
                                     <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="dorm"> Dormitory</label>
                                     <div class="col-lg-7 col-xl-7">
                                          <select class="form-control" name="dorm" id="dorm" onchange="this.form.submit()">
                                                  <option value="">Select dormitory</option>
                                                  @if (!$dorms->isEmpty())
                                                      @foreach ($dorms as $dorm)
                                                            @if ($dorm_name != "")
                                                                @if ($dorm->name == $dorm_name)
                                                                    
                                                                @else
                                                                     <option>{{$dorm->name}}</option>
                                                                @endif

                                                            @else
                                                                 <option>{{$dorm->name}}</option>

                                                            @endif
                                                      @endforeach
                                                  @endif

                                                  @if ($dorm_name != "")
                                                      <option selected>{{$dorm_name}}</option>
                                                  @endif
                                          </select>
                                          <div id="dorm_error"></div>
                                     </div>
                                 </div>
                                 <?php $at_least_available = "no"; ?>
                                 <div class="form-group row" id="room_div">
                                        <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="room"> Room number</label>
                                        <div class="col-lg-7 col-xl-7">
                                             <select class="form-control" name="room" id="room">
                                                     <option value="">Select room</option>
                                                     @if (!$available_dorm_rooms->isEmpty())
                                                         @foreach ($available_dorm_rooms as $dorm_rooms)

                                                         @if (getAvailableCapacity($dorm_rooms->id) == "space available")
                                                            <option>{{$dorm_rooms->room_no}}</option>
                                                            <?php $at_least_available = "yeah"; ?>
                                                         @endif
                                                             
                                                         @endforeach
                                                         <?php $room_selected = true; ?>
                                                     @endif
                                             </select>
                                             <div id="room_error">
                                                 @if ($at_least_available != "yeah" && $dorms->isEmpty())
                                                    <p style="color: red;">Dorm capacity has been fully occupied</p>
                                                 @endif
                                            </div>
                                        </div>
                                    </div>

                                                    
                             <div class="form-group row">
                                     <div class="col-lg-7 offset-lg-4 col-xl-7 offset-xl-4">
                                         <button type="submit" name="Add" class="btn btn-success " @if (!$room_selected)
                                             disabled
                                         @endif onclick="return validateRoomNo()">Submit </button>
                                     </div>
                                 </div>
                              
                             
                             </div>
                             </form>
                             
                              
                                
                              </div>
                                 
                             </div>
                                 </div>
   


@endsection