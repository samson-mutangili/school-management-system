<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\StudentMarksRanking;
use Illuminate\Support\Facades\DB;
use PDF;

class ViewReportForms extends Controller
{
    //

    private $student_id;
    private $class_name;
    public function report_form($studentID, $className){

        global $student_id, $class_name;
        
        $this->student_id = $studentID;
        $this->class_name = $className;

        return response($this->student_report_form());

    }

    public function student_report_form(Request $request){

        $student_id = $request->input('student_id');
        $class_name = $request->input('class_name');

        //check if student exists
        $check_student = DB::table('students')
                           ->where('id',$student_id)
                           ->get();

        if($check_student->isEmpty()){
            $request->session()->flash('invalid_student', 'Invalid student!! There is no student with id as '.$student_id);
            return redirect('report_forms/'.$class_name);
        }

        $specific_student_id = $student_id;
        $specific_class_name = $class_name;

        $all_streams;

        if($specific_class_name == '1E' || $specific_class_name == '1W'){
            $all_streams = ['1E', '1W'];
        } else if($specific_class_name == '2E' || $specific_class_name == '2W'){
            $all_streams = ['2E', '2W'];
        }
        else if($specific_class_name == '3E' || $specific_class_name == '3W'){
            $all_streams = ['3E', '3W'];
        }
        else if($specific_class_name == '4E' || $specific_class_name == '4W'){
            $all_streams = ['4E', '4W'];
        } else{
            $request->session()->flash('invalid_class_stream', 'Invalid class stream!! There is no class stream '.$specific_class_name);
            return redirect('report_forms/'.$class_name);
        }


        //get the term session and exams sessions periods
        $term_exam = DB::table('term_sessions')
                        ->join('exam_sessions', 'term_sessions.term_id', 'exam_sessions.term_id')
                        ->where('term_sessions.status', 'active')
                        ->where('exam_sessions.exam_status', 'active')
                        ->get();

        if($term_exam->isEmpty()){
            $request->session()->flash('No_active_exam_session', 'There is no active exam session. Therefore result slips are not ready. However, you can download other result slips under specific student details');
            return redirect('report_forms/'.$class_name);

        }  else{
            //get the exam session period
            foreach($term_exam as $exam_period){
                $year = $exam_period->year;
                $term = $exam_period->term;
                $exam_type = $exam_period->exam_type;
            }
        }

        //check if there are any marks for student
        $check_marks_entry = DB::table('student_marks')
                                ->where('student_id', $student_id)
                                ->where('year', $year)
                                ->where('term', $term)
                                ->where('class_name', $class_name)
                                ->where('exam_type', $exam_type)
                                ->get();

        if($check_marks_entry->isEmpty()){
            $request->session()->flash('result_slip_not_ready', 'Result slip not ready because no marks have been submitted yet!!');
            return redirect('report_forms/'.$class_name);

        } 
        

        return view('exams.view_report_form', ['specific_student_id'=>$specific_student_id, 'specific_class_name'=>$specific_class_name]);

        //validation done, view the report form

        $report_form_data = $this->getData($student_id, $class_name);

          include(app_path() . '/admin_styles.php');
  

          $output = '
          <!DOCTYPE html>
  <html lang="en">
  <head>
      <title>School management system</title>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      
  
  </head>
  <body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
  
  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
      <div class="sidebar-brand-icon rotate-n-15">
      </div>
      <div class="sidebar-brand-text mx-3">Shiners high school</div>
    </a>
  
    <!-- Divider -->
    <hr class="sidebar-divider my-0">
  
  
    <!-- Divider -->
    <hr class="sidebar-divider">
    
     <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#trips" aria-expanded="true" aria-controls="collapseTwo">
        <span>Teachers</span>
      </a>
      <div id="trips" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
           <a class="collapse-item" href="/teachers_details">Teachers details</a>
          <a class="collapse-item" href="/addTeacher">Add new teacher</a>
          <a class="collapse-item" href="#">Assign roles</a>
        </div>
      </div>
    </li>
    
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#bookingRequests" aria-expanded="true" aria-controls="collapseTwo">
        <span>Students</span>
      </a>
      <div id="bookingRequests" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <a class="collapse-item" href="/students_details">Students details</a>
          <a class="collapse-item" href="/add_student">Add new student</a>
          <!--  <a class="collapse-item" href="ViewLocalBookings.jsp">Local use requests</a>-->
        </div>
      </div>
    </li>
  
  
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        <span>Non teaching staff</span>
      </a>
      <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
        
          <a class="collapse-item" href="/nonTeachingStaffDetails">All staff</a>
          <a class="collapse-item" href="/addStaff">Add new</a>
          <a class="collapse-item" href="/alumniStaff">Alumni staff</a>
        </div>
      </div>
    </li>
  
  
  
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#form1_classes" aria-expanded="true" aria-controls="collapseUtilities">
          <span>Form 1</span>
        </a>
        <div id="form1_classes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="/marks_entry/1E">Form 1E</a>
            <a class="collapse-item" href="/marks_entry/1W">Form 1W</a>
            
          </div>
        </div>
      </li>
  
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#form2_classes" aria-expanded="true" aria-controls="collapseUtilities">
          <span>Form 2</span>
        </a>
        <div id="form2_classes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="/marks_entry/2E">Form 2E</a>
            <a class="collapse-item" href="/marks_entry/2W">Form 2W</a>
            
          </div>
        </div>
      </li>
  
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#form3_classes" aria-expanded="true" aria-controls="collapseUtilities">
          <span>Form 3</span>
        </a>
        <div id="form3_classes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="/marks_entry/3E">Form 3E</a>
            <a class="collapse-item" href="/marks_entry/3W">Form 3W</a>
            
          </div>
        </div>
      </li>
  
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#form4_classes" aria-expanded="true" aria-controls="collapseUtilities">
          <span>Form 4</span>
        </a>
        <div id="form4_classes" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
              <a class="collapse-item" href="/marks_entry/4E">Form 4E</a>
            <a class="collapse-item" href="/marks_entry/4W">Form 4W</a>
            
          </div>
        </div>
      </li>
  
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#merit_lists" aria-expanded="true" aria-controls="collapseUtilities">
          <span>Merit lists</span>
        </a>
        <div id="merit_lists" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <hr>
              <a class="collapse-item" href="/viewMeritListForm1">Form 1</a>        
            <hr>
            <a class="collapse-item" href="/viewMeritListForm2">Form 2</a>
            <hr>
            <a class="collapse-item" href="/viewMeritListForm3">Form 3</a>
            <hr>
              <a class="collapse-item" href="/viewMeritListForm4">Form 4</a>
            <hr>
          </div>
        </div>
      </li>
  
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#report_forms" aria-expanded="true" aria-controls="collapseUtilities">
            <span>Result Slips</span>
          </a>
          <div id="report_forms" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <hr>
                <a class="collapse-item" href="/report_forms/1E">Form 1E</a>
                <a class="collapse-item" href="/report_forms/1W">Form 1W</a>            
              <hr>
              <a class="collapse-item" href="/report_forms/2E">Form 2E</a>
              <a class="collapse-item" href="/report_forms/2W">Form 2W</a>
              <hr>
              <a class="collapse-item" href="/report_forms/3E">Form 3E</a>
              <a class="collapse-item" href="/report_forms/3W">Form 3W</a>
              <hr>
                <a class="collapse-item" href="/report_forms/4E">Form 4E</a>
              <a class="collapse-item" href="/report_forms/4W">Form 4W</a>
              <hr>
            </div>
          </div>
        </li>
  
    <!-- Divider -->
    <hr class="sidebar-divider">
  
     
    
    
  
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
  
    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
  
  </ul>
  <!-- End of Sidebar -->
  
  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">
  
    <!-- Main Content -->
    <div id="content">
  
      <!-- Topbar -->
      <nav style="height: 40px;" class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
  
        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
          <i class="fa fa-bars"></i>
        </button>
  
        <!-- Topbar Search -->
        
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">
        <li class="nav-l"></li>
  
          <!-- Nav Item - Search Dropdown (Visible Only XS) -->
          <li class="nav-item dropdown no-arrow d-sm-none">
            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-search fa-fw"></i>
            </a>
            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
              <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                  <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                      <i class="fas fa-search fa-sm"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </li>
  
          
  
          <!-- Nav Item - Messages -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
             <!-- <i class="fas fa-envelope fa-fw"></i> --> 
              <!-- Counter - Messages -->
              <!-- <span class="badge badge-danger badge-counter">7</span> -->
            </a>
            <!-- Dropdown - Messages -->
          
          </li>
  
          <div class="topbar-divider d-none d-sm-block"></div>
  
          <!-- Nav Item - User Information -->
          <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              
  
  
              <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
              <!-- <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60"> -->
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
               <!--<a class="dropdown-item" href="#">
                 <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                Profile
              </a>
              <a class="dropdown-item" href="#">
                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                Settings
              </a>
              <a class="dropdown-item" href="#">
                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                Activity Log
              </a> -->
               <div class="dropdown-divider"></div>
            
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="">
              <span class="focus-input100" data-placeholder="&#xf191;"></span>
                Change password
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="">
                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                Logout
              </a>
              <div class="dropdown-divider"></div>
              
            </div>
          </li>
  
        </ul>
  
      </nav>
      <!-- End of Topbar -->
  
      <!-- Begin Page Content -->
      <div class="container-fluid">
          <div style="padding-left: 50px; padding-right: 50px; ">
              ';
  
          $output .= '
          '.$report_form_data.'
          ';
  
  
          $output .='
          </div>
  
          </div>
          <!-- End of Main Content -->
    
          <!-- Footer -->
          <footer style="align: bottom; margin-top: 30%;" class="sticky-footer bg-white static-bottom">
            <div class="container my-auto">
              <div class="copyright text-center my-auto">
                <span><!-- Copyright &copy; --> Shiners high school management system</span>
              </div>
            </div>
          </footer>
          <!-- End of Footer -->
    
        </div>
        <!-- End of Content Wrapper -->
    
      </div>
      <!-- End of Page Wrapper -->
    
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
      </a>
    
    </body>
    </html>
          
  
          ';
  
          return $output;
    }








































