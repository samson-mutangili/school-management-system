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

        //get the system date as the date of admission
        $date_of_admission = date("Y-m-d");

        $year_of_study;
        //get the student class so as to know the year of study
        $student_class = $request->input('student_class');

        if($student_class != null){
            if($student_class == "1E" || $student_class == "1W"){
                $year_of_study = 1;
            } else if($student_class == "2E" || $student_class == "2W"){
                $year_of_study = 2;
            } else if($student_class == "3E" || $student_class == "3W"){
                $year_of_study = 3;
            } else if($student_class == "4E" || $student_class == "4W"){
                $year_of_study = 4;
            } else{

            }
        }

        //create a new model of student
        $student = new Student;

        //Query to insert student data to the database
        $student->first_name = $request->input('first_name');
        $student->middle_name = $request->input('middle_name');
        $student->last_name = $request->input('last_name');
        $student->admission_number = $request->input('admission_number');
        $student->date_of_admission = $date_of_admission;
        $student->gender = $request->input('gender');
        $student->DOB = $request->input('date_of_birth');
        $student->birth_cert_no = $request->input('birth_cert_no');
        $student->religion = $request->input('religion');
        $student->kcpe_index_no = $request->input('kcpe_index_number');
        $student->residence = $request->input('residence');
        $student->class = $request->input('student_class');
        $student->nationality = $request->input('nationality');
        $student->year_of_study = $year_of_study;
        $student->save();

        //get the student id in the database
        $student = Student::where('admission_number', $request->input('admission_number'))->get();


           return view('add_address', ['student'=>$student]);

        
    }

    //function to add student address details
    public function addStudentAddress(Request $request){

        //get the student id
        $student_id = $request->input('student_id');

        //make a new model for the address
        $address = new Address;
        
        //query to insert address details to the database
        $address->postal_code = $request->input('postal_code');
        $address->postal_address = $request->input('postal_address');
        $address->street = $request->input('street');
        $address->town = $request->input('town');
        $address->country = $request->input('country');
        $address->save();

        //get the address id in the database
        $address_details = Address::where('postal_code', $request->input('postal_code'))
                                ->where('postal_address', $request->input('postal_address'))
                                ->where('street', $request->input('street'))
                                ->where('town', $request->input('town'))
                                ->get();
        

        //get the id of the address
        $address_id;
        foreach($address_details as $address){
            $address_id = $address->id;
        }
        //insert the student id and address id into the student_address table
        $student_address = DB::table('student_address')
                             ->insert([
                                'student_id'=>$student_id,
                                'address_id' => $address_id
                             ]);
        
        //return to parents view with the student id
        return view('/add_parent', ['student_id'=>$student_id]);


    }

    //function to insert parents details into the database
    public function addParent(Request $request){

        //get the student id 
        $student_id = $request->input('student_id');

        

        if( $request->input('father_first_name') != null || $request->input('father_first_name') != ""){
        
            //make a model of parent
            $father = new ParentModel;

            //query to insert father details to the database
            $father->first_name = $request->input('father_first_name');
            $father->middle_name = $request->input('father_middle_name');
            $father->last_name = $request->input('father_middle_name');
            $father->phone_no = $request->input('father_phone_no');
            $father->email = $request->input('father_email');
            $father->id_no = $request->input('father_id_no');
            $father->gender = 'male';
            $father->relation = 'father';
            $father->occupation = $request->input('father_occupation');
            $father->save();

            //get the father id from the database
            $father_details = ParentModel::where('id_no', $request->input('father_id_no'))->get();

            $father_id;
            foreach($father_details as $fatherDetail){
                $father_id = $fatherDetail->id;
            }
            //insert to the corresponding column of student parent details
            $student_father = DB::table('student_parent')
                                ->insert([
                                    'student_id' => $student_id,
                                    'parent_id' => $father_id
                                ]);
            }

            //if the mother details exists, insert into the database
            if( $request->input('mother_first_name') != null || $request->input('mother_first_name') != ""){
        
                //make a model for the mother details
                $mother = new ParentModel;

                //query to insert mother details to the database
                $mother->first_name = $request->input('mother_first_name');
                $mother->middle_name = $request->input('mother_middle_name');
                $mother->last_name = $request->input('mother_last_name');
                $mother->phone_no = $request->input('mother_phone_no');
                $mother->email = $request->input('mother_email');
                $mother->id_no = $request->input('mother_id_no');
                $mother->gender = 'female';
                $mother->relation = 'mother';
                $mother->occupation = $request->input('mother_occupation');
                $mother->save();
    
                //get the father id from the database
                $mother_details = ParentModel::where('id_no', $request->input('mother_id_no'))->get();
                
                $mother_id;
                foreach($mother_details as $motherDetail){
                    $mother_id = $motherDetail->id;
                }
                //insert to the corresponding column of student parent details
                $student_mother = DB::table('student_parent')
                                    ->insert([
                                        'student_id' => $student_id,
                                        'parent_id' => $mother_id
                                    ]);
                }


                //if the guardian details exists, insert into the database
            if( $request->input('guardian_first_name') != null || $request->input('guardian_first_name') != ""){
        
                //make a model for the guardian
                $guardian = new ParentModel;

                //query to insert guardians details to the database
                $guardian->first_name = $request->input('guardian_first_name');
                $guardian->middle_name = $request->input('guardian_last_name');
                $guardian->last_name = $request->input('guardian_last_name');
                $guardian->phone_no = $request->input('guardian_phone_no');
                $guardian->email = $request->input('guardian_email');
                $guardian->id_no = $request->input('guardian_id_no');
                $guardian->gender = $request->input('guardian_gender');
                $guardian->relation = 'guardian';
                $guardian->occupation = $request->input('guardian_occupation');
                $guardian->save();
    
                //get the father id from the database
                $guardian_details = ParentModel::where('id_no', $request->input('guardian_id_no'))->get();
                
                $guardian_id;
                foreach($guardian_details as $guardianDetail){
                    $guardian_id = $guardianDetail->id;
                }

                //insert to the corresponding column of student parent details
                $student_guardian = DB::table('student_parent')
                                    ->insert([
                                        'student_id' => $student_id,
                                        'parent_id' => $guardian_id
                                    ]);
                }

                

                //set a message in a flash session
                $request->session()->flash('student_added_successfully', 'Student details have been save successfully');

                echo "student details have been saved successfully";
                
        

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
