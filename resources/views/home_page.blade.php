@extends('layouts.header')

@section('content')

<div style="margin-top: 80px; ">
  <div class="container">          
  <div class="row">
                
                <div >
                    <div id="imageCarousel"  class="carousel slide" data-interval="3000" data-ride="carousel">

                        <ol class="carousel-indicators">
                            <li data-target="#imageCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#imageCarousel" data-slide-to="1"></li>
                            <li data-target="#imageCarousel" data-slide-to="2"></li>
                            <li data-target="#imageCarousel" data-slide-to="3"></li>
                            <li data-target="#imageCarousel" data-slide-to="4"></li>
                        </ol>

                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active">
                                <img src="{{ URL::asset('images/final_adm_block .png') }}" class=" d-block w-100 img-responsive" alt="first_image" />
                                <div class="carousel-caption">
                                    <h3>Admnistrtion Block</h3>
                                    <p>Modern beautiful adminstration block</p>
                                </div>                            
                            </div>


                            <div class="carousel-item">
                                    <img  src="{{ URL::asset('images/final_fedcos .png') }}" class=" d-block w-100 img-responsive"  alt="second_image" />                                    <div class="carousel-caption">
                                        <h3>Classes</h3>
                                        <p>Classes where students pertake their classes</p>
                                    </div>                            
                            </div>


                            <div class="carousel-item">

                                    <img  src="{{ URL::asset('images/final_gate .png') }}" class=" d-block w-100 img-responsive" alt="third_image"/>                                        <div class="carousel-caption">
                                            <h3>Main gate</h3>
                                            <p>Main gate located at the entrance of the school</p>
                                        </div>                            
                            </div>

                            <div class="carousel-item">

                                    <img  src="{{ URL::asset('images/final_gsquare .png') }}" class=" d-block w-100 img-responsive" alt="fourth_image" />                                    <div class="carousel-caption">
                                        <h3>Assembly ground</h3>
                                        <p>Assembly ground where students gather during public address</p>
                                    </div>                            
                            </div>

                            <div class="carousel-item">

                              <img  src="{{ URL::asset('images/final_students .png') }}" class=" d-block w-100 img-responsive" alt="fourth_image" />                                    <div class="carousel-caption">
                                  <h3>Students</h3>
                                  <p>Active students during a class lesson</p>
                              </div>                            
                      </div>

                            <a class="carousel-control-prev"  href="#imageCarousel" role="button" data-slide="prev">

                                <span class="carousel-control-prev-icon"></span>
                                <span class="sr-only">Previous</span>
                            </a>

                            <a class="carousel-control-next"  href="#imageCarousel" role="button" data-slide="next">

                                    <span class="carousel-control-next-icon"></span>
                                    <span class="sr-only">Next</span>
                                </a>
    

                        </div>
                    </div>
                </div> 
            </div>
  </div>  
</div>
      

     
    
@endsection