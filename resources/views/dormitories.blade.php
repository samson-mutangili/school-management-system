@extends('layouts.dashboard')

@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Dormitories</h1>
        </div>
</div>
    <?php $i = 1; ?>
<div class="panel panel-default w-auto">
    <div class="panel-heading">
      Available dormitories
    </div>
       <div class="panel-body">
            <button style="float:right; margin-bottom: 10px;" type="button" name="add_dormitory" data-toggle="modal" data-target="#add_dormitory_modal" id="add_dormitory" class="btn btn-outline-primary">Add new dormitory</button>


            <table class="table table-hover table-responsive-sm table-responsive-md">
                    <thead class="active">
                        <th class="table-secondary">No #</th>
                        <th class="table-secondary">Dormitory name</th>
                        <th class="table-secondary">Rooms</th>
                        <th class="table-secondary">Capacity</th>
                        <th class="table-secondary">Available capacity</th>
                        <th class="table-secondary">Status</th>
                    </thead>
                
                    <tbody>
                        @if ($dormitories->isEmpty())
                            @foreach ($dormitories as $dorm )
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$dorm->name}}</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>{{$dorm->status}}</td>
                                </tr>
                            @endforeach
                            
                        @endif
                    </tbody>

            </table>

            @if ($dormitories->isEmpty())
                <p style="color: red;">There are no available dormitories</p>
            @endif

            <!-- modal for viewing student marks data -->

            
       </div>

       

</div>

<div class="container">
        <div class="row">
            <div class="col-xs-12 col-lg-12 col-xl-12">
                <div class="modal" id="add_dormitory_modal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title pull-left">Add new dormitory</h4>
                                <button class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">

                                <form action="" method="POST" name="dormitory_form">
                                    @csrf

                                    <div class="form-group row" id="name_div">
                     
                                        <label class="col-lg-2 offset-lg-1 col-xl-2 offset-xl-1 control-label" for="name">Name</label>
                                    
                                         <div class="col-lg-7 col-xl-7">
                                             <input type="name" class="form-control" id="name" name="name" placeholder="Enter dormitory name"  />
                                             <div id="name_error"></div>
                                         </div>
                                     </div>

                                     <div class="form-group row" id="name_div">
                     
                                            <label class="col-lg-2 offset-lg-1 col-xl-2 offset-xl-1 control-label" for="dorm_status">Status</label>
                                        
                                             <div class="col-lg-7 col-xl-7">
                                                 <select name="dorm_status" class="form-control">
                                                     <option value="">Select dormitory status</option>
                                                     <option>Good</option>
                                                     <option>Under maintenance</option>
                                                     <option>Under construction</option>
                                                     <option>Unhabitable</option>

                                                 </select>
                                                 <div id="name_error"></div>
                                             </div>
                                         </div>
                                     
                                    
                                
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-success" >Add</button>
      
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
                        
    
@endsection