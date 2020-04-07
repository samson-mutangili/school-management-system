@extends('layouts.dashboard')

@section('content')

<?php

$year = date("Y");

?>
            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">Take Fees</h1>

                </div>
            </div>

            

            <div class="row">
                        
    
                <div class="col-sm-10 offset-sm-1  col-md-10 0ffset-md-1  col-lg-10   col-xl-8 offset-xl-2">
                    
                                <div>
                                                @if ( Session::get('form1_fee_set') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('form1_fee_set')}}
                                                </div>
                                            
                                                @endif
                                 </div>    
                                
                                 <div>
                                                @if ( Session::get('form2_fee_set') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('form2_fee_set')}}
                                                </div>
                                            
                                                @endif
                                </div>  
                
        
        
                                <div>
                                                @if ( Session::get('form3_fee_set') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('form3_fee_set')}}
                                                </div>
                                            
                                                @endif
                                </div>   
        
                        
                                <div>
                                                @if ( Session::get('form4_fee_set') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('form4_fee_set')}}
                                                </div>
                                            
                                                @endif
                                 </div>  
                                 <div>
                                                @if ( Session::get('fee_set') != null)
                                            
                                                <div class="alert alert-danger alert-dismissible">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong>Failed</strong> : {{ Session::get('fee_set')}}
                                                </div>
                                            
                                                @endif
                                 </div>  
                        <div class="panel panel-primary w-auto">
                             <div class="panel-heading">
                               Take fees
                             </div>
                             
                             <form action="/finance_department/record_fee" method="post" class="form-horizontal" name="fee_input_form">
                                @csrf
                                <div class="panel-body">
                             
                             
                             
                                        <div class="row">
                                            <input type="hidden" name="id" value="{{$id}}" />
                             <div class="form-group col-md-12 col-lg-6 col-xl-6" id="name_div">
                                 
                                        <label class="control-label" for="name">Name</label>
                                
                                     <div >
                                     <input type="text" readonly class="form-control" id="name" name="name" value="{{$student_name}}" />
                                         
                                     </div>
                              </div>
                                 
                                 
                                 <div class="form-group col-md-6 col-lg-6 col-xl-6" id="class_name_div">
                                     <label class="control-label" for="class_name"> Class</label>
                                     <div>
                                     <input type="text" class="form-control" readonly id="class_name" name="class_name" value="{{$class_name}}" />

                                     </div>
                                 </div>

                                 <div class="form-group col-md-6 col-lg-6 col-xl-6">
                                                <label class="control-label" for="admission_no"> Admission number</label>
                                                <div >
                                                <input type="number" class="form-control" readonly id="admission_no" name="admission_no" value="{{$adm_no}}" />

                                                </div>
                                 </div>

                                 <div class="form-group form-group col-md-12 col-lg-6 col-xl-6" >
                                 
                                        <label class=" control-label" for="fee_balance">Fees balance</label>
                                
                                     <div class="">
                                     <input type="number" class="form-control" readonly id="total_fees" name="fee_balance"  value="{{$fee_balance}}"/>
                                         
                                     </div>
                                </div>

                                <div class="form-group form-group col-md-12 col-lg-6 col-xl-6" id="branch_name_div">
                                 
                                        <label class=" control-label" for="branch_name">Branch</label>
                                
                                            <div >
                                                <select class="form-control" name="branch_name" >
                                                        <option value="">Bank branch where fees was paid</option>
                                                        <option >KCB Egerton University</option>
                                                        <option >KCB Nakuru</option>
                                                        <option >KCB Industrial area Nairobi</option>
                                                        <option >KCB Moi Avenue Nairobi</option>
                                                        <option >KCB Eldoret</option>
                                                        <option >KCB Kenyatta Avenue Nakuru</option>
                                                </select>
                                                <div id="branch_name_error"></div>
                                            </div>  
                                </div>

                                <div class="form-group form-group col-md-12 col-lg-6 col-xl-6" id="ref_no_div">
                                 
                                        <label class=" control-label" for="ref_no">Transaction number</label>
                                
                                     <div class="">
                                         <input type="text" class="form-control" id="ref_no" name="ref_no" placeholder="Enter receipt reference number" value="{{$transaction_no ?? ''}}"/>
                                         <div id="ref_no_error"></div>
                                         <div style="color:red;">{{$transaction_no_error_message ?? ''}}</div>
                                     </div>
                                </div>

                                <div class="form-group form-group col-md-6 col-lg-6 col-xl-6" id="date_paid_div">
                                 
                                        <label class=" control-label" for="date_paid">Date Paid</label>
                                
                                     <div class="">
                                         <input type="date" class="form-control" required id="date_paid" name="date_paid" placeholder="Enter the date the fee was paid" value="{{$date_paid ?? ''}}"/>
                                         <div id="date_paid_error"></div>
                                     </div>
                                </div>

                                <div class="form-group form-group col-md-6 col-lg-6 col-xl-6" id="amount_div">
                                 
                                        <label class=" control-label" for="amount">Amount</label>
                                
                                     <div class="">
                                         <input type="number" class="form-control" aria-required id="amount" name="amount" placeholder="Enter amount paid" value="{{$amount ?? ''}}"/>
                                         <div id="amount_error"></div>
                                     </div>
                                </div>
                             
                             <div class="form-group form-group col-md-6 col-lg-6 col-xl-6">
                                     <div class="">
                                         <button type="submit" name="save" class="btn btn-primary "  onclick="return validateFeeInput()">Save </button>
                                     </div>
                                 </div>
                              
                                </div>
                             </div>
                             </form>
                             
                             
                              
                                
                              </div>
                                 
                             </div>
                                 </div>
  
    



@endsection