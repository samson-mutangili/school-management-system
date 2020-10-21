@extends('layouts.dashboard')

@section('content')

<div class="row">
        <div class="col-md-12">
            <h4 class="page-head-line">Alumni non teaching staff details</h4>
    
        </div>
    </div>
    
    
    <div class="panel panel-default w-auto">
        <div class="panel-heading">
         Personal details
        </div>
          @csrf
           <div class="panel-body">
            
    

<div style="margin-left: 10px; margin-top: 10px;">


@foreach ($specific_alumni_details as $staff )


    <table cellspacing="7" cellpadding="7">
       
        <tbody>
            <tr>
                <td align="left">Name</td>
                <td>: {{ $staff->first_name}} {{$staff->middle_name}} {{$staff->last_name}}</td>
            </tr>

            <tr>
                <td align="left"> Phone number</td>
                <td>: {{$staff->phone_no}}</td>
            </tr>

            <tr>
                    <td align="left"> Email address</td>
                    <td>: {{$staff->email}}</td>
            </tr>
            
            <tr>
                    <td align="left"> ID Number</td>
                    <td>: {{$staff->id_no}}</td>
            </tr>


            <tr>
                    <td align="left"> Employee number</td>
                    <td>: {{$staff->emp_no}}</td>
            </tr>  
            
            
            <tr>
                    <td align="left"> Job category</td>
                    <td>: {{$staff->category}}</td>
            </tr>

            <tr>
                    <td align="left"> Gender</td>
                    <td>: {{$staff->gender}}</td>
            </tr>

            <tr>
                    <td align="left"> Religion</td>
                    <td>: {{$staff->religion}}</td>
            </tr>


            <tr>
                    <td align="left"> Nationality</td>
                    <td>: {{$staff->nationality}}</td>
            </tr>  
            
            
            <tr>
                    <td align="left"> Salary</td>
                    <td>: {{$staff->salary}}</td>
            </tr>

            <tr>
                    <td align="left"> Date of hire</td>
                    <td>: {{$staff->hired_date}}</td>
            </tr>

            <tr>
                <td align="left"> Date left</td>
                <td>: {{$staff->date_left}}</td>
             </tr>

        </tbody>
    </table>

<a href="/alumniStaff">    <button name="back_button" id="{{$staff->id}}" style="margin-top: 20px; width: 7em;" class="btn btn-primary">Back</button> </a>


@endforeach

</div>

           </div>
        </div>
@endsection