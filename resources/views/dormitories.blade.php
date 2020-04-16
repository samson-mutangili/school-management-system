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
            
            <div>
                @if ( Session::get('dorm_exists') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('dorm_exists')}}
                </div>
            
                @endif
            </div>  

            <div>
                @if ( Session::get('name_empty') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('name_empty')}}
                </div>
            
                @endif
            </div>

            <div>
                @if ( Session::get('dorm_inserted') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('dorm_inserted')}}
                </div>
            
                @endif
            </div>  

            <div>
                @if ( Session::get('dorm_updated') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('dorm_updated')}}
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

            <button style="float:right; margin-bottom: 10px; position: relative;" type="button" name="add_dormitory" data-toggle="modal" data-target="#add_dormitory_modal" id="add_dormitory" class="btn btn-outline-primary">Add new dormitory</button>


            <table class="table table-hover table-responsive-sm table-responsive-md">
                    <thead class="active">
                        <th class="table-secondary">No #</th>
                        <th class="table-secondary">Dormitory name</th>
                        <th class="table-secondary">Rooms</th>
                        <th class="table-secondary">Capacity</th>
                        <th class="table-secondary">Available capacity</th>
                        <th class="table-secondary">Status</th>
                        <th class="table-secondary">Action</th>
                    </thead>
                
                    <tbody>
                        @if (!$dormitories->isEmpty())
                            @foreach ($dormitories as $dorm )
                                <tr  data-href='/accommodation_facility/dormitory/{{$dorm->id}}'>
                                    <td>{{$i++}}</td>
                                    <td>{{$dorm->name}}</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>{{$dorm->status}}</td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-sm" name="edit_dorm{{$dorm->id}}" data-toggle="modal" data-target="#edit_dorm_modal{{$dorm->id}}" id="edit_dorm{{$dorm->id}}">Edit</button>
                                    </td>
                                </tr>

                                <div class="container">
                                        <div class="row">
                                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                                <div class="modal" id="edit_dorm_modal{{$dorm->id}}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title pull-left">Edit dormitory details</h4>
                                                                <button class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                
                                                                <form action="/accommodation_facility/updateDormitory" method="POST" name="dormitory_form">
                                                                    @csrf
                                                                    
                                                                    <input type="hidden" name="dorm_id" value="{{$dorm->id}}" />
                                                                    <div class="form-group row" id="dorm_name_div">
                                                     
                                                                        <label class="col-lg-2 offset-lg-1 col-xl-2 offset-xl-1 control-label" for="dorm_name">Name</label>
                                                                    
                                                                         <div class="col-lg-7 col-xl-7">
                                                                             <input type="name" class="form-control" id="dorm_name" name="dorm_name" placeholder="Enter dormitory name" value="{{$dorm->name}}"  />
                                                                             <div id="dorm_name_error"></div>
                                                                         </div>
                                                                     </div>
                                
                                                                     <div class="form-group row" id="dorm_status_div">
                                                     
                                                                            <label class="col-lg-2 offset-lg-1 col-xl-2 offset-xl-1 control-label" for="dorm_status">Status</label>
                                                                        
                                                                             <div class="col-lg-7 col-xl-7">
                                                                                 <select name="dorm_status" class="form-control">
                                                                                     
                                                                                     <option @if ($dorm->status == "Under maintenance") selected  @endif>Under maintenance</option>
                                                                                     <option @if ($dorm->status == "Under construction") selected  @endif>Under construction</option>
                                                                                     <option @if ($dorm->status == "Good") selected  @endif>Good</option>
                                                                                     <option @if ($dorm->status == "Unhabitable") selected  @endif>Unhabitable</option>
                                
                                                                                 </select>
                                                                                 <div id="dorm_status_error"></div>
                                                                             </div>
                                                                         </div>
                                                                     
                                                                    
                                                                
                                                                    <div class="modal-footer">
                                                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

                                <form action="/accommodation_facility/addNewDormitory" method="POST" name="dormitory_form">
                                    @csrf

                                    <div class="form-group row" id="dorm_name_div">
                     
                                        <label class="col-lg-2 offset-lg-1 col-xl-2 offset-xl-1 control-label" for="dorm_name">Name</label>
                                    
                                         <div class="col-lg-7 col-xl-7">
                                             <input type="name" class="form-control" id="dorm_name" name="dorm_name" placeholder="Enter dormitory name"  />
                                             <div id="dorm_name_error"></div>
                                         </div>
                                     </div>

                                     <div class="form-group row" id="dorm_status_div">
                     
                                            <label class="col-lg-2 offset-lg-1 col-xl-2 offset-xl-1 control-label" for="dorm_status">Status</label>
                                        
                                             <div class="col-lg-7 col-xl-7">
                                                 <select name="dorm_status" class="form-control">
                                                     <option value="">Select dormitory status</option>
                                                     <option>Good</option>
                                                     <option>Under maintenance</option>
                                                     <option>Under construction</option>
                                                     <option>Unhabitable</option>

                                                 </select>
                                                 <div id="dorm_status_error"></div>
                                             </div>
                                         </div>
                                     
                                    
                                
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            <button onclick="return validateDormitory()" type="submit" class="btn btn-success"  >Add</button>
      
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