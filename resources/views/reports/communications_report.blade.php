@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Mail messages reports</h1>
    </div>
</div>
<?php $i = 1; ?>
<div class="panel panel-default w-auto">
<div class="panel-heading">

    <?php

use Illuminate\Support\Facades\DB;

    function getParent($id){
        $name = "";
        $parents = DB::table('parents')->where('id', $id)->get();

        if(!$parents->isEmpty()){
            foreach ($parents as $parent) {
                $name = $parent->first_name.' '.$parent->last_name;
            }
        } else {
            $name = "--";
        }

        return $name;
    }
    
    function getTeacher($id){
        $name = "";
        $teachers = DB::table('teachers')->where('id', $id)->get();

        if(!$teachers->isEmpty()){
            foreach ($teachers as $teacher) {
                $name = $teacher->first_name.' '.$teacher->last_name;
            }
        } else {
            $name = "--";
        }

        return $name;
    }

    function getStudentADM($id){
        $adm_no = "";
        $students = DB::table('students')->where('id', $id)->get();

        if(!$students->isEmpty()){
            foreach ($students as $student) {
                $adm_no = $student->admission_number;
            }
        } else {
            $adm_no = "--";
        }

        return $adm_no;
    }

    ?>
  
</div>
   <div class="panel-body">
        
    <h4 style="text-align: center; margin-bottom: 20px; text-decoration: underline;">Filter report by date</h4>

    <form action="/communications/report/specific" method="post" class="form-horizontal" name="login_form">

        
        @csrf

        <div class="row">

            <div class="col-md-5 col-lg-5 col-xl-5">
                    <div class="form-group row" id="date_from_div">
                     
                            <label class="col-lg-4  col-xl-4 col-md-4  control-label" for="Old">Date From</label>
                    
                         <div class="col-lg-7 col-xl-7 col-md-7">
                             <input type="date" class="form-control" id="date_from" name="date_from" placeholder="Date from" required />
                             <div id="date_from_error"></div>
                         </div>
                  </div>

            </div>

            <div class="col-md-5 col-lg-5 col-xl-5">
                    <div class="form-group row" id="date_to_div">
                     
                            <label class="col-lg-3  col-xl-3 col-md-3  control-label" style="valign: center;" for="date_to">Date To</label>
                    
                         <div class="col-lg-7 col-xl-7 col-md-7">
                             <input type="date" class="form-control" id="date_to" name="date_to" placeholder="Date to" required />
                             <div id="date_to_error"></div>
                         </div>
                  </div>

            </div>

            <div class="col-md-2 col-lg-2 col-xl-2">
                <button type="submit" name="submit" class="btn btn-success">Get report</button>

            </div>

        </div>

        
  

    </form>

    <div style="margin-top: 10px;">
        @if ( Session::get('message_deleted') != null)
    
        <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success</strong> : {{ Session::get('message_deleted')}}
        </div>
    
        @endif
    </div>
    
    
    <div style="margin-top: 10px;">
        @if ( Session::get('message_not_deleted') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('message_not_deleted')}}
        </div>
    
        @endif
    </div>

     <div style="margin-top: 20px;">
        @if (Session::get('no_reports') != "")
            <p style="color: red; font-size: 20px;">{{ Session::get('no_reports')}}</p>
        @endif
    </div>

    <!-- view report data-->

    @if (!$mail_messages->isEmpty())

        @if ($date_from != "")
                <h4>Mail messages sent as from {{$date_from}} to {{$date_to}}</h4>

        @else
            <h4>All mail messages</h4>
        @endif
   
    
    <table class="table table-hover table-responsive-sm table-responsive-md responsive-lg table-responsive-xl " id="mail_messages_table">
            <thead class="active">
                <th>#NO</th>
                <th>From teacher</th>
                <th>To parent</th>
                <th>Student ADM No.</th>
                <th>Subject</th>
                <th>Message body</th>
                <th>Date send</th>
                <th>Action</th>

            </thead>

            <tbody>

                    @foreach ($mail_messages as $message)
                        <tr >
                            <td>{{$i++}}</td>
                            <td>{{getTeacher($message->from_teacher_id)}}</td>
                            <td>{{getParent($message->to_parent_id)}}</td>
                            <td>{{getStudentADM($message->student_id)}}</td>
                            <td>{{$message->subject}}</td>
                            <td>{{$message->message_body}}</td>
                            <td>{{$message->date_send}}</td>
                            <td><i id="{{$message->message_id}}" data-toggle="modal" data-target="#delete_modal{{$message->message_id}}" class="fa fa-trash" style="color: red;"></i> </td>
                                                      
                        </tr>

                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12 col-xl-12">
                                    <div class="modal" id="delete_modal{{$message->message_id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title pull-left" style="color: red;">Delete message</h4>
                                                    <button class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/communications/delete/message" method = "POST">
                                                    @csrf
                                                    <input type="hidden" name="message_id" value='{{$message->message_id}}'/>
                                                    <div class="row">
                                                        <p>Are you sure you want to delete this message?</p>                                     
                                                    </div>
                                                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-success" data-dismiss="modal">NO, Cancel</button>
                                                                <input type="submit" class="btn btn-danger" value="Yes, delete"></input>
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
                
            </tbody>
    </table>
    @endif
       

   </div>
</div>

@endsection