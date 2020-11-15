@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        <h1 class="page-head-line">Older merit lists</h1>
    </div>
</div>
<?php $i = 1;

?>
 

<div class="panel panel-primary w-auto">
    <div class="panel-heading">
      
    </div>
       <div class="panel-body">

       
            <table class="table table-hover table-responsive-sm table-responsive-md " id="older_merit_list_table">
                    <thead class="active">
                        <th width="5%">#NO</th>
                        <th>Year</th>
                        <th>Term</th>
                        <th>Exam Type</th>
                        <th>Class</th>                        
                        <th>Action</th>
                    </thead>

                    <tbody>

                        @if (!$older_merit_lists->isEmpty())
                            @foreach ($older_merit_lists as $merit_list)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$merit_list->year}}</td>
                                    <td>{{$merit_list->term}}</td>
                                    <td>{{$merit_list->exam_type}}</td>
                                    @if($merit_list->class_name == "1W" || $merit_list->class_name == "1E" )
                                        <td>Form 1</td>
                                    @elseif($merit_list->class_name == "2W" || $merit_list->class_name == "2E")
                                        <td>Form 2</td>
                                    @elseif($merit_list->class_name == "3W" || $merit_list->class_name == "3E")
                                        <td>Form 3</td>
                                    @elseif($merit_list->class_name == "4W" || $merit_list->class_name == "4E")
                                        <td>Form 4</td>
                                    @else
                                        <td>??</td>
                                    @endif
                                    <td>
                                        Download    
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
            </table>
       </div>
</div>

                
    
@endsection