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
}
