@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Communications to parents</h1>
    </div>
</div>
<?php $i = 1;

?>
 

<div class="panel panel-default w-auto">
    <div class="panel-heading">
      {{$class_form ?? ''}} students
    </div>
       <div class="panel-body">

        

            <div>
                    @if ( Session::get('messages_send') != null)
                
                    <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success</strong> : {{ Session::get('messages_send')}}
                    </div>
                
                    @endif
            </div>   

            <div>
                    @if ( Session::get('class_not_found') != null)
                
                    <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Failed</strong> : {{ Session::get('class_not_found')}}
                    </div>
                
                    @endif
            </div>   

            <div>
                    @if ( Session::get('no_internet') != null)
                
                    <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Failed</strong> : {{ Session::get('no_internet')}}
                    </div>
                
                    @endif
            </div>  
           @if (!$students->isEmpty())
           <button name="sendMail" id="sendMailToAll" data-toggle="modal" data-target="#sendMailModal" style="float: right; margin-bottom: 10px;"  class="btn btn-outline-success">Send email to all parents</button>

           @endif
       
            <table class="table table-hover table-responsive-sm table-responsive-md " id="students_deatils_table">
                    <thead class="active">
                        <th width="5%">#NO</th>
                        <th>Picture</th>
                        <th>ADM No.</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Gender</th>
                    </thead>

                    <tbody>

                        @if (!$students->isEmpty())
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{$i++}}</td>
                                    @if ($student->profile_pic != null)
                                    
                                    <td><img class="img-profile rounded-circle"  style="width: 40px; height: 40px;" src="{{URL::asset('images/'.$student->profile_pic)}}" alt="Profile picture"> </td>

                                    @else
                                    <td><img class="img-profile rounded-circle"  style="width: 40px; height: 40px;" src="{{URL::asset('images/default_profile_pic.png')}} " alt="profile_picture"></td>

                                    @endif
                                    <td>{{$student->admission_number}}</td>
                                    <td>{{$student->first_name}}  {{$student->middle_name}}  {{$student->last_name}}</td>
                                    <td>{{$student->stream}}</td>
                                    <td>{{$student->gender}}</td>
                                </tr>
                            @endforeach
                            <!-- modal dialog form for archiving student -->
<div class="container">
        <div class="row">
            <div class="col-xs-12 col-lg-12 col-xl-12">
                <div class="modal" id="sendMailModal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title pull-left" >Send email to student parent(s)</h4>
                                <button class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                
                                            <form action="/communications/send_email" method = "POST" name="send_mail_dialog">
                                                @csrf
                                                <input type="hidden" name="class_name" value="{{$class_form}}"/>
                                                <p>All parents who have students in {{$class_form}} will receive this email</p>
                                                <div class="row">
                                                    <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                            <div class="form-group" id="subject_div">
                                                                    <label class="control-table" for="subject">Subject</label>
                                                                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter email subject" required>
                                                                    <div id="subject_error"></div>
                                                            </div>	
                                                      </div>
    
                                                      <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                        <div class="form-group" id="message_body_div">
                                                                <label class="control-table" for="message_body">Message body</label>
                                                                <textarea  name="message_body" id="message_body" class="form-control" placeholder="Enter the message to be sent here" rows="3" required></textarea>
                                                                <div id="subject_error"></div>
                                                        </div>	
                                                  </div>
                                                </div>
                                                    <div style="align: center;" class="pull-right">
                                                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success" value="Clear student">Send email</button>
                                                    </div>
                                        </form>
                                        
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
                        @endif
                    </tbody>
            </table>
       </div>
</div>

                
    
@endsection