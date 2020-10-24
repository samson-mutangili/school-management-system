<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //

    public function toAdmin(Request $request){

        //get total number of students
        $active_students = DB::table('students')
                             ->where('status', 'active')
                             ->count();

        $alumni_students = DB::table('students')
                              ->where('status', 'cleared')
                              ->count();
        
        $teachers = DB::table('teachers')
                      ->where('status', 'active')
                      ->count();

        $non_teaching_staff = DB::table('non_teaching_staff')
                                ->where('status', 'active')
                                ->count();

        return view('dashboards.admin_dashboard', [
            'active_students'=>$active_students,
            'teachers'=>$teachers,
            'non_teaching_staff'=>$non_teaching_staff,
            'alumni_students'=>$alumni_students
        ]);
    }


    public function toNormalTeacher(Request $request){

        //get teacher id
        $teacher_id = $request->session()->get('teacher_id');

        $teacher_classes = DB::table('teacher_classes')
                             ->where('teacher_id', $teacher_id)
                             ->get();
        $teaching_classes = 0;
        if(!$teacher_classes->isEmpty()){
            foreach($teacher_classes as $class){
                if($class->subject1 != null){
                    $teaching_classes++;
                }
                if($class->subject2 != null){
                    $teaching_classes++;
                }
            }
        }

        $roles  = 0;
        $responsibilities = 0;

        $Responsibility = DB::table('roles_and_responsibilities')
                            ->where('teacher_id', $teacher_id)
                            ->get();


        if(!$Responsibility->isEmpty()){
            foreach($Responsibility as $res){
                if($res->special_role != null){
                    $roles++;
                }
                if($res->responsibility != null){
                    $responsibilities++;
                }
            }
        }

        
        return view('dashboards.teacherDashboard', [
            'teaching_classes'=>$teaching_classes,
            'roles'=>$roles,
            'responsibilities'=>$responsibilities
        ]);
    }
}