    //functions for generating student report forms


    public function getData($specific_student_id, $specific_class_name){

      $all_streams;

      if($specific_class_name == '1E' || $specific_class_name == '1W'){
          $all_streams = ['1E', '1W'];
      } else if($specific_class_name == '2E' || $specific_class_name == '2W'){
          $all_streams = ['2E', '2W'];
      }
      else if($specific_class_name == '3E' || $specific_class_name == '3W'){
          $all_streams = ['3E', '3W'];
      }
      else if($specific_class_name == '4E' || $specific_class_name == '4W'){
          $all_streams = ['4E', '4W'];
      } else{

      }

      $stream1 =$all_streams[0];
      $stream2 = $all_streams[1];

      //get the student id and class name
      $student_id = $specific_student_id;
      $class_name = $specific_class_name;

      $total_marks = 0;
      $average = 0;


      //get the term session and exams sessions periods
        $term_exam = DB::table('term_sessions')
                        ->join('exam_sessions', 'term_sessions.term_id', 'exam_sessions.term_id')
                        ->where('term_sessions.status', 'active')
                        ->where('exam_sessions.exam_status', 'active')
                        ->get();

        if(!$term_exam->isEmpty()){
            //get the exam session period
            foreach($term_exam as $exam_period){
                $year = $exam_period->year;
                $term = $exam_period->term;
                $exam_type = $exam_period->exam_type;
            }

        } else{
            $request->session()->flash('no_exam_sessions', 'Report forms are not ready because no exam session is active. However, you can find individual student report forms under specific student details!');
            return redirect('/report_forms/'.$class_name);
        }

      //get the student personal details
      $student_details = DB::table('students')
                           ->where('id', $student_id)
                           ->get();


      $report_form = DB::table('student_marks')
                       ->where('year',$year)
                       ->where('term', $term)
                       ->where('exam_type', $exam_type)
                       ->where('student_id', $student_id)
                       ->where('class_name', $class_name)
                       ->get();

      $output = '
      <a href="/report_forms/'.$class_name.'" class="btn btn-outline-primary">Back</a>
      <a href="/report_form/'.$student_id.','.$class_name.'" target="_blank" class="btn btn-outline-primary" style="float: right;">Download</a>
      <h2 style="text-align:center;">REPORT FORM             Term '.$term.' '.$exam_type.' exam  '.$year.'</h2>
      ';

      foreach($student_details as $student){

          $output .=' 
          <table width="100%" style="border-collapse: collapse; border:0px;">
          <tr>
              <th style="border: 1px solid; padding: 5px;" align="left" width="20%" >ADM NO: '.$student->admission_number.'</th>
              <th style="border: 1px solid; padding: 5px;"  align="left" width="60%" >Name: '.$student->first_name.' '.$student->middle_name.' '.$student->last_name.'</th>
              <th style="border: 1px solid; padding: 5px;"  align="left" width="20%" >Class: '.$class_name.'</th>

          </tr>';
      }

          
      $output .= '</table><br>
      
      <table width="100%" style="border-collapse: collapse; border:0px;">
          <tr>
              <th style="border: 1px solid; padding: 5px;" align="left" >Subject</th>
              <th style="border: 1px solid; padding: 5px;"  align="left" width="10%" >Marks 100%</th>
              <th style="border: 1px solid; padding: 5px;"  align="left"width="7%">Grade</th>
              <th style="border: 1px solid; padding: 5px;" align="left" width="10%" >Subject Position</th>
              <th style="border: 1px solid; padding: 5px;" align="left" >Remarks</th>
              <th style="border: 1px solid; padding: 5px;" align="left"  >Subject teacher</th>
              

          </tr>
     
  
  ';

  foreach($report_form as $report){

      $output .= '
      <tr>
          <td style="border: 1px solid; padding: 5px;"> '.$report->subject.'</td>
          <td style="border: 1px solid; padding: 5px;"> '.$report->marks_obtained.'</td>
          <td style="border: 1px solid; padding: 5px;"> '.$report->grade.'</td>';

          if($report->subject != null){
                  $subject_standing = $this->getSubjectPosition($year, $term, $exam_type, $all_streams[0], $all_streams[1], $report->subject, $student_id);
                  
                  $output .= '
                  <td  style="border: 1px solid; padding: 5px;">'.$subject_standing.'</td>
                  ';
          }else{

              $output .= '
              <td  style="border: 1px solid; padding: 5px;">'.$subject_standing.'</td>
              ';
          }
          
           
         $output .=' <td  style="border: 1px solid; padding: 5px;"> '.$report->comments.'</td>
      ';

      $teachers = DB::table('teachers')
                   ->where('id', $report->teacher_id)
                   ->get();
      foreach($teachers as $teacher){

              $output .= '            
              <td  style="border: 1px solid; padding: 5px;"> '.$teacher->first_name.' '.$teacher->last_name.'</td>

          </tr>
          ';
  }
}

      $overall_total_marks = DB::table('student_marks_ranking')
                      ->where('year',$year)
                      ->where('term', $term)
                      ->where('exam_type', $exam_type)
                      ->where('student_id', $student_id)
                      ->where('class_name', $class_name)
                      ->get();

       $total_marks_of_student = 0;
       $average_grade = '';
       $average_marks = 0;
       $stream_students = DB::table('student_marks_ranking')
                              ->where('year',$year)
                              ->where('term', $term)
                              ->where('exam_type', $exam_type)
                              ->where('class_name', $class_name)
                              ->count();


          foreach($overall_total_marks as $marks){
              $total_marks_of_student = $marks->total;
              $average_grade = $marks->average_grade;
              $average_marks = $marks->average_marks;
          }
                    

     

      $total_students = DB::table('student_marks_ranking')
                          ->where('year',$year)
                          ->where('term', $term)
                          ->where('exam_type', $exam_type)
                          ->where('student_id', $student_id)
                          ->where('class_name', $class_name)
                          ->get();  
                  
      $no_of_subjects = 0;

  if($class_name == '1E' || $class_name == '1W' || $class_name == '2E' || $class_name == '2W'){
      $no_of_subjects = 11;
  } else{

      //get the number of students  according to the subjects done by form 3 and form 4 students
      //find the total marks for the student
      $student_total_marks = DB::table('student_marks_ranking')
                                  ->where('year', $year)
                                  ->where('term', $term)
                                  ->where('exam_type', $exam_type)
                                  ->where('class_name', $class_name)
                                  ->where('student_id', $student_id)
                                  ->get();

      
          foreach($student_total_marks as $student_marks){

              if($student_marks->english != null){
              $no_of_subjects++;
              }

              if($student_marks->kiswahili != null){
              $no_of_subjects++;
              }

              if($student_marks->mathematics != null){
              $no_of_subjects++;
              }

              if($student_marks->chemistry != null){
              $no_of_subjects++;
              }

              if($student_marks->physics != null){
              $no_of_subjects++;
              }

              if($student_marks->biology != null){
              $no_of_subjects++;
              }

              if($student_marks->business_studies != null){
              $no_of_subjects++;
              }

              if($student_marks->geography != null){
              $no_of_subjects++;
              }

              if($student_marks->cre != null){
              $no_of_subjects++;
              }

              if($student_marks->agriculture != null){
              $no_of_subjects++;
              }

              if($student_marks->history != null){
              $no_of_subjects++;
              }
          }
      
  }

  $student_position_in_stream = 0;
  $student_position_in_class = 0;

  $class_standing = DB::table('student_marks_ranking')
                      ->where('year', $year)
                      ->where('term', $term)
                      ->where('exam_type', $exam_type)
                      ->where('class_name', $class_name)
                      ->orderby('average_marks', 'DESC')
                      ->get();

      foreach($class_standing as $position){
          if($position->student_id == $student_id){
              $student_position_in_stream++;
              break;
          } else{
              $student_position_in_stream++;
          }
      }
  

  $out_of_marks = $no_of_subjects * 100;

  $principals_comments = $this->getComments($average_marks);
  $class_teachers_comments = $this->getComments($average_marks);

  $overall_position = 0;
   $all_students_in_class = StudentMarksRanking::where(function ($query) use($year, $term, $exam_type, $stream1){
                                                            $query->where('class_name',  $stream1)
                                                                  ->where('year', $year)
                                                                  ->where('term', $term)
                                                                  ->where('exam_type', $exam_type);
                                                        })->orWhere(function($query) use($year, $term, $exam_type, $stream2){
                                                            $query->where('class_name', $stream2)
                                                                  ->where('year', $year)
                                                                  ->where('term', $term)
                                                                  ->where('exam_type', $exam_type);
                                                        })->count();

  $overall_position_ranking = StudentMarksRanking::where(function ($query) use($year, $term, $exam_type, $stream1){
                                                            $query->where('class_name',  $stream1)
                                                                  ->where('year', $year)
                                                                  ->where('term', $term)
                                                                  ->where('exam_type', $exam_type);
                                                        })->orWhere(function($query) use($year, $term, $exam_type, $stream2){
                                                            $query->where('class_name', $stream2)
                                                                  ->where('year', $year)
                                                                  ->where('term', $term)
                                                                  ->where('exam_type', $exam_type);
                                                        })->orderBy('average_marks', 'DESC')->get();
    
                   
  foreach($overall_position_ranking as $rank){
      if($rank->student_id == $student_id){
          $overall_position++;
          break;
      } else{
          $overall_position++;
      }
  }
     
 
  

  $output .='
      <tr>
      <td  style="border: 1px solid; padding: 5px;"> TOTAL MARKS </td>
      <td  style="border: 1px solid; padding: 5px;" colspan="5"> '.$total_marks_of_student.' /  '.$out_of_marks.' </td>
      </tr>

      <tr>
      <td  style="border: 1px solid; padding: 5px;"> AVERAGE MARKS </td>
      <td  style="border: 1px solid; padding: 5px;" colspan="5"> '.$average_marks.'     '.$average_grade.' </td>
      </tr>

      <tr>
      <td  style="border: 1px solid; padding: 5px;" colspan="4"> OVERALL POSITION ON MARKS : '.$overall_position.'    OUT OF '.$all_students_in_class.'   </td>
      <td  style="border: 1px solid; padding: 5px;" colspan="2"> CLASS POSITION :     '.$student_position_in_stream.' OUT OF '.$stream_students.' </td>
      </tr>
  ';

  $output .= ' </table>';

  $output .='
  <br>
  
  <ul style="list-style: none; margin: 0; padding: 0;">
      <li>
          <div style=" float: left;">
          <p style="text-decoration: underline;">Class Teacher\'s comments:</p>
          '.$class_teachers_comments.'
          </div>
      </li>
          <div style="float: right;">
          <p style="text-decoration: underline;">Principal\'s comments:</p>
          '.$principals_comments.'
          </div>
      <li>
      </li>

  </ul>
  
 

  ';
  return $output;

  }


