@extends('layouts.dashboard')

@section('content')

<?php 

$i = 1;

?>

            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Fee structure</h1>

                </div>
            </div>

            

             <div class="panel panel-primary w-auto">
                             <div class="panel-heading">
                               Current fee structures for term {{$term}}  {{$year}}
                             </div>
                               @csrf
                                <div class="panel-body">
                                        <div>
                                                @if ( Session::get('fee_strucure_saved') != null)
                                            
                                                <div class="alert alert-success alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Success</strong> : {{ Session::get('fee_strucure_saved')}}
                                                </div>
                                            
                                                @endif
                                            </div>

                                            <div >
                                                    @if ( Session::get('fee_failed') != null)
                                                
                                                    <div class="alert alert-danger alert-dismissible">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            <strong>Failed</strong> : {{ Session::get('fee_failed')}}
                                                    </div>
                                                
                                                    @endif
                                                </div>

                                            <div >
                                                    @if ( Session::get('fee_updated_successfully') != null)
                                                
                                                    <div class="alert alert-success alert-dismissible">
                                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                            <strong>Success</strong> : {{ Session::get('fee_updated_successfully')}}
                                                    </div>
                                                
                                                    @endif
                                                </div>

                                                <div >
                                                        @if ( Session::get('fee_structure_not_set') != null)
                                                    
                                                        <div class="alert alert-info alert-dismissible">
                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                <strong>Error</strong> : {{ Session::get('fee_structure_not_set')}}
                                                        </div>
                                                    
                                                        @endif
                                                    </div>

                                                @if ($no_term_session ?? '' != null)

                                                <div >
                                                        @if ( Session::get('no_active_session') != null)
                                                    
                                                        <div class="alert alert-info alert-dismissible">
                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                                <strong>Error</strong> : {{ Session::get('no_active_session')}}
                                                        </div>
                                                    
                                                        @endif
                                                    </div>

                                                    
                                                @endif


                                                
                             
                                        <table class="table table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl" id="fee_structure_table">
                                                <thead class="active">
                                                    <th class="table-secondary">S/NO</th>
                                                    <th class="table-secondary">Academic Year</th>
                                                    <th class="table-secondary">Class name</th>
                                                    <th class="table-secondary">Term</th>
                                                    <th class="table-secondary">Total fees</th>
                                                    <th class="table-secondary">Action</th>
                                                </thead>
                                            
                                                <tbody>

                                                    @if (!$fee_structure->isEmpty())
                                                        @foreach ($fee_structure as $school_fees )
                                                            <tr>
                                                                <td>{{ $i++ }}</td>                                      
                                                                <td>{{ $school_fees->year}} </td>                                      
                                                                <td>{{ $school_fees->class}} </td>                                                                                   
                                                                <td>{{ $school_fees->term}} </td>                                      
                                                                <td>{{ $school_fees->fee}} </td>                                      
                                                                <td>
                                                                        <button type="button" name="edit_fee{{$school_fees->id}}" data-toggle="modal" data-target="#edit_fee{{$school_fees->id}}" id="add_marks" class="btn btn-primary">Edit</button>
    
                                                                </td>

                                                                <!-- modal for removing student marks from the database -->

                        <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-lg-12 col-xl-12">
                                        <div class="modal" id="edit_fee{{$school_fees->id}}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title pull-left">Edit form {{ $school_fees->class }} total fees</h4>
                                                        <button class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
    
                                                        <form action="/update_fee_structure" method="POST" name="fee_structure_update_form">
    
    
                                                            <input type="hidden" name="id" value="{{$school_fees->id}}"/>
                                                            <input type="hidden" name="class_name" value="{{$school_fees->class}}"/>

                                                        @csrf
                                                        <div>
                                                                <div class="form-group" id="total_fees_div">
                                                                        <label for="total_fees">Total fees</label>
                                                                <input type="number" id="total_fees{{$school_fees->id}}" class="form-control" name="total_fees" value="{{$school_fees->fee}}" >
                                                                        <div id="total_fees_error"></div>
                                                                </div>
                                                    
                                                        </div>
                                                       
                                                        <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success" name="update">Update</button>
                                                                    
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
                                                    @endif

                                                </tbody>
                                        </table>
            

                               
                           
                             </div>
                             
                              
                                
                              </div>
                                 
      
    

    
@endsection

