<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\StudentMarksRanking;
use PDF;

class OlderMeritList extends Controller
{
    //

    public function showOlder(Request $request){

        $older_merit_lists = DB::table('student_marks_ranking')
                                ->select('year', 'term', 'exam_type', 'class_name')
                                ->distinct()
                                ->where('class_name', '1W')
                                ->orwhere('class_name', '2W')
                                ->orwhere('class_name', '3W')
                                ->orwhere('class_name', '4W')
                                ->get();

        return view('meritList.show_older', ['older_merit_lists'=>$older_merit_lists]);

    }
}
