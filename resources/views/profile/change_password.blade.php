@extends('layouts.dashboard')

@section('content')

<?php

$year = date("Y");

?>
<div id="page-wrapper">
        <div id="page-inner">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Settings</h1>

                </div>
            </div>

            

            <div class="row">
                        
    
                <div class="col-sm-10 offset-sm-1  col-md-10 0ffset-md-1  col-lg-10   col-xl-8 offset-xl-2">
                    
                                <div>
                                                @if ( Session::get('wrong_old_password') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('wrong_old_password')}}
                                                </div>
                                            
                                                @endif
                                 </div>    
                                
                                 <div>
                                                @if ( Session::get('no_user') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('no_user')}}
                                                </div>
                                            
                                                @endif
                                </div>  
                
        
        
                                <div>
                                                @if ( Session::get('no_set_session') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('no_set_session')}}
                                                </div>
                                            
                                                @endif
                                </div>   
        
                        
                                <div>
                                                @if ( Session::get('password_updated') != null)
                                            
                                                <div class="alert alert-success alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Success</strong> : {{ Session::get('password_updated')}}
                                                </div>
                                            
                                                @endif
                                 </div>  
                                 <div>
                                                @if ( Session::get('password_update_failed') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('password_update_failed')}}
                                                </div>
                                            
                                                @endif
                                 </div>  
                        <div class="panel panel-primary w-auto">
                             <div class="panel-heading">
                               Change password
                             </div>
                             <form action="/settings/changePassword" method="post" class="form-horizontal" name="change_password_form">
                                @csrf
                                <div class="panel-body">    
                             
                             <div class="form-group row" id="old_password_div">
                                 
                                        <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="old_passwordr">Old password</label>
                                
                                     <div class="col-lg-7 col-xl-7">
                                     <input type="password" class="form-control" id="old_password" name="old_password" required placeholder="Enter old password" value="{{$old_password ?? ''}}"/>
                                         <div id="old_password_error"></div>
                                     </div>
                              </div>
                                 
                                 
                                 <div class="form-group row" id="new_password_div">
                                     <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="new_password"> New Password</label>
                                     <div class="col-lg-7 col-xl-7">
                                          <input type="password" class="form-control" name="new_password" id="new_password" required placeholder="Enter new password" value="{{$new_password ?? ''}}"/>
                                                  
                                          <div id="new_password_error"></div>
                                     </div>
                                 </div>

                                 <div class="form-group row" id="confirm_new_password_div">
                                    <label class="col-lg-3 offset-lg-1 col-xl-3 offset-xl-1 control-label" for="confirm_new_password">Confirm new Password</label>
                                    <div class="col-lg-7 col-xl-7">
                                         <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password" required placeholder="Confirm new password" value="{{$new_password ?? ''}}"/>
                                                 
                                         <div id="confirm_new_password_error"></div>
                                    </div>
                                </div>

                             
                             <div class="form-group row">
                                     <div class="col-lg-7 offset-lg-4 col-xl-7 offset-xl-4">
                                         <button type="submit" name="save" class="btn btn-primary "  onclick="return validatePasswords()">Save </button>
                                     </div>
                                 </div>
                              
                             
                             </div>
                             </form>
                             
                              
                                
                              </div>
                                 
                             </div>
                                 </div>
        </div>
</div>
    



@endsection