
    @extends('layouts.dashboard')
    
    @section('content')
    
    <?php 
    $i = 1;

    function getRealClass($stream){

    $real_class;

    if($stream == '1E' || $stream == '1W'){
        $real_class = "Form 1";
    } else if($stream == '2E' || $stream == '2W'){
        $real_class = "Form 2";
    } else if($stream == '3E' || $stream == '3W'){
        $real_class = "Form 3";
    } else if($stream == '4E' || $stream == '4W'){
        $real_class = "Form 4";
    } else{
        $real_class = "Not valid";
    }

    return $real_class;
}
    ?>
    
    <div class="row">
            <div class="col-md-12">
                <h4 class="page-head-line">My Teaching classes</h4>
        
            </div>
        </div>
        
        <div class="panel panel-default w-auto">
            <div class="panel-heading">
             Teaching classes
            </div>
              @csrf
               <div class="panel-body">
                
                @if($teaching_classes->isEmpty())
                    <div class="alert alert-info" role="alert">
                        You have not been allocated any class to teach!
                    </div>

                @else

                <table class="table table-hover table-responsive-sm table-responsive-md " id="teacher_class_table">
                        <thead class="active">
                            <th width="5%">#NO</th>
                            <th>Year</th>
                            <th>Class</th>
                            <th>Stream</th>
                            <th>Subject</th>
                        </thead>
    
                        <tbody>
    
                            @if (!$teaching_classes->isEmpty())
                                @foreach ($teaching_classes as $teach_class)
                                    @if ($teach_class->subject1 != null)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$teach_class->year}}</td>
                                            <td>{{getRealClass($teach_class->class_name)}}</td>
                                            <td>{{$teach_class->class_name}}</td>
                                            <td>{{$teach_class->subject1}}</td>
                                        </tr>
                                    @endif

                                    @if ($teach_class->subject2 != null)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$teach_class->year}}</td>
                                            <td>{{getRealClass($teach_class->class_name)}}</td>
                                            <td>{{$teach_class->class_name}}</td>
                                            <td>{{$teach_class->subject2}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                </table>

                @endif

                
    
        </div>
    
               </div>
        
    @endsection