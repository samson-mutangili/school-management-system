@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Current disciplinary cases</h1>
    </div>
</div>
<?php $i = 1;
$status = false;

?>
 

<div class="panel panel-default w-auto">
    <div class="panel-heading">
      Student disciplinary case
    </div>
       <div class="panel-body">
           <a href="/disciplinary/cases/current_cases ">
                <button class="btn btn-outline-primary" style="margin-bottom:10px;">Back</button>
           </a>
          

                    <p style="color:green; text-decoration:underline; margin-bottom: 0px; ">Student details</p>
            <table>

                
                    
                    <tbody>

                        @if (!$student_details->isEmpty())
                            @foreach ($student_details as $student)
                                <tr>
                                   <td align="left">ADM No. </td>
                                   <td> : {{$student->admission_number}}</td>
                                </tr>

                                <tr>
                                    <td align="left">Name </td>
                                    <td> : {{$student->first_name}} {{$student->middle_name}} {{$student->last_name}} </td>
                                 </tr>

                                 <tr>
                                    <td align="left">Gender </td>
                                    <td> : {{$student->gender}}</td>
                                 </tr>

                                 <tr>
                                    <td align="left">Class </td>
                                    <td> : {{$student_class}}</td>
                                 </tr>
                                
                            @endforeach
                        @endif
                    </tbody>
            </table>

            <fieldset style="border: 2px solid red; border-radius: 10px; padding: 5px; margin: 10px 0px; " >
                    <legend style="width: auto; color:red;">Case details</legend>
                        <table>              
                                
                                <tbody>

                                    @if (!$case_details->isEmpty())
                                        @foreach ($case_details as $case)

                                            @if (!$teacher_details->isEmpty())
                                                @foreach ($teacher_details as $teacher)
                                                    <tr>
                                                        <td align="left">Teacher who reported</td>
                                                        <td> : {{$teacher->first_name}} {{$teacher->middle_name}} {{$teacher->last_name}}</td>
                                                    </tr>
                                                @endforeach
                                            @endif

                                            <tr>
                                                <td align="left">Case category </td>
                                                <td> : {{$case->case_category}}</td>
                                            </tr>

                                            <tr>
                                                <td align="left">Case description </td>
                                                <td> : {{$case->case_description}}</td>
                                            </tr>

                                            <tr>
                                                <td align="left">Date reported </td>
                                                <td> : {{$case->date_reported}}</td>
                                            </tr>

                                            <tr>
                                                    <td align="left">Status </td>
                                                    <td> : {{$case->case_status}}</td>
                                                    @if ($case->case_status == "cleared")
                                                        <?php $status = true; ?>
                                                    @endif
                                            </tr>
                                            
                                            <div class="container">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-lg-12 col-xl-12">
                                                            <div class="modal" id="disciplinary_case" tabindex="-1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title pull-left">Disciplinary case clearance</h4>
                                                                            <button class="close" data-dismiss="modal">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            
                                                                                        <form action="/disciplinary/case_clearance" method = "POST" >
                                                                                            @csrf
                                                                                            @if (Session::get('teacher_id') != null)
                                                                                            <input type="hidden" name="teacher_id" value="{{ Session::get('teacher_id')}}"/>                                                                                        
                                                                                            @endif
                                                                                            <input type="hidden" name="case_id" value="{{$case->case_id}}"/>

                                           
                                                                                                        <div class="row">
                                                                                                            <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                                                                                    <div class="form-group" id="action_taken_div">
                                                                                                                            <label class="control-table" for="action_taken">Action taken</label>
                                                                                                                            <textarea  name="action_taken" id="action_taken" class="form-control" required placeholder="Briefly describe the action taken"></textarea>
                                                                                                                            <div id="action_taken_error"></div>
                                                                                                                    </div>	
                                                                                                              </div>
                                                                                                        </div>
                                                                                                
                                                                                                <div style="align: center;" class="pull-right">
                                                                                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                                                                <button type="submit" class="btn btn-success" value="Update">Submit</button>
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
                                    @endif
                                </tbody>
                        </table>

                        @if ($status)
                            <button name="report" data-toggle="modal" data-target="#disciplinary_case" class="btn btn-outline-primary disabled" style="margin-top: 10px;">Clear</button>
                        @else
                             <button name="report" data-toggle="modal" data-target="#disciplinary_case" class="btn btn-outline-primary" style="margin-top: 10px;">Clear</button>

                        @endif
            </fieldset>
       </div>
</div>

                
    
@endsection