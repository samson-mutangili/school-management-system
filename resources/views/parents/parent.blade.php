@extends('layouts.dashboard')

@section('content')

<style>

table tr td{
    padding: 7px;
}
    </style>




<div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Parent</h1>
        </div>
</div>
<?php
    use Illuminate\Support\Facades\DB;

    function getClassForm($student_id){

        $class = "--";
        $student_class = DB::table('student_classes')
                            ->where('student_id', $student_id)
                            ->where('status', 'active')
                            ->get();
        
        if(!$student_class->isEmpty()){
            foreach ($student_class as $stude_class) {
                $class = $stude_class->stream;
            }
        }

        return $class;
    }

$i = 1;

$parent_gender ="";
$parent_id;
?>

<ul class="nav nav-tabs">
        <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#personal_details">Personal details</a>
              </li>
    <li class="nav-item">
      <a class="nav-link " data-toggle="tab" href="#children">Children</a>
    </li>
         
  </ul>



  <div style="margin-top: 15px;">
        <div style="margin-top: 15px;">
                @if ( Session::get('relationship_updated') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('relationship_updated')}}
                </div>
            
                @endif
        </div>  
        <div style="margin-top: 15px;">
            @if ( Session::get('relationship_update_failed') != null)
        
            <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Failed</strong> : {{ Session::get('relationship_update_failed')}}
            </div>
        
            @endif
    </div>  

    <div style="margin-top: 15px;">
        @if ( Session::get('edit_relationship_exists') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('edit_relationship_exists')}}
        </div>
    
        @endif
</div>  


    <div style="margin-top: 15px;">
        @if ( Session::get('insert_successful') != null)
    
        <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success</strong> : {{ Session::get('insert_successful')}}
        </div>
    
        @endif
</div>  
<div style="margin-top: 15px;">
    @if ( Session::get('relationship_exists') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('relationship_exists')}}
    </div>

    @endif
</div>  


<div style="margin-top: 15px;">
    @if ( Session::get('parent_update_failed') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('parent_update_failed')}}
    </div>

    @endif
</div>  


    <div style="margin-top: 15px;">
                @if ( Session::get('parent_updated_successfully') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('parent_updated_successfully')}}
                </div>
            
                @endif
        </div>  


    <div style="margin-top: 15px;">
                @if ( Session::get('detach_successful') != null)
            
                <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success</strong> : {{ Session::get('detach_successful')}}
                </div>
            
                @endif
        </div>  
        <div style="margin-top: 15px;">
            @if ( Session::get('detach_failed') != null)
        
            <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Failed</strong> : {{ Session::get('detach_failed')}}
            </div>
        
            @endif
    </div>  

    <div style="margin-top: 15px;">
        @if ( Session::get('edit_id_no_conflict') != null)
    
        <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Failed</strong> : {{ Session::get('edit_id_no_conflict')}}
        </div>
    
        @endif
</div> 

<div style="margin-top: 15px;">
    @if ( Session::get('edit_email_conflict') != null)

    <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Failed</strong> : {{ Session::get('edit_email_conflict')}}
    </div>

    @endif