  public function getComments($average_marks){

      if($average_marks >= 80){
          return 'Excellent. Keep up.';
      } else if($average_marks >= 70){
          return 'Very good work.';
      }
      else if($average_marks >= 60){
          return 'Good work. Next time aim higher.';
      } else if($average_marks >= 50){
          return 'Can do better than that. work harder';
      } else if($average_marks >= 40){
          return 'Poorly performed but can do better than that. Work harder next time';
      } else{
          return 'Very poor. Work on improving your performance';
      }
  }

  //function that gets the student subject position in class
   public function getSubjectPosition($year, $term, $exam_type, $stream1, $stream2, $subject, $student_id){
        //get kiswahili position
  $subject_position = 0;

  $all_positions = StudentMarksRanking::where(function ($query) use($year, $term, $exam_type, $stream1){
                                                            $query->where('class_name',  $stream1)
                                                                  ->where('year', $year)
                                                                  ->where('term', $term)
                                                                  ->where('exam_type', $exam_type);
                                                        })->orWhere(function($query) use($year, $term, $exam_type, $stream2){
                                                            $query->where('class_name', $stream2)
                                                                  ->where('year', $year)
                                                                  ->where('term', $term)
                                                                  ->where('exam_type', $exam_type);
                                                        })->whereNotNull($subject)->orderBy($subject, 'DESC')->get();
     
  foreach($all_positions as $sub){
      if($sub->student_id == $student_id){
          $subject_position++;
          break;
      } else{
          $subject_position++;
      }
  }

  return $subject_position;
     
   }
}
