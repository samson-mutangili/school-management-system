@extends('layouts.dashboard')

@section('content')
    

<h4 style="color: green; ">Enrty of students marks for {{$term}} {{$exam_type}} exam</h4>


<div style="margin-top: 10px;">
    @if ( Session::get('both_marks_empty') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('both_marks_empty')}}
    </div>

    @endif
</div>


<div style="margin-top: 10px;">
    @if ( Session::get('subject1_empty') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('subject1_empty')}}
    </div>

    @endif
</div>


<div style="margin-top: 10px;">
    @if ( Session::get('invalid_marks') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('invalid_marks')}}
    </div>

    @endif
</div>



<div style="margin-top: 10px;">
    @if ( Session::get('subject1_marks_exists') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('subject1_marks_exists')}}
    </div>

    @endif
</div>


<div style="margin-top: 10px;">
    @if ( Session::get('subject2_marks_exists') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('subject2_marks_exists')}}
    </div>

    @endif
</div>


<div style="margin-top: 10px;">
    @if ( Session::get('subject2_marks_inserted') != null)

    <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success</strong> : {{ Session::get('subject2_marks_inserted')}}
    </div>

    @endif
</div>


<div style="margin-top: 10px;">
    @if ( Session::get('subject1_marks_submitted') != null)

    <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success</strong> : {{ Session::get('subject1_marks_submitted')}}
    </div>

    @endif
</div>


<div style="margin-top: 10px;">
    @if ( Session::get('subject2_empty') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('subject2_empty')}}
    </div>

    @endif
</div>



<div style="margin-top: 10px;">
    @if ( Session::get('subject1_marks_inserted') != null)

    <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success</strong> : {{ Session::get('subject1_marks_inserted')}}
    </div>

    @endif
</div>


<!-- update alerts when marks have been updated -->

<div style="margin-top: 10px;">
        @if ( Session::get('subject1_updated') != null)
    
        <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success</strong> : {{ Session::get('subject1_updated')}}
        </div>
    
        @endif
    </div>
    
    <div style="margin-top: 10px;">
            @if ( Session::get('subject2_updated') != null)
        
            <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success</strong> : {{ Session::get('subject2_updated')}}
            </div>
        
            @endif
        </div>
        
<!-- update alerts when marks have been removed!!-->

<div style="margin-top: 10px;">
        @if ( Session::get('remove_not_selected') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('remove_not_selected')}}
        </div>
    
        @endif
    </div>
    
    <div style="margin-top: 10px;">
            @if ( Session::get('subject1_marks_removed') != null)
        
            <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success</strong> : {{ Session::get('subject1_marks_removed')}}
            </div>
        
            @endif
     </div>

        <div style="margin-top: 10px;">
                @if ( Session::get('subject2_marks_removed') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('subject2_marks_removed')}}
                </div>
            
                @endif
        </div>
        




<div style="margin-top: 10px;">
    @if ( Session::get('subject2_marks_submitted') != null)

    <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success</strong> : {{ Session::get('subject2_marks_submitted')}}
    </div>

    @endif
</div>


<form action="/#" method="GET" class="form-inline" style="margin-bottom: 20px;">
    <div class="form-group" style="margin-right: 30px;">
        <label class="control-table" style="margin-right: 10px;">Select number to show: </label>
        <select name="no_to_paginate" onchange="this.form.submit()">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
    </div>
     
        <div class="form-group">
            <label style="margin-left: 40px; margin-right: 10px;">Search</label>
            <input style="height: 23px;" type="text" name="search" placeholder="Search here..."/> 
        </div>
</form>

<?php 
    $subject1;
    $subject2;
?>

