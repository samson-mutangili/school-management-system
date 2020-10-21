<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class AlumniStudentsController extends Controller
{
    //
    public function getAlumniStudents(){

        //get the students details
        $alumni_students = Student::where('status', '');
    }
}
