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
          <h3>{{$teaching_classes}}</h3>

          <p>My Teaching classes</p>
        </div>
        <div class="icon">
          <i class="ion ion-ios-book"></i>
        </div>
        <a href="#" class="small-box-footer" ></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
        <h3>{{ $roles}}</h3>

          <p>Roles</p>
        </div>
        <div class="icon">
          <i class="fa fa-tasks"></i>
        </div>
        <a href="" class="small-box-footer"></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
        <h3>{{$responsibilities}}</h3>

          <p>Responsibilities</p>
        </div>
        <div class="icon">
          <i class="fa fa-tasks"></i>
        </div>
        <a href="" class="small-box-footer"></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>2</h3>

          <p>Teaching subjects</p>
        </div>
        <div class="icon">
          <i class="fa fa-book"></i>
        </div>
        <a href="" class="small-box-footer"></a>
      </div>
    </div>

</div>
    <!-- ./col -->
  </div>





       </div>
</div>
@endsection