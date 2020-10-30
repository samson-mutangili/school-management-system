@extends('layouts.dashboard')

@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Term session</h1>
        </div>
</div>

<ul class="nav nav-tabs">
        <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#general_dates">General term status</a>
              </li>
    <li class="nav-item">
      <a class="nav-link " data-toggle="tab" href="#exam_sessions">Exam sessions</a>
    </li>
         
  </ul>
  <?php $i = 1; $date = date('Y-m-d');?>

  <div style="margin-top: 15px;">
        <div>
                @if ( Session::get('term_successfully_set') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('term_successfully_set')}}
                </div>
            
                @endif
              </div> 
      
              <div>
                @if ( Session::get('term_not_set') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('term_not_set')}}
                </div>
            
                @endif
              </div> 
      
      
              <div>
                @if ( Session::get('exam_session_set_successful') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('exam_session_set_successful')}}
                </div>
            
                @endif
              </div> 
      
              <div>
                @if ( Session::get('exam_session_removed') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('exam_session_removed')}}
                </div>
            
                @endif
              </div> 
      
              <div>
                @if ( Session::get('exam_session_fail') != null)
            
                <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Failed</strong> : {{ Session::get('exam_session_fail')}}
                </div>
            
                @endif
              </div> 
      
              <div>
                  @if ( Session::get('start_date_out') != null)
              
                  <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Failed</strong> : {{ Session::get('start_date_out')}}
                  </div>
              
                  @endif
              </div> 
      
              <div>
                  @if ( Session::get('end_date_out') != null)
              
                  <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Failed</strong> : {{ Session::get('end_date_out')}}
                  </div>
              
                  @endif
              </div> 
      
              <div>
                  @if ( Session::get('start_date_collide') != null)
              
                  <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Failed</strong> : {{ Session::get('start_date_collide')}}
                  </div>
              
                  @endif
              </div> 
      
              <div>
                  @if ( Session::get('end_date_collide') != null)
              
                  <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Failed</strong> : {{ Session::get('end_date_collide')}}
                  </div>
              
                  @endif
              </div> 
      
              <div>
                  @if ( Session::get('exam_session_update_successful') != null)
              
                  <div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Success</strong> : {{ Session::get('exam_session_update_successful')}}
                  </div>
              
                  @endif
              </div> 
      
              <div>
                  @if ( Session::get('exam_session_update_failed') != null)
              
                  <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Failed</strong> : {{ Session::get('exam_session_update_failed')}}
                  </div>
              
                  @endif
              </div> 
      
      
              <!-- show error messages for editing term details -->
              <div>
                  @if ( Session::get('term_start_date_error') != null)
              
                  <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Failed</strong> : {{ Session::get('term_start_date_error')}}
                  </div>
              
                  @endif
              </div> 
      
              <div>
                  @if ( Session::get('term_end_date_error') != null)
              
                  <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Failed</strong> : {{ Session::get('term_end_date_error')}}
                  </div>
              
                  @endif
              </div> 
      
      
              <div>
                  @if ( Session::get('term_start_exam_collide') != null)
              
                  <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Failed</strong> : {{ Session::get('term_start_exam_collide')}}
                  </div>
              
                  @endif
              </div> 
      
              <div>
                  @if ( Session::get('term_end_exam_collide') != null)
              
                  <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Failed</strong> : {{ Session::get('term_end_exam_collide')}}
                  </div>
              
                  @endif
              </div> 
      
      
              <div>
                  @if ( Session::get('term_update_successful') != null)
              
                  <div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Success</strong> : {{ Session::get('term_update_successful')}}
                  </div>
              
                  @endif
              </div> 
      
              <div>
                  @if ( Session::get('term_update_failed') != null)
              
                  <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Failed</strong> : {{ Session::get('term_update_failed')}}
                  </div>
              
                  @endif
              </div> 
      
      
              <!-- show error messages for ending term session -->
              <div>
                  @if ( Session::get('term_ended_success') != null)
              
                  <div class="alert alert-success alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Success</strong> : {{ Session::get('term_ended_success')}}
                  </div>
              
                  @endif
              </div> 
      
              <div>
                  @if ( Session::get('term_ended_failed') != null)
              
                  <div class="alert alert-danger alert-dismissible">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                          <strong>Failed</strong> : {{ Session::get('term_ended_failed')}}
                  </div>
              
                  @endif
              </div>

        <div class="tab-content">
                <div id="general_dates" class="tab-pane container active">
                        <div class="panel panel-primary w-auto">
                                <div class="panel-heading">
                                  Current session
                                </div>
                                   <div class="panel-body">
                                        @if (!$term_session->isEmpty())
                                        <h5 style="color: green; text-decoration:underline;">General term dates</h5>
                                          @foreach ($term_session as $active_term)
                                          <?php $term_id = $active_term->term_id; ?>
                                            <table>
                                              <tbody>
                                                  <tr>
                                                      <td align="left">Year  </td> 
                                                      <td> : {{$active_term->year}}</td>
                                                  </tr>
                                                  <tr>
                                                      <td align="left">Term</td>
                                                      <td> : {{$active_term->term}}</td>
                                                  </tr><tr>
                                                    <td align="left">Term start date  </td> 
                                                    <td> : {{$active_term->term_start_date}}</td>
                                                  </tr>
                                                  <tr>
                                                      <td align="left">Term end date</td>
                                                      <td> : {{$active_term->term_end_date}}</td>
                                                  </tr>
                                                  <tr>
                                                    <td align="left">Status</td>
                                                    <td @if($active_term->status == 'active') style="color:green;"@endif> : {{$active_term->status}}</td>
                                                </tr>
                          
                                                
                                              </tbody>
                                            </table>
                          
                                            <button name="term_edit" data-toggle="modal" data-target="#edit_term{{$active_term->term_id}}" class="btn btn-outline-primary" style="margin-right: 20px; margin-bottom: 10px;">Edit term dates</button>
                                            <button name="end_term" data-toggle="modal" data-target="#end_term{{$active_term->term_id}}" class="btn btn-outline-danger" style="margin-bottom: 10px;">End term session</button>
                          
                                            <!-- modal for editing term session dates -->
                                            <div class="container">
                                              <div class="row">
                                                  <div class="col-xs-12 col-lg-12 col-xl-12">
                                                      <div class="modal" id="edit_term{{$active_term->term_id}}" tabindex="-1">
                                                          <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                  <div class="modal-header">
                                                                  <h4 class="modal-title pull-left" >Edit term {{$active_term->term}} session dates</h4>
                                                                      <button class="close" data-dismiss="modal">&times;</button>
                                                                  </div>
                                                                  <div class="modal-body">
                          
                                                                      <form action="/term_sessions/edit_term_session" method="POST" class="form-horizontal" >
                                                                        @csrf
                          
                                                                          <input type="hidden" name="term_id" value="{{$active_term->term_id}}"/>                                                        
                          
                                                                          <div class="form-group row" id="term_start_date_div">
                                                                            <label class="col-lg-4  col-xl-4  control-label" for="start_date"> Term start date</label>
                                                                            <div class="col-lg-7 col-xl-7">
                                                                                    <input type="date"  class="form-control" id="term_start_date" name="term_start_date" required value="{{$active_term->term_start_date}}" />
                                                                                 <div id="term_start_date_error"></div>
                                                                            </div>
                                                                        </div>
                                        
                                                                        <div class="form-group row" id="term_end_date_div">
                                                                        
                                                                                <label class="col-lg-4  col-xl-4  control-label" for="term_end_date">Term end date</label>
                                                                        
                                                                            <div class="col-lg-7 col-xl-7">
                                                                            <input type="date" class="form-control" id="term_end_date" name="term_end_date" required value="{{$active_term->term_end_date}}"/>
                                                                                <div id="term_end_date_error"></div>
                                                                            </div>
                                                                      </div>
                                                                     
                                                                      <div class="modal-footer">
                                                                                  <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                                                                                  <button type="submit" class="btn btn-outline-success" name="update">Update</button>
                                                                                  
                                                                      </div>
                          
                                                                  </form>
                                                                  </div>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                          
                                           <!-- modal for end term session -->
                                           <div class="container">
                                              <div class="row">
                                                  <div class="col-xs-12 col-lg-12 col-xl-12">
                                                      <div class="modal" id="end_term{{$active_term->term_id}}" tabindex="-1">
                                                          <div class="modal-dialog">
                                                              <div class="modal-content">
                                                                  <div class="modal-header">
                                                                  <h4 class="modal-title pull-left" style="color: red;" >End term {{$active_term->term}} session</h4>
                                                                      <button class="close" data-dismiss="modal">&times;</button>
                                                                  </div>
                                                                  <div class="modal-body">
                          
                                                                      <form action="/term_sessions/end_term_session" method="POST" class="form-horizontal" >
                                                                        @csrf
                          
                                                                        <input type="hidden" name="term_id" value="{{$active_term->term_id}}"/>
                                                                        <input type="hidden" name="end_date" value="{{$date}}" />
                                                                          <p>Are you sure you want to end term {{$active_term->term}} session? Note that this will result to ending the term session end dates as at {{$date}}</p>
                                                                      <div class="modal-footer">
                                                                                  <button type="button" class="btn btn-outline-success" data-dismiss="modal">Cancel</button>
                                                                                  <button type="submit" class="btn btn-outline-danger" name="update">End term session</button>
                                                                                  
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
                                          @else
              The current term session has not been set. <a href="/term_sessions/new">Click here</a> to set a new term session.  
             
                                        @endif
                                        

                                   </div>
                        </div>
                </div>

                <div id="exam_sessions" class="tab-pane container fade">

                        <div class="panel panel-primary w-auto">
                                <div class="panel-heading">
                                  Exam sessions
                                </div>
                                   <div class="panel-body">

                                    @if (!$term_session->isEmpty())
                                    <a href="/term_session/set_exam_session/{{$term_id}}"> <button class="btn btn-outline-primary " style="margin-bottom: 10px;">Set exam session</button></a>
                                     <table class="table table-hover table-responsive-sm table-responsive-md" id="exams_table">
                                       <thead class="active">
                                           <th>No #</th>
                                           <th>Year</th>
                                           <th>Term</th>
                                           <th>Exam type</th>
                                           <th>Start date</th>
                                           <th>End date</th>
                                           <th>Status</th>
                                           <th>Action</th>
                                       </thead>
                                   
                                       <tbody>
                                           @if (!$exam_sessions->isEMpty())
                                               @foreach ($exam_sessions as $exam)
                                                   <tr>
                                                       <td>{{$i++}}</td>
                                                       <td>{{$exam->year}}</td>
                                                       <td>{{$exam->term}}</td>
                                                       <td>{{$exam->exam_type}}</td>
                                                       <td>{{$exam->exam_start_date}}</td>
                                                       <td>{{$exam->exam_end_date}}</td>
                                                       @if ($exam->exam_status == "active")
                                                          <td style="color:green;">{{$exam->exam_status}}</td>
                                                       @elseif($exam->exam_status == "past")
                                                         <td style="color:red;">{{$exam->exam_status}}</td>
                                                       @else
                                                         <td>{{$exam->exam_status}}</td>
                                                       @endif
                                                       <td>
                                                           <button name="edit" id="edit_btn" data-toggle="modal" data-target="#edit_exam_session{{$exam->exam_id}}" class="btn btn-outline-primary btn-sm">Edit</button>
                                                           <button name="remove" id="remove_btn" data-toggle="modal" data-target="#remove_exam_session{{$exam->exam_id}}" class="btn btn-outline-danger btn-sm">Remove</button>  
                                                       </td>
                                                   </tr>
                     
                                                   <!-- modal for editing exam session dates -->
                                                   <div class="container">
                                                     <div class="row">
                                                         <div class="col-xs-12 col-lg-12 col-xl-12">
                                                             <div class="modal" id="edit_exam_session{{$exam->exam_id}}" tabindex="-1">
                                                                 <div class="modal-dialog">
                                                                     <div class="modal-content">
                                                                         <div class="modal-header">
                                                                         <h4 class="modal-title pull-left" >Edit {{$exam->exam_type}} session dates</h4>
                                                                             <button class="close" data-dismiss="modal">&times;</button>
                                                                         </div>
                                                                         <div class="modal-body">
                         
                                                                             <form action="/term_sessions/edit_exam_session" method="POST" class="form-horizontal" >
                                                                               @csrf
                         
                                                                                 <input type="hidden" name="exam_id" value="{{$exam->exam_id}}"/>
                                                                                 <input type="hidden" name="term_id" value="{{$exam->term_id}}"/>
                                                                                 <input type="hidden" name="exam_type" value="{{$exam->exam_type}}"/>                                                            
                     
                                                                                 <div class="form-group row" id="exam_start_date_div">
                                                                                   <label class="col-lg-4  col-xl-4  control-label" for="start_date"> Exam start date</label>
                                                                                   <div class="col-lg-7 col-xl-7">
                                                                                           <input type="date"  class="form-control" id="exam_start_date" name="exam_start_date" required value="{{$exam->exam_start_date}}" />
                                                                                        <div id="exam_start_date_error"></div>
                                                                                   </div>
                                                                               </div>
                                               
                                                                               <div class="form-group row" id="exam_end_date_div">
                                                                               
                                                                                       <label class="col-lg-4  col-xl-4  control-label" for="exam_end_date">Exam end date</label>
                                                                               
                                                                                   <div class="col-lg-7 col-xl-7">
                                                                                   <input type="date" class="form-control" id="exam_end_date" name="exam_end_date" required value="{{$exam->exam_end_date}}"/>
                                                                                       <div id="exam_end_date_error"></div>
                                                                                   </div>
                                                                             </div>
                                                                            
                                                                             <div class="modal-footer">
                                                                                         <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                                                                                         <button type="submit" class="btn btn-outline-success" name="update">Update</button>
                                                                                         
                                                                             </div>
                         
                                                                         </form>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
                     
                                                   <!-- modal for confirmation before removing examination session -->
                                                     <div class="container">
                                                     <div class="row">
                                                         <div class="col-xs-12 col-lg-12 col-xl-12">
                                                             <div class="modal" id="remove_exam_session{{$exam->exam_id}}" tabindex="-1">
                                                                 <div class="modal-dialog">
                                                                     <div class="modal-content">
                                                                         <div class="modal-header">
                                                                         <h4 class="modal-title pull-left" style="color:red;">Remove exam session</h4>
                                                                             <button class="close" data-dismiss="modal">&times;</button>
                                                                         </div>
                                                                         <div class="modal-body">
                         
                                                                             <form action="/term_sessions/remove_exam_session" method="POST" >
                                                                               @csrf
                         
                                                                                 <input type="hidden" name="exam_id" value="{{$exam->exam_id}}"/>
                     
                                                                             
                                                                             <p>Are you sure you want to remove {{$exam->exam_type}} session?</p>
                                                                            
                                                                             <div class="modal-footer">
                                                                                         <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                                                                                         <button type="submit" class="btn btn-outline-success" name="update">Remove</button>
                                                                                         
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
                                           @else
                                           @endif
                                       </tbody>
                                     </table>
                                     @else
              The current term session has not been set. <a href="/term_sessions/new">Click here</a> to set a new term session.  
            
                                    @endif

                                   </div>
                        </div>
                    
                    </div>

        </div>

  </div>
    

@endsection