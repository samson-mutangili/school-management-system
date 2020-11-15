@extends('layouts.dashboard')

@section('content')

<?php

$year = date("Y");

?>
<div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line" style="text-align: center; color: green;">Set exam sessions</h1>

                </div>
            </div>

            

            <div class="row">
                        
    
                <div class="col-sm-10 offset-sm-1  col-md-10 0ffset-md-1  col-lg-10   col-xl-8 offset-xl-2">
                    
                                <div>
                                                @if ( Session::get('no_active_term') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('no_active_term')}}
                                                </div>
                                            
                                                @endif
                                 </div>    
                                
                                 <div>
                                                @if ( Session::get('start_start_error') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('start_start_error')}}
                                                </div>
                                            
                                                @endif
                                </div>  
                
        
        
                                <div>
                                                @if ( Session::get('start_end_error') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('start_end_error')}}
                                                </div>
                                            
                                                @endif
                                </div>   
        
                        
                                <div>
                                                @if ( Session::get('end_start_error') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('end_start_error')}}
                                                </div>
                                            
                                                @endif
                                 </div>  
                                 <div>
                                                @if ( Session::get('end_end_error') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('end_end_error')}}
                                                </div>
                                            
                                                @endif
                                 </div>  

                                 <div>
                                    @if ( Session::get('end_past_dates') != null)
                                
                                    <div class="alert alert-danger alert-dismissible">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>Failed</strong> : {{ Session::get('end_past_dates')}}
                                    </div>
                                
                                    @endif
                              </div> 

                              <div>
                                        @if ( Session::get('exam_type_set_error') != null)
                                
                                        <div class="alert alert-danger alert-dismissible">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Failed</strong> : {{ Session::get('exam_type_set_error')}}
                                        </div>
                                
                                        @endif
                                </div> 

                                <div>
                                        @if ( Session::get('dates_error') != null)
                                
                                        <div class="alert alert-danger alert-dismissible">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Failed</strong> : {{ Session::get('dates_error')}}
                                        </div>
                                
                                        @endif
                                </div> 

                                <div>
                                        @if ( Session::get('exam_start_date_collide') != null)
                                
                                        <div class="alert alert-danger alert-dismissible">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Failed</strong> : {{ Session::get('exam_start_date_collide')}}
                                        </div>
                                
                                        @endif
                                </div> 


                                <div>
                                        @if ( Session::get('exam_end_date_collide') != null)
                                
                                        <div class="alert alert-danger alert-dismissible">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Failed</strong> : {{ Session::get('exam_end_date_collide')}}
                                        </div>
                                
                                        @endif
                                </div> 
                        <div class="panel panel-primary w-auto">
                             <div class="panel-heading">
                               Set exam session for term {{$term}}, {{$year}}
                             </div>
                             <form action="/term_session/set_exam_session" method="post" class="form-horizontal" name="exam_session_form">
                                @csrf
                                <div class="panel-body">
                            
                                 <input type="hidden" name="term_id" value="{{$term_id}}"/>
                                 <input type="hidden" name="year" value="{{$year}}"/>
                                 <input type="hidden" name="term" value="{{$term}}"/>
                                 
                                 <input type="hidden" name="current_date" value="{{date('Y-m-d')}}"/>
                                 
                                 <div class="form-group row" id="exam_type_div">
                                     <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="exam_type"> Exam type</label>
                                     <div class="col-lg-7 col-xl-7">
                                          <select class="form-control" name="exam_type" id="exam_type" required>
                                                  <option value="">Select term</option>
                                                  <option  @if ($exam_type ?? '' == 'Opener exam') selected @endif>Opener exam</option>
                                                  <option  @if ($exam_type ?? '' == 'Mid term exam') selected @endif>Mid term exam</option>
                                                  <option  @if ($exam_type ?? '' == 'End term exam') selected @endif>End term exam</option>
                                          </select>
                                          <div id="exam_type_error"></div>
                                     </div>
                                 </div>

                                 <div class="form-group row" id="exam_start_date_div">
                                                <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="start_date"> Exam start date</label>
                                                <div class="col-lg-7 col-xl-7">
                                                        <input type="date"  class="form-control" id="exam_start_date" name="exam_start_date" required value="{{$exam_start_date ?? ''}}" />
                                                     <div id="exam_start_date_error"></div>
                                                </div>
                                 </div>

                                 <div class="form-group row" id="exam_end_date_div">
                                 
                                        <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="exam_end_date">Exam end date</label>
                                
                                     <div class="col-lg-7 col-xl-7">
                                     <input type="date" class="form-control" id="exam_end_date" name="exam_end_date" required value="{{$exam_end_date ?? ''}}"/>
                                         <div id="exam_end_date_error"></div>
                                     </div>
                              </div>
                             
                             <div class="form-group row">
                                     <div class="col-lg-7 offset-lg-4 col-xl-7 offset-xl-4">
                                         <button type="submit" name="set_exam_session" class="btn btn-outline-primary " onclick="return validateExamDates()" >Set exam session </button>
                                     </div>
                                 </div>
                              
                             
                             </div>
                             </form>
                             
                              
                                
                              </div>
                                 
                             </div>
                                 </div>
        </div>
</div>
    



@endsection