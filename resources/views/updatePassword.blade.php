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
                       <form action="/reset_pass" method="post" class="form-horizontal" name="update_password_form">
                       <div class="panel-body">
                       
                       @csrf
                       
                       <div class="form-group row" id="password_div">
                          
                                  <label class="col-lg-4 col-xl-4 control-label" for="Old">New password  </label>
                       <input type="hidden" name="email" value="{{ $user_email}}" />
                               <div class="col-lg-7 col-xl-7">
                                   <input type="password" class="form-control" id="password" name="password"  placeholder="Enter new password"/>
                                   <div id="password_error"></div>
                               </div>
                        </div>
                           
                           
                           <div class="form-group row" id="password_confirm_div">
                               <label class="col-lg-4 col-xl-4 control-label" for="password_confirm">Confirm password</label>
                               <div class="col-lg-7 col-xl-7">
                                    <input class="form-control" name="password_confirm" id="password_confirm" type="password" placeholder="Confirm password">
                                    <div id="password_confirm_error"></div>
                               </div>
                           </div>
                           
                       
                       <div class="form-group row">
                               <div class="col-lg-7 offset-lg-4 col-xl-7 offset-xl-4">
                                   <button type="submit" name="save" class="btn btn-primary " style="border-radius: 8px;" onclick="return validateNewPassword()">Login </button>
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