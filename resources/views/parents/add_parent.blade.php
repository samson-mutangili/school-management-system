<style>
    input[type="radio"]{
      margin: 0 10px 0 10px;
    }

    fieldset{
            border: 2px solid #333;
            border-radius: 10px;
            padding: 5px;
    }

    legend{
        color: #red;
    }

    input[type="checkbox"]{
      margin: 0 10px 0 10px;
    }
        </style>
    
    @extends('layouts.dashboard')
    
    @section('content')
    
    
    <div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">Parents</h1>
    
        </div>
    </div>
    
    <div class="panel panel-primary w-auto">
        <div class="panel-heading">
         
        </div>
          @csrf
           <div class="panel-body">
                <h3 style="text-decoration: underline; color:green;">Add new parent</h3>	
                <div style="margin-top: 15px;">
                        @if ( Session::get('email_conflict') != null)
                    
                        <div class="alert alert-danger alert-dismissible">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Failed</strong> : {{ Session::get('email_conflict')}}
                        </div>
                    
                        @endif
                </div> 
                
                <div style="margin-top: 15px;">
                    @if ( Session::get('id_no_conflict') != null)
                
                    <div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Failed</strong> : {{ Session::get('id_no_conflict')}}
                    </div>
                
                    @endif
            </div>  
        

        <div class="row">
        <form action="/parents/addNew" method = "POST" name="parent_form" onsubmit="return validateParent()">
                @csrf
                <div>
        <div>
            
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2"></div>
                
                <div class="col-xl-10 col-lg-10 col-md-12 col-sm-12 col-xs-12">
                <div style="margin-top: 10px; margin-left: 10px;">
                     
  
                            <div class="row">
                                
                                    
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="first_name_div">
                                                <label class="control-table" for="first_name">First name</label>
                                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Enter first name" value="{{$first_name ?? ''}}">
                                                <div id="first_name_error"></div>
                                        </div>	
                                  </div>
            
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="middle_name_div">
                                                <label class="control-table" for="middle_name">Enter middle name</label>
                                                <input type="text" name="middle_name" id="middle_name" class="form-control" placeholder="Enter middle name" value="{{$middle_name ?? ''}}">
                                                <div id="middle_name_error"></div>
                                        </div>	
                                  </div>
            
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group" id="last_name_div">
                                                <label class="control-table" for="last_name">Last name</label>
                                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Enter last name" value="{{$last_name ?? ''}}">
                                                <div id="last_name_error"></div>
                                        </div>	
                                  </div>
          
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                          <div class="form-group" id="phone_no_div">
                                                  <label class="control-table" for="phone_no">Phone number</label>
                                                  <input type="number" name="phone_no" id="phone_no" class="form-control" placeholder="Phone number" value="{{$phone_no ?? ''}}">
                                                  <div id="phone_no_error"></div>
                                          </div>
                                      
                                  </div>
      
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-8 col-xl-8">
                                      <div class="form-group" id="email_div">
                                              <label for="email">Email address</label>
                                              <input type="email" id="email" class="form-control" name="email" placeholder="Email address" value="{{$email ?? ''}}" >
                                              <div id="email_error"></div>
                                          </div>                            
                                   </div>
          
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                          <div class="form-group" id="gender_div">
                                                  <label for="gender">Gender</label>
                                                  <select id="gender" name="gender" class="form-control" required>
                                                      <option value="">Select gender</option>
                                                      <option @if($gender ?? '' == "male") selected @endif value="male">Male</option>
                                                       <option @if($gender ?? '' == "female") selected @endif value="female">female</option>
                                                  </select>
                                                  <div id="gender_error"></div>
                                              </div>
                                      
                                  </div>
          
                                  
          
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                          <div class="form-group" id="id_no_div">
                                                  <label for="id_no">ID number</label>
                                                  <input type="number" id="id_no" class="form-control" name="id_no"  value="{{$id_no ?? ''}}">
                                                  <div id="id_no_error"></div>
                                          </div>
                                      
                                  </div> 
      
                                  <div class="col-xm-12 col-sm-12 col-md-6 col-lg-4 col-xl-4">
                                      <div class="form-group" id="occupation_div">
                                              <label for="occupation">Occupation</label>
                                              <input type="text" id="occupation" class="form-control" name="occupation" placeholder="Parents occupation" value="{{$occupation ?? ''}}"  >
                                              <div id="occupation_error"></div>
                                      </div>
                                  
                              </div> 
                              </div>
                <div style="align: center;" class="pull-right">
                <input type="submit" class="btn btn-success" value="Submit" onClick="return validateParent()">
                
                </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </form>
        </div>
    
           </div>
    </div>
    
    @endsection

{{-- <script>

        $(document).ready(function(){
                $('#id_no').blur(function(){
                        var id_error = ''; 
                        var id = $('#id_no').val();
                        var _token = $('input[name="_token"]').val(); 


                   $.ajax({
                           url:"{{ route('id_aavailable.check') }}"
                           method:"POST"
                           
                   })      
                });
        });

</script> --}}
