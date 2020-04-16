@extends('layouts.dashboard')

@section('content')
    

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line"> {{$dormName}} dormitory</h1>
    </div>
</div>
<?php $i = 1; ?>
<div class="panel panel-default w-auto">
<div class="panel-heading">
  {{$dormName}} dormitory rooms
</div>
   <div class="panel-body">

        <a href="/accommodation_facility/dormitory/{{$dormID}}/addNewRoom" style="float:right; margin-bottom: 10px; position: relative;" class="btn btn-outline-primary">Add room</a>


        <table class="table table-hover table-responsive-sm table-responsive-md">
                <thead class="active">
                    <th class="table-secondary">No #</th>
                    <th class="table-secondary">Room number</th>
                    <th class="table-secondary">Capacity</th>
                    <th class="table-secondary">Room status</th>
                    <th class="table-secondary">Action</th>
                </thead>
            
                <tbody>

                    @if (!$dorm_rooms->isEmpty())
                        @foreach ($dorm_rooms as $room )
                            <tr>
                                <td>{{ $i++}}</td>
                                <td>{{$room->room_no}}</td>
                                <td>{{$room->room_capacity}}</td>
                                <td>{{$$room->room_status}}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-success btn-sm" name="edit_room{{$room->id}}" data-toggle="modal" data-target="#edit_room_modal{{$room->id}}" id="edit_room{{$room->id}}">Edit</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm" name="remove_room{{$room->id}}" data-toggle="modal" data-target="#remove_room_modal{{$room->id}}" id="remove_room{{$room->id}}">Remove</button>
                                </td>
                            </tr>
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