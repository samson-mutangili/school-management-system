@extends('layouts.dashboard')

@section('content')

<?php 

use Illuminate\Support\Facades\DB;

function getStatus($year, $term){

    $status = "past";

    $check_status = DB::table('term_Sessions')
                        ->where('year', $year)
                        ->where('term', $term)
                        ->get();
    if(!$check_status->isEmpty()){
        foreach ($check_status as $term_status) {
            $status = $term_status->status;
        }
    }

    return $status;
}

$i = 1;

?>

            <div class="row">
                <div class="col-md-12">
                    <h1 class="page-head-line">All fee structures</h1>

                </div>
            </div>

            

             <div class="panel panel-primary w-auto">
                             <div class="panel-heading">
                               All fee structures
                             </div>
                               @csrf
                                <div class="panel-body">
                                       
                                                
                             
                                        <table class="table table-responsive-md table-responsive-sm table-responsive-lg table-responsive-xl" id="fee_structure_table">
                                                <thead class="active">
                                                    <th>S/NO</th>
                                                    <th>Academic Year</th>
                                                    <th>Class name</th>
                                                    <th>Term</th>
                                                    <th>Total fees</th>
                                                    <th>Status</th>
                                                </thead>
                                            
                                                <tbody>

                                                    @if (!$all_fee_structures->isEmpty())
                                                        @foreach ($all_fee_structures as $school_fees )
                                                            <tr>
                                                                <td>{{ $i++ }}</td>                                      
                                                                <td>{{ $school_fees->year}} </td>                                      
                                                                <td>{{ $school_fees->class}} </td>                                                                                   
                                                                <td>{{ $school_fees->term}} </td>                                      
                                                                <td>{{ $school_fees->fee}} </td>                                      
                                                                
                                                                    @if (getStatus($school_fees->year, $school_fees->term) == "active")
                                                                        <td style="color:green;">{{getStatus($school_fees->year, $school_fees->term)}}</td>
                                                                    @else
                                                                    <td style="color:red;">{{getStatus($school_fees->year, $school_fees->term)}}</td>

                                                                    @endif
                                                               

                     
                                                            </tr>
                                                        @endforeach
                                                    @endif

                                                </tbody>
                                        </table>
            

                               
                           
                             </div>
                             
                              
                                
                              </div>
                                 
      
    

    
@endsection

