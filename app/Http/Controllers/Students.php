<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import the  models
use App\Student;
use App\ParentModel;
use App\Address;

use Illuminate\Support\Facades\DB;

class Students extends Controller
{

    //function to insert new student to the db
    public function insertStudent(Request $request){

        //create a new model of student
        $student = new Student;

        //Query to insert student data to the database
        $student->first_name = $request->input('first_name');
        $student->middle_name = $request->input('middle_name');
        $student->last_name = $request->input('last_name');
        $student->admission_number = $request->input('admission_number');
        $student->date_of_admission = $request->input('date_of_admission');
        $student->gender = $request->input('gender');
        $student->DOB = $request->input('DOB');
        $student->birth_cert_no = $request->input('birth_cert_no');
        $student->religion = $request->input('religion');
        $student->kcpe_index_no = $request->input('kcpe_index_no');
        $student->residence = $request->input('residence');
        $student->class = $request->input('class');
        $student->save();

        //make a model of parent
        $father = new ParentModel;
                
        //query to insert father details to the database
        $father->first_name = $request->input('father_first_name');
        $father->middle_name = $request->input('father_middle_name');
        $father->last_name = $request->input('father_middle_name');
        $father->phone_no = $request->input('father_phone_no');
        $father->email = $request->input('father_email');
        $father->id_no = $request->input('father_id_no');
        $father->gender = $request->input('father_gender');
        $father->relation = $request->input('father_relation');
        $father->occupation = $request->input('father_occupation');
        $father->save();

        //make a model for the mother details
        $mother = new Parent;

        //query to insert mother details to the database
        $mother->first_name = $request->input('mother_first_name');
        $mother->middle_name = $request->input('mother_middle_name');
        $mother->last_name = $request->input('mother_last_name');
        $mother->phone_no = $request->input('mother_phone_no');
        $mother->email = $request->input('mother_email');
        $mother->id_no = $request->input('mother_id_no');
        $mother->gender = $request->input('mother_gender');
        $mother->relation = $request->input('mother_relation');
        $mother->occupation = $request->input('mother_occupation');
        $mother->save();

        //make a model for the guardian
        $guardian = new Parent;

        //query to insert guardians details to the database
        $guardian->first_name = $request->input('guardian_first_name');
        $guardian->middle_name = $request->input('guardian last_name');
        $guardian->last_name = $request->input('guardian last_name');
        $guardian->phone_no = $request->input('guardian phone_no');
        $guardian->email = $request->input('guardian email');
        $guardian->id_no = $request->input('guardian id_no');
        $guardian->gender = $request->input('guardian gender');
        $guardian->relation = $request->input('guardian relation');
        $guardian->occupation = $request->input('guardian occupation');
        $guardian->save();

        //make a new model for the address
        $address = new Address;
        
        //query to insert address details to the database
        $address->postal_code = $request->input('postal_code');
        $address->postal_address = $request->input('postal_address');
        $address->street = $request->input('street');
        $address->town = $request->input('town');
        $address->country = $request->input('country');
        
    }

    public function updateStudent(Request $request){

        //get the student id in the database
        $student_id = $request->input('id');

        $student = DB::table('students')
                   ->where('id', $student_id)
                   ->update([
                       'first_name'=>$request->input('first_name'),
                       'middle_name' => $request->input('middle_name'),
                       'last_name' => $request->input('middle_name'),
                       'admission_number' => $request->input('admission_number'),
                       'date_of_admission' => $request->input('date_of_admission'),
                       'gender' => $request->input('gender'),
                       'DOB' => $request->input('DOB'),
                       'birth_cert_no' => $request->input('birth_cert_no'),
                       'religion' => $request->input('religion'),
                       'kcpe_index_no' => $request->input('kcpe_index_no'),
                       'residence' => $request->input('residence'),
                       'class' => $request->input('class'),
                   ]);

    }


}
