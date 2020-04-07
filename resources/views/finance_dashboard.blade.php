@extends('layouts.dashboard')

@section('content')
<div class="row">
        <div class="col-md-12">
            <h1 class="page-head-line">DASHBOARD</h1>
            <h2 style="text-align:center;"> Welcome to <strong>Finance department</strong> </h2>

        </div>
</div>



<div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$students_no}}</h3>
    
              <p>Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-person"></i>
            </div>
            <div class="small-box-footer" style="height:30px;">
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$percentage_cleared}}<sup style="font-size: 20px">%</sup></h3>
    
              <p>clean students</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-person"></i>
            </div>
            <div class="small-box-footer" style="height:30px;">
                </div>
        </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3><small>Ksh </small>{{$amount_collected}}</h3>
    
              <p>Amount collected</p>
            </div>
            <div class="icon">
              <i class="ion ion-cash"></i>
            </div>
            <div class="small-box-footer" style="height:30px;">
                </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>Reports</h3>
    
              <p>View reports</p>
            </div>
            <div class="icon">
              <i class="ion ion-printer"></i>
            </div>
            <a href="/finance_department/reports" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
        </div>
        <!-- ./col -->
      </div>
@endsection