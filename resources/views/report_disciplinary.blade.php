@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Disciplinary cases</h1>
    </div>
</div>
<?php $i = 1;

?>
 

<div class="panel panel-default w-auto">
    <div class="panel-heading">
      Form {{$class_name}} students
    </div>
       <div class="panel-body">
            <div>
                    @if ( Session::get('case_reported_successfully') != null)
                
                    <div class="alert alert-success alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success</strong> : {{ Session::get('case_reported_successfully')}}
                    </div>
                
                    @endif
                </div> 
                 <div>
                        @if ( Session::get('case_not_reported') != null)
                    
                        <div class="alert alert-warning alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Failed</strong> : {{ Session::get('case_not_reported')}}
                        </div>
                    
                        @endif
                    </div>  
            <table class="table table-hover table-responsive-sm table-responsive-md " id="report_disciplinary">
                    <thead class="active">
                        <th width="5%">#NO</th>
                        <th>ADM No.</th>
                        <th>Name</th>
                        <th>Class</th>
                        <th>Gender</th>
                        <th>Action</th>
                    </thead>

                    <tbody>

                        @if (!$students->isEmpty())
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$student->admission_number}}</td>
                                    <td>{{$student->first_name}}  {{$student->middle_name}}  {{$student->last_name}}</td>
                                    <td>{{$class_name}}</td>
                                    <td>{{$student->gender}}</td>
                                    <td>
                                        <button name="report" id="{{$student->id}}" data-toggle="modal" data-target="#report_disciplinary{{$student->id}}" class="btn btn-outline-primary btn-sm">Report case</button>

                                    </td>
                                </tr>
                                <div class="container">
                                        <div class="row">
                                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                                <div class="modal" id="report_disciplinary{{$student->id}}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title pull-left">Report disciplinary case</h4>
                                                                <button class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                
                                                                            <form action="/disciplinary/reportCase" method = "POST" name="address_form">
                                                                                @csrf
                                                                                <input type="hidden" name="student_id" value="{{$student->id}}"/>
                                                                                <input type="hidden" name="class_name" value="{{$class_name}}"/>
                                                                            
                                                                             
                                                                                          <div class="row">
                                                                                                <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                                                                      <div class="form-group" id="student_name_div">
                                                                                                              <label class="control-table" for="student_name">Student name</label>
                                                                                                      <input type="text" name="student_name" id="student_name" class="form-control" readonly value="{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}" >
                                                                                                              <div id="student_name_error"></div>
                                                                                                      </div>	
                                                                                                </div>
                                                                          
                                                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                                                      <div class="form-group" id="adm_no_div">
                                                                                                              <label class="control-table" for="adm_no">Admission number</label>
                                                                                                              <input type="number" name="adm_no" id="adm_no" class="form-control" readonly value="{{$student->admission_number}}" >
                                                                                                              <div id="adm_no_error"></div>
                                                                                                      </div>	
                                                                                                </div>
                                                                          
                                                                                                <div class="col-xm-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                                                                                                      <div class="form-group" id="student_class_div">
                                                                                                              <label class="control-table" for="student_class">Class</label>
                                                                                                              <input type="text" name="student_class" id="student_class" class="form-control" value="{{$class_name}}" >
                                                                                                              <div id="student_class_error"></div>
                                                                                                      </div>	
                                                                                                </div>
                                                                        
                                                                                                
                                                                                                <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                                                                        <div class="form-group" id="case_category_div">
                                                                                                                <label for="case_category">Disciplinary case category</label>
                                                                                                                <select id="case_category" name="case_category" required class="form-control">
                                                                                                                    <option value=""></option>
                                                                                                                    <option>Absentism</option>
                                                                                                                    <option>Bullying</option>
                                                                                                                    <option>Theft</option>
                                                                                                                    <option>Making noise</option>
                                                                                                                    <option>Sneaking out of school</option>
                                                                                                                    <option>Lost books</option>
                                                                                                                </select>
                                                                                                                <div id="case_category_error"></div>
                                                                                                            </div>
                                                                                                    
                                                                                                </div>

                                                                                                <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                                                                        <div class="form-group" id="case_description_div">
                                                                                                                <label class="control-table" for="case_description">Description</label>
                                                                                                                <textarea  name="case_description" id="street" class="form-control" required placeholder="Briefly describe what happened"></textarea>
                                                                                                                <div id="case_description_error"></div>
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
       </div>
</div>

                
    
@endsection