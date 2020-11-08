@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Parents</h1>
    </div>
</div>
<?php $i = 1;

?>
 

<div class="panel panel-primary w-auto">
    <div class="panel-heading">
      All parents
    </div>
       <div class="panel-body">

        <a href="/parents/add/newParent" class="btn btn-outline-primary" style="margin-bottom: 10px; float: right;" ><i class="fa fa-plus"></i> Add new parent</a>

            <div>
                    @if ( Session::get('parent_inserted_successfully') != null)
                
                    <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success</strong> : {{ Session::get('parent_inserted_successfully')}}
                    </div>
                
                    @endif
            </div>   

            <div>
                    @if ( Session::get('parent_insert_failed') != null)
                
                    <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Failed</strong> : {{ Session::get('parent_insert_failed')}}
                    </div>
                
                    @endif
            </div>   

            <div>
                @if ( Session::get('add_parent') != null)
            
                <div class="alert alert-info alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         {{ Session::get('add_parent')}}
                </div>
            
                @endif
        </div>   
       
            <table class="table table-hover table-responsive-sm table-responsive-md responsive-lg table-responsive-xl " id="students_deatils_table">
                    <thead class="active">
                        <th width="5%">#NO</th>
                        <th>Name</th>
                        <th>Phone no</th>
                        <th>Email</th>
                        <th>ID No.</th>
                        <th>Gender</th>
                        <th>Occupation</th>
                    </thead>

                    <tbody>

                        @if (!$parents->isEmpty())
                            @foreach ($parents as $parent)
                                <tr data-href='/parents/{{$parent->id}}'>
                                    <td>{{$i++}}</td>
                                    <td>{{$parent->first_name}}  {{$parent->middle_name}}  {{$parent->last_name}}</td>
                                    
                                    <td>{{$parent->phone_no}}</td>
                                    <td>{{$parent->email}}</td>
                                    <td>{{$parent->id_no}}</td>
                                    <td>{{$parent->gender}}</td>
                                    <td>{{$parent->occupation}}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
            </table>
       </div>
</div>

                
    
@endsection