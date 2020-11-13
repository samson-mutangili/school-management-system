@extends('layouts.dashboard')

@section('content')

<div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Older term session</h1>
        </div>
</div>

@if(!$term_session->isEmpty())


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
                                                    <td @if($active_term->status == 'active') style="color:green;"@else style="color: red;" @endif> : {{$active_term->status}}</td>
                                                </tr>
                          
                                                
                                              </tbody>
                                            </table>
                          
                                
                                         
                                          @endforeach   
                                          @else
                                                <p style="color: red;">No older term session</p>
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
                                     <table class="table table-hover table-responsive-sm table-responsive-md" id="exams_table">
                                       <thead class="active">
                                           <th>No #</th>
                                           <th>Year</th>
                                           <th>Term</th>
                                           <th>Exam type</th>
                                           <th>Start date</th>
                                           <th>End date</th>
                                           <th>Status</th>
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
                                                      
                                                   </tr>
                     
                                                 
                     
                                                
                                               @endforeach
                                           @else
                                           <p style="color: red;">No exam session available</p>
                                           @endif
                                       </tbody>
                                     </table>
                                     @else
                                     <p style="color: red;">No older term session</p>
            
                                    @endif

                                   </div>
                        </div>
                    
                    </div>

        </div>

  </div>
    @else
  <div class="alert alert-danger">
      There is no older session with the passed id. 
  </div>
  @endif
  </div>

@endsection