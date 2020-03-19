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
                       <form action="/forgot_password_submit" method="post" class="form-horizontal" name="login_form">
                      @csrf
                        <div class="panel-body">

                            
                       
                       <div class="0ffset-lg-1 offset-xl-1">

                        <p style="color: black; margin-bottom: 25px;"> OOPS!! Do not worry. Just a few steps to reset your password.</p>

                       </div>
                       
                       <div class="offset-lg-1 offset-xl-1">
                            @if( Session::get('no_user') != null)
                            <p style="color: red;">{{ Session::get('no_user') }}</p>
                            @endif
        
                     </div>
                       
                       <div class="form-group row" id="email_div">
                           
                                  <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="Old">Email address</label>
                          
                               <div class="col-lg-7 col-xl-7">
                                   <input type="email" class="form-control" id="email" name="email"  placeholder="Enter your email address" value="{{ Session::get('email') }}"/>
                                   <div id="email_error"></div>
                               </div>
                        </div>
                           
                           
                       
                       <div class="form-group row">
                               <div class="col-lg-7 offset-lg-4 col-xl-7 offset-xl-4">
                                   <button type="submit" name="save" class="btn btn-primary " style="border-radius: 8px;" onclick="return validateLogin()">Send </button>
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