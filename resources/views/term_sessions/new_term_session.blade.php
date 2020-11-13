@extends('layouts.dashboard')

@section('content')

<?php

$year = date("Y");

?>
<div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line" style="text-align: center;">Add term session</h1>

                </div>
            </div>

            @if ($term->isEmpty())
                
            

            <div class="row">
                        
    
                <div class="col-sm-10 offset-sm-1  col-md-10 0ffset-md-1  col-lg-10   col-xl-8 offset-xl-2">
                    
                                <div>
                                                @if ( Session::get('days_negative') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('days_negative')}}
                                                </div>
                                            
                                                @endif
                                 </div>    
                                
                                 <div>
                                                @if ( Session::get('term_too_short') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('term_too_short')}}
                                                </div>
                                            
                                                @endif
                                </div>  
                
        
        
                                <div>
                                                @if ( Session::get('term_too_long') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('term_too_long')}}
                                                </div>
                                            
                                                @endif
                                </div>   
        
                        
                                <div>
                                                @if ( Session::get('term_already_set') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('term_already_set')}}
                                                </div>
                                            
                                                @endif
                                 </div>  
                                 <div>
                                                @if ( Session::get('start_past_dates') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('start_past_dates')}}
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
                                        @if ( Session::get('term_start_date_collide') != null)
                                
                                        <div class="alert alert-danger alert-dismissible">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Failed</strong> : {{ Session::get('term_start_date_collide')}}
                                        </div>
                                
                                        @endif
                                </div>    
                
                                <div>
                                        @if ( Session::get('term_end_date_collide') != null)
                                
                                        <div class="alert alert-danger alert-dismissible">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong>Failed</strong> : {{ Session::get('term_end_date_collide')}}
                                        </div>
                                
                                        @endif
                                 </div> 
                        <div class="panel panel-primary w-auto">
                             <div class="panel-heading">
                               Set a new term session
                             </div>
                             <form action="/term_session/set_current_session" method="post" class="form-horizontal" name="new_session_form">
                                @csrf
                                <div class="panel-body">
                             
                             
                             
                             
                             <div class="form-group row" id="year_div">
                                 
                                        <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="year">Year</label>
                                
                                     <div class="col-lg-7 col-xl-7">
                                         <input type="number" readonly class="form-control" id="year" name="year" value=<?php echo $year; ?> />
                                         
                                     </div>
                              </div>
                                 
                                 
                                 <div class="form-group row" id="term_div">
                                     <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="term"> Term</label>
                                     <div class="col-lg-7 col-xl-7">
                                          <select class="form-control" name="term" id="term" required>
                                                  <option value="">Select term</option>
                                                  <option value="1" @if ($term ?? '' == 1) selected @endif>Term 1</option>
                                                  <option value="2" @if ($term ?? '' == 2) selected @endif>Term 2</option>
                                                  <option value="3" @if ($term ?? '' == 3) selected @endif>Term 3</option>
                                          </select>
                                          <div id="term_error"></div>
                                     </div>
                                 </div>

                                 <div class="form-group row" id="start_date_div">
                                                <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="start_date"> Start date</label>
                                                <div class="col-lg-7 col-xl-7">
                                                        <input type="date"  class="form-control" id="start_date" name="start_date" required value="{{$start_date ?? ''}}" />
                                                     <div id="start_date_error"></div>
                                                </div>
                                 </div>

                                 <div class="form-group row" id="end_date_div">
                                 
                                        <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="end_date">End date</label>
                                
                                     <div class="col-lg-7 col-xl-7">
                                     <input type="date" class="form-control" id="end_date" name="end_date" required value="{{$end_date ?? ''}}"/>
                                         <div id="end_date_error"></div>
                                     </div>
                              </div>
                             
                             <div class="form-group row">
                                     <div class="col-lg-7 offset-lg-4 col-xl-7 offset-xl-4">
                                         <button type="submit" name="Set_session" class="btn btn-success " >Set session </button>
                                     </div>
                                 </div>
                              
                             
                             </div>
                             </form>
                             
                              
                                
                              </div>
                                 
                             </div>
                                 </div>

         @else
         <div class="alert alert-danger">
                <p style="text-align: center; font-style: Sans-serif;">There is already an active term session. A new term session
                can only be added if there are no other active term sessions!!. However, you can edit the current term session under "current session " link
                </p>
         </div>
                
            @endif
        </div>
</div>
    



@endsection