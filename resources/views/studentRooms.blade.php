@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Student rooms</h1>
    </div>
</div>
<?php $i = 1;
    $student_has_room = false;

?>
 <div style="margin-top: 10px;">
        @if ( Session::get('room_deallocated') != null)
    
        <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success</strong> : {{ Session::get('room_deallocated')}}
        </div>
    
        @endif
    </div>

    <div style="margin-top: 10px;">
            @if ( Session::get('deallocation_failed') != null)
        
            <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Failed</strong> : {{ Session::get('deallocation_failed')}}
            </div>
        
            @endif
    </div>

    <div style="margin-top: 10px;">
        @if ( Session::get('allocation_successful') != null)
    
        <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success</strong> : {{ Session::get('allocation_successful')}}
        </div>
    
        @endif
    </div>

    <div style="margin-top: 10px;">
        @if ( Session::get('allocation_failed') != null)

        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('allocation_failed')}}
        </div>

        @endif
    </div>



    <div style="margin-top: 10px;">
        @if ( Session::get('room_update_successful') != null)
    
        <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success</strong> : {{ Session::get('room_update_successful')}}
        </div>
    
        @endif
    </div>

    <div style="margin-top: 10px;">
        @if ( Session::get('room_updated_failed') != null)

        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('room_updated_failed')}}
        </div>

        @endif
    </div>


<div class="panel panel-default w-auto">
    <div class="panel-heading">
      Form {{$className}} student rooms
    </div>
       <div class="panel-body">
       
            <table class="table table-hover table-responsive-sm table-responsive-md " id="student_rooms_table">
                    <thead class="active">
                        <th>#NO</th>
                        <th>ADM No.</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Dormitory</th>
                        <th>Room</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$student->admission_number}}</td>
                                <td>{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}</td>
                                <td>{{$student->class}}</td>

                                <?php $allocated = false;
                                    $student_room_id = 0;
                                 ?>
                                @foreach ($student_rooms as $student_room)
                                    @if ($student->id == $student_room->student_id)
                                        @foreach ($dorm_rooms as $dorm_room)
                                            @if ($dorm_room->id == $student_room->room_id)
                                                <td>{{$dorm_room->name}}</td>
                                                <td>{{$dorm_room->room_no}}</td>
                                                 <?php 
                                                    $allocated = true;
                                                    $student_room_id = $student_room->id;
                                                break; ?>                                                
                                            @endif
                                        @endforeach                                   
                                    @endif
                                @endforeach

                                @if (!$allocated)
                                    <td>Not allocated</td>
                                    <td>Not allocated</td>
                                    <?php $allocated = false; ?>
                                @endif

                              <td>
                                  <a href="/accommodation_facility/studentRooms/allocate/{{$student->id}},{{$className}}"><button type="button" name="add_button" class="btn btn-outline-success btn-sm" @if ($allocated)
                                      disabled
                                  @endif>Allocate</button></a>
                                  <a href="/accommodation_facility/studentRooms/editAllocatedRoom/{{$student->id}},{{$className}}"><button type="button" name="edit_button" class="btn btn-outline-primary btn-sm" @if (!$allocated)
                                      disabled
                                  @endif>Edit</button></a>
                                  <button type="button" name="remove_button" class="btn btn-outline-danger btn-sm" @if (!$allocated)
                                      disabled
                                  @endif data-toggle="modal" data-target="#deallocate{{$student->id}}">Deallocate</button>

                              </td>  

                              <!--modal for confirmation before deallocating a room from student -->
                              <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-lg-12 col-xl-12">
                                        <div class="modal" id="deallocate{{$student->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title pull-left" style="color: red;">Deallocate student room</h4>
                                                        <button class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
    
                                                        <form action="/accommodation_facility/studentRooms/deallocateRoom" method="POST">
    
                                                            <input type="hidden" name="className" value="{{$className}}"/>
    
                                                            <input type="hidden" name="student_room_id" value="{{$student_room_id}}"/>
    
                                                        @csrf
                                                        <p>Are you sure you want to dellaocate the room from the student?</p>
    
                                                        <div class="modal-footer">
                                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-danger" name="deallocate">Deallocate</button>
                                                                    
                                                        </div>
    
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </tr>
                        @endforeach
                    </tbody>
            </table>
       </div>
</div>

                
    
@endsection