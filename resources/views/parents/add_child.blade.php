@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Add Student to parent</h1>
    </div>
</div>
<?php $i = 1; ?>
<div class="panel panel-default w-auto">
<div class="panel-heading">

    <?php

use Illuminate\Support\Facades\DB;

    function getClass($id){
        $student_class = "";
        $class = DB::table('student_classes')
                    ->where('student_id', $id)
                    ->where('status', 'active')
                    ->get();

        if(!$class->isEmpty()){
            foreach ($class as $cls) {
                $student_class = $cls->stream;
            }
        } else{
            $student_class = "--";
        }
        return $student_class;
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

    
       
        function getGender($parent_id){

            $pare_gender = "";

            $gender = DB::table('parents')
                        ->where('id', $parent_id)
                        ->get();

            if(!$gender->isEmpty()){
                foreach ($gender as $parent_gender) {
                    $pare_gender = $parent_gender->gender;
                }
            }

            return $pare_gender;
        }
   
        function getParentName($parent_id){

            $name = "";

            $parents = DB::table('parents')
                        ->where('id', $parent_id)
                        ->get();

            if(!$parents->isEmpty()){
                foreach ($parents as $parent) {
                    $name = $parent->first_name. ' '.$parent->middle_name.' '.$parent->last_name;
                }
            }

            return $name;
        }
    ?>
  
</div>
   <div class="panel-body">
        
    <h4 style=" margin-bottom: 20px; text-decoration: underline;">Search the student by admission number</h4>

    <form action="/parents/search_child" method="post" class="form-horizontal" >

        <input type="hidden" name="parent_id" value="{{$parent_id}}"/>
        @csrf

        <div class="row">

            <div class="col-md-8 col-lg-6 col-xl-6">
                    <div class="form-group row" id="date_from_div">
                     
                            <label class="col-lg-5  col-xl-5 col-md-5  control-label" for="adm_no">Admission number</label>
                    
                         <div class="col-lg-7 col-xl-7 col-md-7">
                             <input type="number" class="form-control" id="adm_no" name="adm_no" required />
                             <div id="adm_no_error"></div>
                         </div>
                  </div>

            </div>

            <div class="col-md-4 col-lg-4 col-xl-2">
                <button type="submit" name="submit" class="btn btn-success">search student</button>

            </div>

        </div>

        
  

    </form>

     <div style="margin-top: 20px;">
        @if (Session::get('no_child') != "")
            <p style="color: red; font-size: 20px;">{{ Session::get('no_child')}}</p>
        @endif
    </div>

   @if (!$student_details->isEmpty())

   <div style="margin-top: 15px;">
    @if ( Session::get('relationship_exists') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('relationship_exists')}}
    </div>

    @endif
</div>  

<div style="margin-top: 15px;">
    @if ( Session::get('child_assigned_to_parent') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('child_assigned_to_parent')}}
    </div>

    @endif
</div>  

   @foreach ($student_details as $student)

   <div class="panel panel-primary w-auto">
    <div class="panel-heading">
        Search results for admission number : {{$adm_no ?? ''}}
    </div>

    <div class="panel-body">
    
<form action="/parents/addNew/child" method="post" class="form-horizontal" >

    <input type="hidden" name="parent_id" value="{{$parent_id}}"/>
    <input type="hidden" name="student_id" value="{{$student->id}}"/>
    @csrf

    <div class="row">

        <div class="col-xm-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
            <div class="form-group" id="student_name_div">
                    <label class="control-table" for="student_name">First name</label>
                    <input type="text" name="student_name" id="student_name" class="form-control" value="{{$student->first_name}} {{$student->middle_name}} {{$student->last_name}}" readonly>
                    <div id="student_name_error"></div>
            </div>	
      </div>

      <div class="col-xm-12 col-sm-12 col-md-8 col-lg-7 col-xl-7"></div>
      <div class="col-xm-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
            <div class="form-group" id="admission_number_div">
                    <label class="control-table" for="father_middle_name">Admission Number</label>
            <input type="text" name="admission_number" id="admission_number" class="form-control" value="{{$student->admission_number}}" readonly>
                    <div id="admission_number_error"></div>
            </div>	
      </div>
      <div class="col-xm-12 col-sm-12 col-md-8 col-lg-7 col-xl-7"></div>
      <div class="col-xm-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
            <div class="form-group" id="student_gender_div">
                    <label class="control-table" for="student_gender">Student gender</label>
                    <input type="text" name="student_gender" id="student_gender" class="form-control" value="{{$student->gender}}" readonly>
                    <div id="student_gender_error"></div>
            </div>	
      </div>
      <div class="col-xm-12 col-sm-12 col-md-8 col-lg-7 col-xl-7"></div>
      <div class="col-xm-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
            <div class="form-group" id="parent_name_div">
                    <label class="control-table" for="parent_name">Parent name</label>
                    <input type="text" name="parent_name" id="parent_name" class="form-control" value="{{getParentName($parent_id)}}" readonly>
                    <div id="parent_namer_error"></div>
            </div>	
      </div>
      <div class="col-xm-12 col-sm-12 col-md-8 col-lg-7 col-xl-7"></div>
      <div class="col-xm-12 col-sm-12 col-md-6 col-lg-5 col-xl-5">
              <div class="form-group" id="relationship_div">
                      <label class="control-table" for="relationship">Relationship to parent</label>
                      <select name="relationship" class="form-control" required>
                          <option value="">Select parent to child relationship</option>
                          @if (getGender($parent_id) == "male")
                            <option value="Father">Father</option>
                          @elseif(getGender($parent_id) == "female")
                            <option value="Mother">Mother</option>                             
                          @endif

                          <option value="Guardian">Guardian</option>
                      </select>
                      <div id="relationship_error"></div>
              </div>
          
      </div>
      <div class="col-xm-12 col-sm-12 col-md-8 col-lg-7 col-xl-7"></div>
        <div class="col-md-3 col-lg-2 col-xl-2">
            <button type="submit" name="submit" class="btn btn-success">Submit</button>

        </div>

    </div>

    


</form>
</div>

</div>
       
   @endforeach
       
   @endif

   </div>
</div>

@endsection