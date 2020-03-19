@extends('layouts.header')

@section('content')
    


<div style="margin-top: 80px;">
        <div class="container">          
        <div class="row">
                        
          
          <div class="col-sm-8 offset-sm-2 col-md-8  offset-md-2  col-lg-8 offset-lg-2 col-xl-6 offset-lg-3">
              <div class="panel panel-primary w-auto">
                       <div class="panel-heading">
                         Reset password
                       </div>
                       <form action="/reset_password" method="post" class="form-horizontal" name="code_form">
                       @csrf
                        <div class="panel-body">
                               
                       <div class="0ffset-lg-1 offset-xl-1">

                        <p style="color: black; margin-bottom: 25px;"> Check your email for the confirmation code send.</p>

                       </div>

                       <div class="offset-lg-1 offset-xl-1">
                            <p>{{$token2 ?? ''}}</p>
                                    @if($invalid_token ?? '' != null)
                                    <p style="color: red;">{{ $invalid_token ?? '' }}</p>
                                    @endif
                
                             </div>
                       
                       
                       <div class="form-group row" id="code_div">
                           <input type="hidden" name="email" value="{{$user_email}}"/>
                           
                                  <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="Old">Code</label>
                          
                               <div class="col-lg-7 col-xl-7">
                                   <input type="number" class="form-control" id="code" name="code"  placeholder="Enter confirmation code" />
                                   <div id="code_error"></div>
                               </div>
                        </div>
                           
                           
                       
                       <div class="form-group row">
                               <div class="col-lg-7 offset-lg-4 col-xl-7 offset-xl-4">
                                   <button type="submit" name="save" class="btn btn-primary " style="border-radius: 8px;" onclick="return validateCode()">Send </button>
                               </div>
                           </div>
                        
                       <div class="col-lg-7 offset-lg-4 col-xl-7 offset-xl-4">
      
                        <p> Click <a href="/signin">here</a> to login</p>
                       </div>
                       </div>
                       </form>
                       
                        
                          
                        </div>
                           
                       </div>
                           </div>
                  </div>
        </div>  
              

@endsection