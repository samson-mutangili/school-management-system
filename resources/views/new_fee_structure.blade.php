@extends('layouts.dashboard')

@section('content')

<?php

$year = date("Y");

?>
<div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Fee structure</h1>

                </div>
            </div>

            @if (Session::get('no_active_term') != "" || Session::get('no_active_term') != null)
                <div class="alert alert-danger">
                    {{ Session::get('no_active_term')}}
                </div>
            @elseif(Session::get('all_classes_fee_set') != "" || Session::get('all_classes_fee_set') != null)
                <div class="alert alert-danger">
                    {{ Session::get('all_classes_fee_set')}}
                </div>

            @else
                
            
            

            <div class="row">
                        
    
                <div class="col-sm-10 offset-sm-1  col-md-10 0ffset-md-1  col-lg-10   col-xl-8 offset-xl-2">
                    
                                <div>
                                                @if ( Session::get('form1_fee_set') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('form1_fee_set')}}
                                                </div>
                                            
                                                @endif
                                 </div>    
                                
                                 <div>
                                                @if ( Session::get('form2_fee_set') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('form2_fee_set')}}
                                                </div>
                                            
                                                @endif
                                </div>  
                
        
        
                                <div>
                                                @if ( Session::get('form3_fee_set') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('form3_fee_set')}}
                                                </div>
                                            
                                                @endif
                                </div>   
        
                        
                                <div>
                                                @if ( Session::get('form4_fee_set') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('form4_fee_set')}}
                                                </div>
                                            
                                                @endif
                                 </div>  
                                 <div>
                                                @if ( Session::get('fee_set') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('fee_set')}}
                                                </div>
                                            
                                                @endif
                                 </div>  

                       

                        <div class="panel panel-primary w-auto">
                             <div class="panel-heading">
                               Add new fee structure
                             </div>
                             <form action="/save_fee_structure" method="post" class="form-horizontal" name="fee_structure_form">
                                @csrf
                                <div class="panel-body">
                             
                             
                             
                             
                             <div class="form-group row" id="year_div">
                                 
                                        <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="year">Year</label>
                                
                                     <div class="col-lg-7 col-xl-7">
                                         <input type="number" readonly class="form-control" id="year" name="year" value=<?php echo $year; ?> />
                                         
                                     </div>
                              </div>
                                 
                                 
                                 <div class="form-group row" id="class_name_div">
                                     <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="class_name"> Class</label>
                                     <div class="col-lg-7 col-xl-7">
                                          <select class="form-control" name="class_name" id="class" required>
                                                  <option value="">Select class</option>
                                                  @if ($form1_set->isEmpty() && $form2_set->isEmpty() && $form3_set->isEmpty() && $form4_set->isEmpty())
                                                     <option value="All">All classes</option>
                                                  @endif

                                                  @if ($form1_set->isEmpty())
                                                     <option value="Form 1">Form 1</option>
                                                  @endif
                                                  
                                                  @if ($form2_set->isEmpty())
                                                    <option value="Form 2">Form 2</option>
                                                  @endif

                                                  @if ($form3_set->isEmpty())
                                                     <option value="Form 3">Form 3</option>
                                                  @endif

                                                  @if ($form4_set->isEmpty())
                                                     <option value="Form 4">Form 4</option>
                                                  @endif
                                                                                                 
                                                 
                                          </select>
                                          <div id="class_name_error"></div>
                                     </div>
                                 </div>

                                 <div class="form-group row" id="term_div">
                                                <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="term"> Term</label>
                                                <div class="col-lg-7 col-xl-7">
                                                     <select class="form-control" name="term" id="term" required>
                                                             <option value="">Select term</option>
                                                            <option value="{{$term}}">Term {{$term}}</option>
                                                     </select>
                                                     <div id="term_error"></div>
                                                </div>
                                 </div>

                                 <div class="form-group row" id="total_fees_div">
                                 
                                        <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="total_fees">Total fees</label>
                                
                                     <div class="col-lg-7 col-xl-7">
                                         <input type="number" class="form-control" id="total_fees" name="total_fees" placeholder="Enter total fees"/>
                                         <div id="total_fees_error"></div>
                                     </div>
                              </div>
                             
                             <div class="form-group row">
                                     <div class="col-lg-7 offset-lg-4 col-xl-7 offset-xl-4">
                                         <button type="submit" name="save" class="btn btn-primary "  onclick="return validateFeeStructure()">Save </button>
                                     </div>
                                 </div>
                              
                             
                             </div>
                             </form>
                             
                              
                                
                              </div>
                                 
                             </div>
                                 </div>

            @endif
        </div>
</div>
    



@endsection