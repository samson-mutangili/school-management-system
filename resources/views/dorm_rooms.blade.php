@extends('layouts.dashboard')

@section('content')
    

<?php 
    
use Illuminate\Support\Facades\DB;

function getAvailableCapacity($room_id){
    

    $occupied_capacity = 0;
    
            //get the sum of students who have occupied that room
         $occupied = DB::table('student_dorm_rooms')
                          ->where('room_id', $room_id)
                          ->where('allocation_status', 'active')
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

    return $available_capacity;


}


?>

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line"> {{$dormName}} dormitory</h1>
    </div>
</div>
<?php $i = 1; ?>

<div>
    @if ( Session::get('room_saved') != null)

    <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success</strong> : {{ Session::get('room_saved')}}
    </div>

    @endif
</div>  

<div>
    @if ( Session::get('deleted_success') != null)

    <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success</strong> : {{ Session::get('deleted_success')}}
    </div>

    @endif
</div>  

<div>
    @if ( Session::get('deleted_fail') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('deleted_fail')}}
    </div>

    @endif
</div>  


<div>
    @if ( Session::get('room_has_students') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('room_has_students')}}
    </div>

    @endif
</div>  

<div>
        @if ( Session::get('capacity_mismatch') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('capacity_mismatch')}}
        </div>
    
        @endif
    </div>  

    <div>
            @if ( Session::get('room_status_error') != null)
        
            <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Failed</strong> : {{ Session::get('room_status_error')}}
            </div>
        
            @endif
        </div>  
<div>
    @if ( Session::get('empty_field') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('empty_field')}}
    </div>

    @endif
</div>  

<div>
    @if ( Session::get('negative_capacity') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('negative_capacity')}}
    </div>

    @endif
</div>  

<div>
    @if ( Session::get('large_capacity') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('large_capacity')}}
    </div>

    @endif
</div>

<div>
    @if ( Session::get('update_success') != null)

    <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success</strong> : {{ Session::get('update_success')}}
    </div>

    @endif
</div>  

<div>
    @if ( Session::get('update_failed') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('update_failed')}}
    </div>

    @endif
</div>


<div class="panel panel-default w-auto">
<div class="panel-heading">
  {{$dormName}} dormitory rooms
</div>
   <div class="panel-body">

        <a href="/accommodation_facility/dormitory/report/{{$dormID}}" target="_blank" style="float:left; margin-bottom: 10px; position: absolute;" class="btn btn-outline-primary">Download report</a>

        <a href="/accommodation_facility/dormitory/{{$dormID}}/addNewRoom" style="float:right; margin-bottom: 10px; position: relative;" class="btn btn-outline-primary">Add room</a>


        <table class="table table-hover table-responsive-sm table-responsive-md" id="dorm_rooms_table">
                <thead>
                    <th>No #</th>
                    <th>Room number</th>
                    <th>Capacity</th>
                    <th>Available capacity</th>
                    <th>Room status</th>
                    <th>Action</th>
                </thead>
            
                <tbody>

                    @if (!$dorm_rooms->isEmpty())
                        @foreach ($dorm_rooms as $room )
                            <tr>
                                <td>{{ $i++}}</td>
                                <td>{{$room->room_no}}</td>
                                <td>{{$room->room_capacity}}</td>
                                <td>{{getAvailableCapacity($room->id)}}</td>
                                <td>{{$room->room_status}}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-success btn-sm" name="edit_room{{$room->id}}"  data-toggle="modal" data-target="#edit_room_modal{{$room->id}}" id="edit_room{{$room->id}}">Edit</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" name="remove_room{{$room->id}}" data-toggle="modal" data-target="#remove_room_modal{{$room->id}}" id="remove_room{{$room->id}}">Remove</button>
                                </td>
                            </tr>

                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-lg-12 col-xl-12">
                                        <div class="modal" id="remove_room_modal{{$room->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title pull-left" style="color:red;">Remove Room</h4>
                                                        <button class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                        
                                                        <form action="/accommodation_facility/dormitory/removeRoom" method="POST">
                                                            @csrf
                                                            
                                                            <input type="hidden" name="room_id" value="{{$room->id}}" />                                                          
                                                            <input type="hidden" name="dorm_id" value="{{$dormID}}" />                                                          

                                                             Are you sure you want to remove this room??                                                            
                                                        
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger"  >Yes, remove</button>
                              
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- modal form for editing rooms details -->
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-lg-12 col-xl-12">
                                        <div class="modal" id="edit_room_modal{{$room->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title pull-left" style="color:red;">Edit room details</h4>
                                                        <button class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                        
                                                        <form action="/accommodation_facility/dormitory/editRoom" method="POST">
                                                            @csrf
                                                            
                                                            <input type="hidden" name="room_id" value="{{$room->id}}" />                                                            
                                                            <input type="hidden" name="dorm_id" value="{{$room->dorm_id}}" />                                                            

                                                            <div class="form-group row" id="room_no_div">
                                 
                                                                <label class="col-lg-4 offset-lg-1 col-xl-4 offset-xl-1 control-label" for="year">Room number</label>
                                                        
                                                             <div class="col-lg-7 col-xl-7">
                                                                 <input type="text" class="form-control" id="room_no" name="room_no" placeholder="Enter room number" value="{{$room->room_no}}" />
                                                                 <div id="room_no_error"></div>
                                                             </div>
                                                      </div>
                        
                                                      <div class="form-group row" id="room_capacity_div">
                                                         
                                                                <label class="col-lg-4 offset-lg-1 col-xl-4 offset-xl-1 control-label" for="room_capacity">Room capacity</label>
                                                        
                                                             <div class="col-lg-7 col-xl-7">
                                                                 <input type="number" class="form-control" id="room_capacity" name="room_capacity" placeholder="Enter room capacity" value="{{$room->room_capacity}}" />
                                                                 <div id="room_capacity_error"></div>
                                                             </div>
                                                      </div>
                                                         
                                                         
                                                         
                                                         <div class="form-group row" id="room_status_div">
                                                             <label class="col-lg-4 offset-lg-1 col-xl-4 offset-xl-1 control-label" for="room_status"> Room status</label>
                                                             <div class="col-lg-7 col-xl-7">
                                                                  <select class="form-control" name="room_status" id="room_status">
                                                                          <option value="">Select room status</option>
                                                                          <option @if ($room->room_status == 'Good') selected @endif>Good</option>
                                                                          <option @if ($room->room_status == 'Under maintenance') selected @endif>Under maintenance</option>
                                                                  </select>
                                                                  <div id="room_status_error"></div>
                                                             </div>
                                                         </div>
                                                                              
                                                        
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success"  >Update</button>
                              
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </tbody>

        </table>

        @if ($dorm_rooms->isEmpty())
            <p style="color: red;">There are no rooms that have been added to the dormitory!!</p>
        @endif


   </div>
</div>

        
@endsection