<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import the  models
use App\Student;
use App\ParentModel;
use App\Address;
use File;

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

        //get the data from the form
        $first_name = $request->input('first_name');
        $middle_name = $request->input('middle_name');
        $last_name = $request->input('last_name');
        $admission_number = $request->input('admission_number');
        $gender = $request->input('gender');
        $date_of_birth = $request->input('date_of_birth');
        $religion = $request->input('religion');
        $kcpe_index_no = $request->input('kcpe_index_number');
        $residence = $request->input('residence');
        $student_class = $request->input('student_class');
        $nationality = $request->input('nationality');        
        $birth_cert_no = $request->input('birth_cert_no'); 

        $adm_no = $request->input('admission_number');


        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $imageName = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('images'), $imageName);



        //check if there a student with admission number
        $adm_conflict = Student::where('admission_number', $adm_no)->get();
        if(!$adm_conflict->isEmpty()){
            //set error message and return redirect
            $request->session()->flash('adm_conflict', 'There a student with the admission number '.$adm_no.'. Each student admission number should be unique');
            return view('add_student', [
                'first_name'=>$first_name,
                'middle_name'=>$middle_name,
                'last_name'=>$last_name,
                'admission_number'=>$admission_number,
                'gender'=>$gender,
                'date_of_birth'=>$date_of_birth,
                'religion'=>$religion,
                'kcpe_index_number'=>$kcpe_index_no,
                'residence'=>$residence,
                'student_class'=>$student_class,
                'nationality'=>$nationality,
                'birth_cert_no'=>$birth_cert_no
            ]);
        }

        //check if there a student with same birth certificate number
        $birth_cert_no_conflict = Student::where('birth_cert_no', $birth_cert_no)->get();
        if(!$birth_cert_no_conflict->isEmpty()){
            //set error message and return redirect
            $request->session()->flash('birth_cert_no_conflict', 'There a student with the birth certificate number '.$birth_cert_no.'. Each student birth certificate number should be unique');
            return view('add_student', [
                'first_name'=>$first_name,
                'middle_name'=>$middle_name,
                'last_name'=>$last_name,
                'admission_number'=>$admission_number,
                'gender'=>$gender,
                'date_of_birth'=>$date_of_birth,
                'religion'=>$religion,
                'kcpe_index_number'=>$kcpe_index_no,
                'residence'=>$residence,
                'student_class'=>$student_class,
                'nationality'=>$nationality,
                'birth_cert_no'=>$birth_cert_no
            ]);
        }


        //check if there a student with same kcpe index number
        $kcpe_index_no_conflict = Student::where('kcpe_index_no', $kcpe_index_no)->get();
        if(!$kcpe_index_no_conflict->isEmpty()){
            //set error message and return redirect
            $request->session()->flash('kcpe_index_no_conflict', 'There a student with the KCPE index number '.$kcpe_index_no.'. Each student KCPE number should be unique');
            return view('add_student', [
                'first_name'=>$first_name,
                'middle_name'=>$middle_name,
                'last_name'=>$last_name,
                'admission_number'=>$admission_number,
                'gender'=>$gender,
                'date_of_birth'=>$date_of_birth,
                'religion'=>$religion,
                'kcpe_index_number'=>$kcpe_index_no,
                'residence'=>$residence,
                'student_class'=>$student_class,
                'nationality'=>$nationality,
                'birth_cert_no'=>$birth_cert_no
            ]);
        }


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
        $student->profile_pic = $imageName;
        $student->save();

        //get the student id in the database
        $student = Student::where('admission_number', $request->input('admission_number'))->get();

        foreach($student as $stud){
            $student_id = $stud->id;
        }

        $year = date("Y");
        $real_class = $this->getRealClass($student_class);

        //insert the student class to db
        $insert_class = DB::table('student_classes')
                          ->insert([
                              'student_id'=>$student_id,
                              'year'=>$year,
                              'class_name'=>$real_class,
                              'stream'=>$student_class,
                              'trial'=>'1',
                              'status'=>'active'
                          ]);

        //set up the fee details

        //get the active term session
        $term_session = DB::table('term_sessions')
                          ->where('status', 'active')
                          ->get();

        if(!$term_session->isEmpty()){
            //get the year and the term details
            foreach($term_session as $active_time){
                $year = $active_time->year;
                $term = $active_time->term;
            }

            //get the fee structure for the student
            $fee_structure_details = DB::table('fee_structures')
                                        ->where('year', $year)
                                        ->where('term', $term)
                                        ->where('class', $real_class)
                                        ->get();

            if(!$fee_structure_details-isEmpty()){
                foreach($fee_structure_details as $fee_structure){
                    $fee = $fee_structure->fee;
                }

                //insert the total fees for the student
                $insert_fee = DB::table('fee_balances')
                                ->insert([
                                    'student_id'=>$student_id,
                                    'total_fees'=>$fee,
                                    'amount_paid'=>0,
                                    'balance'=>0,
                                    'overpay'=>0
                                ]);
            }
        }


        //get the student id in the database
        $student = Student::where('admission_number', $request->input('admission_number'))->get();


           return view('add_address', ['student'=>$student, 'class_name'=>$student_class]);

        
    }

    //function to add student address details
    public function addStudentAddress(Request $request){

        //get the student id
        $student_id = $request->input('student_id');
        $class_name = $request->input('class_name');

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
        return view('/add_parent', ['student_id'=>$student_id, 'class_name'=>$class_name]);


    }

    //function to insert parents details into the database
    public function addParent(Request $request){

        //get the student id 
        $student_id = $request->input('student_id');
        $class_name = $request->input('class_name');

        

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
                $request->session()->flash('student_added_successfully', 'Student details have been save successfully. The other students in the class '.$class_name.' are as below.');

                return redirect('students_details/'.$class_name);

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


    public function studentDetails($class_name){

        //get the class name
        $className = $class_name;

        //get the details from the database
        $students = DB::table('students')
                      ->join('student_classes', 'students.id', 'student_classes.student_id')
                      ->where('student_classes.stream', $className)
                      ->where('student_classes.status', 'active')
                      ->where('students.status', 'active')
                      ->get();

        return view('student_details', ['students'=>$students, 'className'=>$className]);
    }

    public function specificStudent($className, $studentID){

        $class_name = $className;
        $student_id = $studentID;

        //get the student details from the database
        $student_details = DB::table('students')
                             ->join('student_classes', 'students.id', 'student_classes.student_id')
                             ->where('students.id', $student_id)
                             ->where('student_classes.status', 'active')
                             ->get();

        $student_classes = DB::table('student_classes')
                              ->where('student_id', $student_id)
                              ->get();

        $student_address = DB::table('addresses')
                             ->join('student_address', 'addresses.id', 'student_address.address_id')
                             ->where('student_address.student_id', $student_id)
                             ->get();

        $student_parents = DB::table('parents')
                             ->join('student_parent', 'parents.id', 'student_parent.parent_id')
                             ->where('student_parent.student_id', $student_id)
                             ->get();
                             
        $student_result_slips = DB::table('student_marks_ranking')
                                  ->where('student_id', $student_id)
                                  ->get();

        $disciplinary_cases = DB::table('disciplinary_cases')
                                ->join('teachers', 'disciplinary_cases.teacher_id', 'teachers.id')
                                ->where('disciplinary_cases.student_id', $student_id)
                                ->get();
             
        return view('specific_student', [
            'student_details'=>$student_details,
            'student_classes'=>$student_classes,
            'student_address'=>$student_address,
            'student_parents'=>$student_parents,
            'student_result_slips'=>$student_result_slips,
            'student_disciplinary_cases'=>$disciplinary_cases
            ]);
    }



    //function that updates the student address details
    public function editAddress(Request $request){

        //get the details from the form 
        $address_id = $request->input('address_id');
        $postal_code = $request->input('postal_code');
        $postal_address = $request->input('postal_address');
        $street = $request->input('street');
        $town = $request->input('town');
        $country = $request->input('country');

        $student_id = $request->input('student_id');
        $class_name = $request->input('class_name');

        //check for empty fields
        if($address_id == "" || $address_id == null || $postal_code == "" || $postal_code == null || $postal_address == "" || $postal_address == null || $street == "" || $street == null || $town == "" || $town == null || $country == "" ||$country == null){
            $request->session()->flash('address_empty_fields','Address details not updated because some input fields were empty');
            return redirect("/studentDetails/".$class_name.",".$student_id);
        }

        if($postal_code <= 0){
            $request->session()->flash('postal_code_error', 'Address details not updated because zero or negative values are not accepted in postal code. You entered '.$postal_code);
            return redirect("/studentDetails/".$class_name.",".$student_id);
        } else if($postal_code > 1000000){
            $request->session()->flash('postal_code_error', 'Address details not updated because of too large value for postal code. You entered '.$postal_code);
            return redirect("/studentDetails/".$class_name.",".$student_id);
        }

        if($postal_address <= 0){
            $request->session()->flash('postal_address_error', 'Address details not updated because zero or negative values are not accepted in postal addrress. You entered '.$postal_address);
            return redirect("/studentDetails/".$class_name.",".$student_id);
        } else if($postal_address > 1000000){
            $request->session()->flash('postal_address_error', 'Address details not updated because the value of postal address is too large. You entered '.$postal_address);
            return redirect("/studentDetails/".$class_name.",".$student_id);
        }


        //update the address details
        $update_address = DB::table('addresses')
                            ->where('id', $address_id)
                            ->update([
                                'postal_code'=>$postal_code,
                                'postal_address'=>$postal_address,
                                'street'=>$street,
                                'town'=>$town,
                                'country'=>$country
                            ]);

        if($update_address == 1){
            $request->session()->flash('address_update_successful', 'Address details were updated successfully');
            return redirect("/studentDetails/".$class_name.",".$student_id); 
        } else{
            $request->session()->flash('address_update_failed', 'Address details not updated!! ');
            return redirect("/studentDetails/".$class_name.",".$student_id);
        }

        
        return redirect("/studentDetails/".$class_name.",".$student_id);



    }

    //function that edit the parents details
    public function editParentDetails(Request $request){

        //get the details from the form 
        $parent_id = $request->input('parent_id');
        $first_name = $request->input('first_name');
        $middle_name = $request->input('middle_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $id_no = $request->input('id_no');
        $phone_no = $request->input('phone_no');
        $occupation = $request->input('occupation');
        $gender = $request->input('gender');
        $relation = $request->input('relation');

        $student_id = $request->input('student_id');
        $class_name = $request->input('class_name');
        

        //check for empty fields
        if($first_name == "" || $first_name == null ||
           $middle_name == "" || $middle_name == null ||
           $last_name == "" || $last_name == null ||
           $email == "" || $email == null ||
           $id_no == "" || $id_no == null ||
           $phone_no == "" || $phone_no == null ||
           $occupation == "" || $occupation == null ||
           $gender == "" || $gender == null
        ){

            $request->session()->flash('parent_empty_fields', $relation.' details not updated because some input fields were empty');
            return redirect("/studentDetails/".$class_name.",".$student_id);
        }

        
        //update the fields
        $parent_update = DB::table('parents')
                           ->where('id', $parent_id)
                           ->update([
                                'first_name'=>$first_name,
                                'middle_name'=>$middle_name,
                                'last_name'=>$last_name,
                                'email'=>$email,
                                'id_no'=>$id_no,
                                'phone_no'=>$phone_no,
                                'occupation'=>$occupation,
                                'gender'=>$gender
                           ]);

        if($parent_update == 1){

            $request->session()->flash('parent_updated', $relation.' details have been updated successfully');
            return redirect("/studentDetails/".$class_name.",".$student_id);            
        } else{
            $request->session()->flash('parent_not_updated', $relation.' details have not been updated');
            return redirect("/studentDetails/".$class_name.",".$student_id);
        }
    }


    public function editStudent(Request $request, $id){

        //get the student id
        $student_id = $id;

        //get the student details from the db
        $student_details = DB::table('students')
                             ->join('student_classes', 'students.id', 'student_classes.student_id')
                             ->where('students.id', $student_id)
                             ->where('student_classes.status', 'active')
                             ->get();

        if(!$student_details->isEmpty()){

            //return to a view with the student details
            return view('/students.edit_student', ['student_details'=>$student_details]);

        } else{
            $request->session()->flash('no_student', 'No student with id as '.$student_id.'You can add a new student by filling in the form below!');
            return redirect('/add_student');
        }

    }

    //function for updating student info
    public function updateStudentInfo(Request $request){

        //get the data from the form 
        $class_stream = $request->input('stream');
        $student_id = $request->input('student_id');
        $first_name = $request->input('first_name');
        $middle_name = $request->input('middle_name');
        $last_name = $request->input('last_name');
        $admission_number = $request->input('admission_number');
        $gender = $request->input('gender');
        $date_of_birth = $request->input('date_of_birth');
        $birth_cert_no = $request->input('birth_cert_no');
        $kcpe_index_number = $request->input('kcpe_index_number');
        $place_of_residence = $request->input('residence');
        $religion = $request->input('religion');
        $nationality = $request->input('nationality');


        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        $imageName = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('images'), $imageName);


        //get the student details from the db
        $student_details = DB::table('students')
                             ->join('student_classes', 'students.id', 'student_classes.student_id')
                             ->where('students.id', $student_id)
                             ->where('student_classes.status', 'active')
                             ->get();

        //check for adm no. conflict
        $check_adm_no = DB::table('students')
                          ->where('status', 'active')
                          ->where('id', '!=', $student_id)
                          ->where('admission_number', $admission_number)
                          ->get();

        //check for birth certificate number conflict
        $check_birth_cert_no = DB::table('students')
                          ->where('status', 'active')
                          ->where('id', '!=', $student_id)
                          ->where('birth_cert_no', $birth_cert_no)
                          ->get();

        //check for birth kcpe index no conflict
        $check_kcpe_index_no = DB::table('students')
                          ->where('status', 'active')
                          ->where('id', '!=', $student_id)
                          ->where('kcpe_index_no', $kcpe_index_number)
                          ->get();

        if(!$check_adm_no->isEmpty()){
            $request->session()->flash('adm_no_conflict', 'There already another student with the admission number '.$admission_number. '. Each admission number should be unique!');
            if(!$student_details->isEmpty()){
                //return to a view with the student details
                return view('/students.edit_student', ['student_details'=>$student_details]);
    
            } else{
                $request->session()->flash('no_student', 'No student with id as '.$student_id.'You can add a new student by filling in the form below!');
                return redirect('/add_student');
            }
        }

        if(!$check_birth_cert_no->isEmpty()){
            $request->session()->flash('birth_cert_no_conflict', 'There already another student with the birth certificate number '.$birth_cert_no.'. Each birth certificate number should be unique!');
            if(!$student_details->isEmpty()){
                //return to a view with the student details
                return view('/students.edit_student', ['student_details'=>$student_details]);
    
            } else{
                $request->session()->flash('no_student', 'No student with id as '.$student_id.'You can add a new student by filling in the form below!');
                return redirect('/add_student');
            }
        }

        if(!$check_kcpe_index_no->isEmpty()){
            $request->session()->flash('kcpe_index_no_conflict', 'There already another student with the KCPE index number '.$kcpe_index_number.'. Each birth KCPE index number should be unique!');
            if(!$student_details->isEmpty()){
                //return to a view with the student details
                return view('/students.edit_student', ['student_details'=>$student_details]);
    
            } else{
                $request->session()->flash('no_student', 'No student with id as '.$student_id.'You can add a new student by filling in the form below!');
                return redirect('/add_student');
            }
        }

        $date = date('Y-m-d');
        $current_date = date_create_from_format('Y-m-d', $date);
        $DOB = date_create_from_format('Y-m-d', $date_of_birth);

        if($DOB > $current_date){
            $request->session()->flash('DOB_error', 'Date of birth error! The date of birth can not be in future. You entered '.$date_of_birth);
            if(!$student_details->isEmpty()){
                //return to a view with the student details
                return view('/students.edit_student', ['student_details'=>$student_details]);
    
            } else{
                $request->session()->flash('no_student', 'No student with id as '.$student_id.'You can add a new student by filling in the form below!');
                return redirect('/add_student');
            }
        }


        $student_years = date_diff($DOB, $current_date);
        $input_years  = round(($student_years->days/365), 0);
        
        if($input_years < 10){
            $request->session()->flash('student_too_young', 'According to date of birth, student is too young. Student should be at least 10 years old. Input for date of birth was '.$date_of_birth.' which translates to '.$input_years.' years old');
            if(!$student_details->isEmpty()){
                //return to a view with the student details
                return view('/students.edit_student', ['student_details'=>$student_details]);
    
            } else{
                $request->session()->flash('no_student', 'No student with id as '.$student_id.'You can add a new student by filling in the form below!');
                return redirect('/add_student');
            }
        }


        //delete the existing photo
        if($request->hasfile('image')){
            
        $student_pic = Student::where('id', $student_id)->get();

        if(!$student_pic->isEmpty()){
            foreach($student_pic as $user){
                    //delete image

                     if(file_exists(public_path("images/".$user->profile_pic))){
                         //the line below deletes the picture using old php, 
                       // unlink(public_path("images/".$user->teacher_profile_pic));
                             File::delete("images/".$user->profile_pic);
                    };

                    
            }
                
        }
     }

        //update the student details
        $update_student = DB::table('students')
                            ->where('id', $student_id)
                            ->update([
                                'first_name'=>$first_name,
                                'middle_name'=>$middle_name,
                                'last_name'=>$last_name,
                                'admission_number'=>$admission_number,
                                'gender'=>$gender,
                                'DOB'=>$date_of_birth,
                                'birth_cert_no'=>$birth_cert_no,
                                'religion'=>$religion,
                                'kcpe_index_no'=>$kcpe_index_number,
                                'residence'=>$place_of_residence,
                                'nationality'=>$nationality,
                                'profile_pic'=>$imageName
                            ]);


        if($update_student == 1){
            //successful update
            $request->session()->flash('student_update_successful', 'Student details have been updated succesfully');
            return redirect('/studentDetails/'.$class_stream.','.$student_id);
        } else{
            //update failed
            $request->session()->flash('student_update_failed', 'Failed to update student details! Please contact the admin for more information!');
            return redirect('/studentDetails/'.$class_stream.','.$student_id);
        }
    }


    //function for clearing student
    public function studentClearance(Request $request){

        //get the details from the form
        $student_id = $request->input('student_id');
        $class_name = $request->input('class_name');

        $current_date = date('Y-m-d');

        //check if student has uncleared disciplinary classes
        $uncleared_cases = DB::table('disciplinary_cases')
                             ->where('student_id', $student_id)
                             ->where('case_status', 'uncleared')
                             ->get();
        if(!$uncleared_cases->isEmpty()){
            $request->session()->flash('uncleared_cases', 'The student has uncleared disciplinary cases. The student should first clear them at deputy principal office!');
            return redirect('studentDetails/'.$class_name.','.$student_id);
        }

        //update student_details
        $update_student = DB::table('students')
                            ->where('id', $student_id)
                            ->update([
                                'status'=>'cleared',
                                'date_left'=>$current_date
                            ]);
        
       

        if($update_student == 1){
            //update the student classes
            $class_updates = DB::table('student_classes')
                            ->where('student_id', $student_id)
                            ->update([
                                    'status'=>'completed'
                            ]);
            //set success messages
            $request->session()->flash('student_cleared_successfully', '1 student has been cleared successfully');
            return redirect('students_details/'.$class_name);

        } else{
            //set error messages
            $request->session()->flash('student_clearance_failed', 'Failed to clear student! Please contact admin for more details');
            return redirect('students_details/'.$class_name);

        }
    }
    

    //function for getting the class
    public function getRealClass($student_class){

        $real_class;

        if($student_class == '1E' || $student_class == '1W'){
            $real_class = "Form 1";
        } else if($student_class == '2E' || $student_class == '2W'){
            $real_class = "Form 2";
        }
        else if($student_class == '3E' || $student_class == '3W'){
            $real_class = "Form 3";
        }
        else if($student_class == '4E' || $student_class == '4W'){
            $real_class = "Form 4";
        } else{
            $real_class = "Form 1";
        }

        return $real_class;
    }
}