</div> 


        <div class="tab-content">
                <div id="personal_details" class="tab-pane container active">

                        @if (!$parent_details->isEmpty())
                        @foreach ($parent_details as $parent)
                        <?php $parent_id = $parent->id;
                        $parent_gender = $parent->gender;
                        ?>
                        <div class="panel panel-primary w-auto" >
                            <div class="panel-heading">
                              Parent personal details
                            </div>  
                            
                            
                            
                            <div class="panel-body">
                                     
                                    <div class="row">
                    
                                            <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    
                                                 <table>
                                                            <tbody>

                                                                <tr >
                                                                    <td align="left">Name</td>
                                                                    <td> : {{$parent->first_name}} {{$parent->middle_name}} {{$parent->last_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">Phone number  </td> 
                                                                    <td> : {{$parent->phone_no}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="left">Email address</td>
                                                                    <td> : {{$parent->email}}</td>
                                                                </tr>
                    
                                                                
                                                                    <tr>
                                                                        <td align="left">National ID No. </td> 
                                                                        <td> : {{$parent->id_no}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="left">Gender</td>
                                                                        <td> : {{$parent->gender}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                            <td align="left">Occupation</td>
                                                                            <td> : {{$parent->occupation}}</td>
                                                                        </tr>
                                                               
                                                            </tbody>
                                                        </table>
                                            
                                    </div>
                                           
                                        </div>

                                        <button name="edit" id="{{$parent->id}}" data-toggle="modal" data-target="#edit_modal{{$parent->id}}" style="width: 7em;" class="btn btn-outline-primary">Edit</button>
                                                  
            
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-xs-12 col-lg-12 col-xl-12">
                                                                <div class="modal" id="edit_modal{{$parent->id}}" tabindex="-1">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title pull-left">Edit parent details</h4>
                                                                                <button class="close" data-dismiss="modal">&times;</button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                
                                                                                            <form action="/parent/edit" method = "POST" name="parent_form" onsubmit="return validateParent()">
                                                                                                @csrf
                                                                                                <input type="hidden" name="parent_id" value="{{$parent->id}}"/>
                                                                                             
                                                                                                          <div class="row">
                                                                                                                <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                                      <div class="form-group" id="first_name_div">
                                                                                                                              <label class="control-table" for="first_name">First name</label>
                                                                                                                              <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name" value="{{ $parent->first_name }}">
                                                                                                                              <div id="first_name_error"></div>
                                                                                                                      </div>	
                                                                                                                </div>
                                                                                          
                                                                                                                <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                                      <div class="form-group" id="middle_name_div">
                                                                                                                              <label class="control-table" for="middle_name">Middle name</label>
                                                                                                                              <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter middle name" value="{{ $parent->middle_name }}">
                                                                                                                              <div id="middle_name_error"></div>
                                                                                                                      </div>	
                                                                                                                </div>
                                                                                          
                                                                                                                <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                                      <div class="form-group" id="last_name_div">
                                                                                                                              <label class="control-table" for="street">Last name</label>
                                                                                                                              <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name" value="{{ $parent->last_name }}">
                                                                                                                              <div id="last_name_error"></div>
                                                                                                                      </div>	
                                                                                                                </div>
                                                                                        
                                                                                                                <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                                        <div class="form-group" id="id_no_div">
                                                                                                                                <label class="control-table" for="id_no">ID number</label>
                                                                                                                                <input type="number" name="id_no" id="id_no" class="form-control" placeholder="Enter ID number" value="{{ $parent->id_no }}">
                                                                                                                                <div id="id_no_error"></div>
                                                                                                                        </div>
                                                                                                                    
                                                                                                                </div>
            
                                                                                                                <div class="col-xm-12 col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                                                                                        <div class="form-group" id="email_div">
                                                                                                                                <label class="control-table" for="phone_no">Email address</label>
                                                                                                                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address" value="{{ $parent->email }}">
                                                                                                                                <div id="email_error"></div>
                                                                                                                        </div>
                                                                                                                    
                                                                                                                </div>
            
                                                                                                                <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                                        <div class="form-group" id="phone_no_div">
                                                                                                                                <label class="control-table" for="phone_no">Phone number</label>
                                                                                                                                <input type="number" name="phone_no" id="phone_no" class="form-control" placeholder="Enter phone number" value="{{ $parent->phone_no }}">
                                                                                                                                <div id="phone_no_error"></div>
                                                                                                                        </div>
                                                                                                                    
                                                                                                                </div>
            
                                                                                                                <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                                        <div class="form-group" id="occupation_div">
                                                                                                                                <label class="control-table" for="occupation">Occupation</label>
                                                                                                                                <input type="text" name="occupation" id="occupation" class="form-control" placeholder="Enter occupation" value="{{ $parent->occupation }}">
                                                                                                                                <div id="occupation_error"></div>
                                                                                                                        </div>
                                                                                                                    
                                                                                                                </div>
            
                                                                                                                <div class="col-xm-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                                                                                    <div class="form-group" id="gender_div">
                                                                                                                            <label for="gender">Gender</label>
                                                                                                                            <select id="gender" name="gender" class="form-control">
                                                                                                                                <option @if ($parent->gender == 'female') selected @endif value="female">Female</option>
                                                                                                                                 <option @if ($parent->gender == 'male') selected @endif value="male">Male</option>
                                                                                                                            </select>
                                                                                                                            <div id="gender_error"></div>
                                                                                                                        </div>
                                                                                                                
                                                                                                               </div>
                                                                                
                                                                                                               
                                                                                                            </div>
                                                                                                    
                                                                                                    <div style="align: center;" class="pull-right">
                                                                                                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                                                                    <button type="submit" class="btn btn-success" value="Update" onClick="return validateParent()">Update</button>
                                                                                                    </div>
                                                                                        </form>
                                                                                        
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                            </div>
                        </div>
                       
                        @endforeach
                        
                    @endif
                      
                   
                    
        
                </div>

            
                   <div id="children" class="tab-pane container fade">
                          <?php $i=1; 
                          
                            function getClass($stream){
                                
                                $class_form = "";
            
                                if($stream == "1E" || $stream == "1W"){
                                    $class_form = "Form 1";
                                } else if ($stream == "2E" || $stream == "2W"){
                                    $class_form = "Form 2";
                                } else if ($stream == "3E" || $stream == "3W"){
                                    $class_form = "Form 3";
                                } else if ($stream == "4E" || $stream == "4W"){
                                    $class_form = "Form 4";
                                }
            
                                return $class_form;
                            }
                          ?>
            
                          <div class="panel panel-primary w-auto" >
                            <div class="panel-heading">
                             Parent children
                            </div>                    
                            <div class="panel-body">

                              <a href="/parents/addStudent/{{$parent_id}}">  <button class="btn btn-outline-primary" style="margin-bottom: 10px; float: right;"><i class="fa fa-user-plus"></i>Add child</button></a>
                                <table class="table table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl" id="result_slips_table">
                                    <thead>
                                        <th>#No</th>
                                        <th>Child name</th>
                                        <th>ADM no.</th>
                                        <th>Gender</th>
                                        <th>Class</th>
                                        <th>Relationship</th>
                                        <th>Action</th>
                                    </thead>
            
                                    <tbody>
                                        
                                        @if (!$parent_children->isEmpty())
                                            @foreach ($parent_children as $child)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$child->first_name}}  {{$child->middle_name}}  {{$child->last_name}}</td>
                                                    <td>{{$child->admission_number}}</td>
                                                    <td>{{$child->gender}}</td>
                                                    <td>Form {{getClassForm($child->student_id)}}</td>
                                                    <td>{{$child->relationship}}</td>
                                                    <td>
                                                        <button name="edit_relationship" id="{{$child->id}}" data-toggle="modal" data-target="#edit_modal2{{$child->id}}" class="btn btn-outline-success btn-sm">Edit</button>
                                                        <button name="delete_relationship" id="{{$child->id}}" data-toggle="modal" data-target="#delete_modal{{$child->id}}" class="btn btn-outline-danger btn-sm">Delete</button>
                                                        
                                                    </td>
                                                </tr>

                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-lg-12 col-xl-12">
                                                            <div class="modal" id="edit_modal2{{$child->id}}" tabindex="-1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title pull-left">Edit parent child relationship</h4>
                                                                            <button class="close" data-dismiss="modal">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                            <p>Edit the relationship between the parent and the child</p>
                                                                            
                                                                                        <form action="/parentchild/relationship/edit" method = "POST" >
                                                                                            @csrf
                                                                                            <input type="hidden" name="student_id" value="{{$child->student_id}}"/>
                                                                                            <input type="hidden" name="parent_id" value="{{$child->parent_id}}"/>
                                                                                            
                                                                                         
                                                                                                      <div class="row">
                                                                                                            <div class="col-xm-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                                                                                  <div class="form-group" id="relationship_div">
                                                                                                                          <label class="control-table" for="relationship">Relationship</label>
                                                                                                                          <select  name="relationship" class="form-control" required>

                                                                                                                                <option value="">Select relationship</option>
                                                                                                                                    @if ($parent_gender == "male")
                                                                                                                                    <option @if($child->relationship == "Father") selected @endif value="Father">Father</option>
                                                                                                                                        
                                                                                                                                    @elseif($parent_gender == "female")
                                                                                                                                    <option @if($child->relationship == "Mother") selected @endif value="Mother">Mother</option>
                                                                                                                                   
                                                                                                                                    @endif
                                                                                                                                    <option @if($child->relationship == "Guardian") selected @endif value="Guardian">Guardian</option>
                                                                                                                                        
                                                                                                                          </select>
                                                                                                                          <div id="relationship_error"></div>
                                                                                                                  </div>	
                                                                                                            </div>	
                                                                                                            </div>
                                                                                    
                                                                                                
                                                                                                <div style="align: center;" class="pull-right">
                                                                                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                                                                                <button type="submit" class="btn btn-success" value="Update">Update</button>
                                                                                                </div>
                                                                                    </form>
                                                                                    
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!--modal for delete confirmation -->
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-lg-12 col-xl-12">
                                                            <div class="modal" id="delete_modal{{$child->id}}" tabindex="-1">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title pull-left">Detach student from parent</h4>
                                                                            <button class="close" data-dismiss="modal">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">

                                                                                        <form action="/parentchild/detach" method = "POST" >
                                                                                            @csrf
                                                                                            <input type="hidden" name="student_id" value="{{$child->student_id}}"/>
                                                                                            <input type="hidden" name="parent_id" value="{{$child->parent_id}}"/>
                                                                                                                                                                                
                                                                                            <p style="color: red;">Are you sure you want to detach the student from this parent??</p>    
                                                                                                <div style="align: center;" class="pull-right">
                                                                                                 <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
                                                                                                <button type="submit" class="btn btn-danger" >Delete</button>
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
            
                   </div>
            
                   
            
            
            


        </div>
  </div>


       

         

  

       
<br>

    
      




    
@endsection