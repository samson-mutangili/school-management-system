@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h4 class="page-head-line">Dashboard</h4>

    </div>
</div>


<div class="panel panel-default w-auto">
    <div class="panel-heading">
    </div>
      @csrf
       <div class="panel-body" style="margin-bottom: 200px;">

<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$active_students}}</h3>

          <p>Students</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-person"></i>
        </div>
        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
        <h3>{{ $teachers}}</h3>

          <p>Teachers</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="/teachers_details" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
        <h3>{{$non_teaching_staff}}</h3>

          <p>Non teaching staff</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="/nonTeachingStaffDetails" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>{{$alumni_students}}</h3>

          <p>Alumni students</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="/students/alumni" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>

</div>
    <!-- ./col -->

  </div>





       </div>

       
</div>
@endsection