<table class="table table-bordered table-sm">
    <thead class="active">
        <th class="table-secondary">S/NO</th>
        <th class="table-secondary">Name</th>
        <th class="table-secondary">Admission number</th>
        <th class="table-secondary">Class</th>
        <th class="table-secondary">Gender</th>
        <th class="table-secondary">Action</th>
    </thead>

    <tbody>
        <?php 
        $i = 1;
        $no_marks = "false";
        ?>

            @foreach ($students as $student )
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $student->first_name }} {{ $student->middle_name}}  {{ $student->last_name }} </td>
                <td>{{ $student->admission_number }}</td>
                <td>{{ $student->class }}</td>
                <td>{{ $student->gender}}</td>
                @foreach ($teaching_classes as $teacher_class )
                    @if ($teacher_class->class_name == $specific_class_name)
                    
                   
                    <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12 col-xl-12">
                                    <div class="modal" id="add_marks{{$student->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title pull-left">Add marks</h4>
                                                    <button class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="/submit_marks" method = "POST" name="marks_entry_form">
                                                    @csrf
                                                    <input type="hidden" name="student_id" value='{{$student->id}}'/>
                                                    <input type="hidden" name="class_name" value="{{$specific_class_name}}"/>
                                                    
                                                    <div class="row">

                                                            @if($teacher_class->subject1 != null)
                                                               
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                        <div class="form-group" id="subject1_div">
                                                                                <label for="subject1">{{$teacher_class->subject1}} marks</label>
                                                                                <input type="number" id="subject1" class="form-control" name="{{$teacher_class->subject1}}" >
                                                                                <div id="subject1_error"></div>
                                                                        </div>
                                                            
                                                                </div>

                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                    <div class="form-group" id="subject1_comments_div">
                                                                            <label for="{{$teacher_class->subject1}}_comments">{{$teacher_class->subject1}} marks comments</label>
                                                                            <select id="subject1_comments" name="{{$teacher_class->subject1}}_comments" class="form-control">
                                                                                <option value="Excellent. Keep up">Excellent. Keep up</option>
                                                                                 <option value="Very good">Very good</option>
                                                                                 <option selected value="Good">Good</option>
                                                                                 <option value="Can do better">Can do better</option>
                                                                                 <option value="Work hard">Work hard</option>
                                                                            </select>
                                                                            <div id="subject1_comments_error"></div>
                                                                        </div>
                                                                
                                                            </div>
                                                                @endif

                                                            @if($teacher_class->subject2 != null)
                                                            
                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                    <div class="form-group" id="subject2_div">
                                                                            <label for="subject2">{{$teacher_class->subject2}} marks</label>
                                                                            <input type="number" id="subject2" class="form-control" name="{{$teacher_class->subject2}}" >
                                                                            <div id="subject2_error"></div>
                                                                    </div>
                                                        
                                                            </div>

                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                <div class="form-group" id="subject1_comments_div">
                                                                        <label for="{{$teacher_class->subject2}}_comments">{{$teacher_class->subject2}} marks comments</label>
                                                                        <select id="subject2_comments" name="{{$teacher_class->subject2}}_comments" class="form-control">
                                                                            <option value="Excellent. Keep up">Excellent. Keep up</option>
                                                                             <option value="Very good">Very good</option>
                                                                             <option selected value="Good">Good</option>
                                                                             <option value="Can do better">Can do better</option>
                                                                             <option value="Work hard">Work hard</option>
                                                                        </select>
                                                                        <div id="subject2_comments_error"></div>
                                                                    </div>
                                                            
                                                        </div>
                                                            @endif

                                                           
                                                            
                                                    </div>
                                                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                                <input type="submit" class="btn btn-success" value="Submit" ></input>
                                                    </div>
                                                    </form>	
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- modal for viewing student marks data -->

                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12 col-xl-12">
                                    <div class="modal" id="view_marks{{$student->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title pull-left">Student marks</h4>
                                                    <button class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">

                                                    <?php 
                                                            $first_marks_available = "false";
                                                            $second_marks_available = "false";
                                                    ?>
                                                    @foreach ($existing_marks as $subject_marks)

                                                    @if ( ($student->id == $subject_marks->student_id && $subject_marks->class_name == $specific_class_name && $subject_marks->subject == $teacher_class->subject1 ))
                                                    <p>{{$subject_marks->subject}} marks : {{$subject_marks->marks_obtained}}</p>
                                                    <p>{{$subject_marks->subject}} marks comments: {{$subject_marks->comments}}</p>                                                
                                                    <?php $first_marks_available = "true"; ?> 
                                                    @endif
                                                     
                                                     @if ( ($student->id == $subject_marks->student_id && $subject_marks->class_name == $specific_class_name && $subject_marks->subject == $teacher_class->subject2 ))
                                                     <p>{{$subject_marks->subject}} marks : {{$subject_marks->marks_obtained}}</p>
                                                     <p>{{$subject_marks->subject}} marks comments: {{$subject_marks->comments}}</p>                                               
                                                    <?php $second_marks_available = "true";?>
                                                     @else
                                                        
                                                        @endif 

                                                    @endforeach
                                                    
                                                    @if ($first_marks_available == "false" && $second_marks_available == "false") 
                                                        <p>You have not submitted any marks for the student. You can click on the add button in order to submit the marks.</p>
                                                    @endif
                                                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                                
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- modal button for editing student's marks -->
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12 col-xl-12">
                                    <div class="modal" id="edit_marks{{$student->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title pull-left">Update student's marks</h4>
                                                    <button class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">

                                                    <?php 
                                                            $first_marks_available = "false";
                                                            $second_marks_available = "false";
                                                    ?>
                                                                                                       
                                                    
                                                    <form action="/update_marks" method = "POST" name="marks_entry_form">
                                                        @csrf
                                                        
                                                        @foreach ($existing_marks as $subject_marks)

                                                        <input type="hidden" name="student_id" value='{{$student->id}}'/>
                                                        <input type="hidden" name="class_name" value="{{$specific_class_name}}"/>
                                                        
                                                        <div class="row">

                                                                
    
                                                                @if($teacher_class->subject1 != null)
                                                                   
                                                                        @if ( ($student->id == $subject_marks->student_id && $subject_marks->class_name == $specific_class_name && $subject_marks->subject == $teacher_class->subject1 ))
                                                                        
                                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                                    <div class="form-group" id="subject1_div">
                                                                                            <label for="subject1">{{$teacher_class->subject1}} marks</label>
                                                                                            <input type="number" id="subject1" class="form-control" name="{{$teacher_class->subject1}}" value="{{$subject_marks->marks_obtained}}" >
                                                                                            <div id="subject1_error"></div>
                                                                                    </div>
                                                                        
                                                                            </div>
            
                                                                            <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                                <div class="form-group" id="subject1_comments_div">
                                                                                        <label for="{{$teacher_class->subject1}}_comments">{{$teacher_class->subject1}} marks comments</label>
                                                                                        <select id="subject1_comments" name="{{$teacher_class->subject1}}_comments" class="form-control">
                                                                                           <option value="{{$subject_marks->comments}}" selected>{{$subject_marks->comments}}</option>
                                                                                            <option value="Excellent. Keep up">Excellent. Keep up</option>
                                                                                            <option value="Very good">Very good</option>
                                                                                            <option value="Good">Good</option>
                                                                                            <option value="Can do better">Can do better</option>
                                                                                            <option value="Work hard">Work hard</option>
                                                                                        </select>
                                                                                        <div id="subject1_comments_error"></div>
                                                                                    </div>
                                                                            
                                                                        </div>                                           
                                                                        <?php $first_marks_available = "true"; ?> 
                                                                        @endif
                                                                @endif
    
                                                                @if($teacher_class->subject2 != null)
                                                                
                                                                @if ( ($student->id == $subject_marks->student_id && $subject_marks->class_name == $specific_class_name && $subject_marks->subject == $teacher_class->subject2 ))
                                                                
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                        <div class="form-group" id="subject2_div">
                                                                                <label for="subject2">{{$teacher_class->subject2}} marks</label>
                                                                                <input type="number" id="subject2" class="form-control" name="{{$teacher_class->subject2}}" value="{{$subject_marks->marks_obtained}}">
                                                                                <div id="subject2_error"></div>
                                                                        </div>
                                                            
                                                                </div>
    
                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                    <div class="form-group" id="subject1_comments_div">
                                                                            <label for="{{$teacher_class->subject2}}_comments">{{$teacher_class->subject2}} marks comments</label>
                                                                            <select id="subject2_comments" name="{{$teacher_class->subject2}}_comments" class="form-control">
                                                                                <option value="{{$subject_marks->comments}}" selected>{{$subject_marks->comments}}</option>
                                                                                <option value="Excellent. Keep up">Excellent. Keep up</option>
                                                                                 <option value="Very good">Very good</option>
                                                                                 <option value="Good">Good</option>
                                                                                 <option value="Can do better">Can do better</option>
                                                                                 <option value="Work hard">Work hard</option>
                                                                            </select>
                                                                            <div id="subject2_comments_error"></div>
                                                                        </div>
                                                                
                                                            </div>                                     
                                                                    <?php $second_marks_available = "true";?>
                                                                        
                                                                   
                                                                   @endif 
                                                                @endif
    
                                                               
                                                                
                                                        </div>
                                                        @endforeach
                                                        
                                                        @if ($first_marks_available == "false" && $second_marks_available == "false") 
                                                        <p>You have not submitted any marks for the student. You can click on the add button in order to submit the marks.</p>
                                                         @endif
                                                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                                <input type="submit" class="btn btn-success" name="Update" value="Update"></input>
                                                    </div>
                                                </form>	
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- modal for removing student marks from the database -->

                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-lg-12 col-xl-12">
                                    <div class="modal" id="remove_marks{{$student->id}}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title pull-left">Select student marks to remove</h4>
                                                    <button class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">

                                                    <form action="/removeMarks" method="POST">


                                                        <input type="hidden" name="class_name" value="{{$specific_class_name}}"/>

                                                    @csrf

                                                    <?php 
                                                            $first_marks_available = "false";
                                                            $second_marks_available = "false";
                                                    ?>
                                                    @foreach ($existing_marks as $subject_marks)

                                                    @if ( ($student->id == $subject_marks->student_id && $subject_marks->class_name == $specific_class_name && $subject_marks->subject == $teacher_class->subject1 ))
                                                        <input type="hidden" name="subject1_id" value="{{$subject_marks->id}}"/>
                                                         <div class="checkbox" >
                                                            <label><input name="subject1_checked" style="width: 17px; height: 17px; vertical-align: middle; margin-right: 5px;"  type="checkbox" value="{{$subject_marks->subject}}">{{$subject_marks->subject}} marks</label>
                                                          </div>
                                                    <?php $first_marks_available = "true"; ?> 
                                                    @endif
                                                     
                                                     @if ( ($student->id == $subject_marks->student_id && $subject_marks->class_name == $specific_class_name && $subject_marks->subject == $teacher_class->subject2 ))
                                                     <input type="hidden" name="subject2_id" value="{{$subject_marks->id}}"/>
                                                     <div class="checkbox" >
                                                            <label><input name="subject2_checked" style="width: 17px; height: 17px; vertical-align: middle; margin-right: 5px;"  type="checkbox" value="{{$subject_marks->subject}}">{{$subject_marks->subject}} marks</label>
                                                          </div>                                   
                                                    <?php $second_marks_available = "true";?>
                                                     @else
                                                        
                                                        @endif 

                                                    @endforeach
                                                    
                                                    @if ($first_marks_available == "false" && $second_marks_available == "false") 
                                                        <p>You have not subimitted any marks for the student. You can click on the add button to add student marks.</p>
                                                    @endif
                                                    <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger" name="remove">Remove</button>
                                                                
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

                
                @endforeach
                <td>
                        <button type="button" name="add" data-toggle="modal" data-target="#add_marks{{$student->id}}" id="add_marks{{$student->id}}" class="btn btn-success">Add</button>
                        <button type="button" name="view" data-toggle="modal" data-target="#view_marks{{$student->id}}" id="view_marks{{$student->id}}" class="btn btn-primary">View</button>
                        <button type="button" name="edit" data-toggle="modal" data-target="#edit_marks{{$student->id}}" id="edit_marks{{$student->id}}" class="btn btn-primary">Edit</button>
                        <button type="button" name="remove" data-toggle="modal" data-target="#remove_marks{{$student->id}}" id="remove_marks{{$student->id}}" class="btn btn-danger">Remove</button>   
                    </td>
            </tr>
            @endforeach
                

        
    </tbody>

</table>
    
<div style="float: right;">
    {{ $students->links() }}
</div>


@endsection