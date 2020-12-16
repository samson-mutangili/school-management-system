<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import the  models
use App\Student;
use App\ParentModel;
use App\Address;
use File;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Facades\DB;

class Students extends Controller 
{

    public function addStudentForm(Request $request){


        //get the maximum admission number

        $max_adm_no = DB::table('students')
                        ->max('admission_number');

        $new_adm_no = $max_adm_no + 1;

        return view('add_student', ['admission_number'=>$new_adm_no]);

    }

    


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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
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

            if(!$fee_structure_details->isEmpty()){
                foreach($fee_structure_details as $fee_structure){
                    $fee = $fee_structure->fee;
                }

                //insert the total fees for the student
                $insert_fee = DB::table('fee_balances')
                                ->insert([
                                    'student_id'=>$student_id,
                                    'total_fees'=>$fee,
                                    'amount_paid'=>0,
                                    'balance'=>$fee,
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

        $request->session()->flash('add_parent', 'Student personal details have been saved successfully. You can add a new parent or search and assign an existing 
        parent to the student.');
        
       return redirect('/students/parents');


    }

  

    public function updateStudent(Request $request){

        //get the student id in the database
        $student_id = $request->input('id');
        $stream = $request->input('stream');

        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        if($request->hasfile('image')){
            $imageName = time().'.'.$request->image->extension();  
   
            $request->image->move(public_path('images'), $imageName);

        }

        if($request->hasfile('image')){
            //get teacher 
        $student = DB::table('students')->where('id', $student_id)->get();

        if(!$student->isEmpty()){
            foreach($student as $user){
                    //delete image

                     if(file_exists(public_path("images/".$user->profile_pic))){
                         //the line below deletes the picture using old php, 
                       // unlink(public_path("images/".$user->teacher_profile_pic));
                             File::delete("images/".$user->profile_pic);
                    };

                    
            }
                
        }
         //update teacher info
    $student_update = DB::table('students')
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
                       'profile_pic'=>$imageName
                   ]);

     } else{
             //update teacher info
    $student_update = DB::table('students')
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
                       'residence' => $request->input('residence')
                   ]);
     }


     if($student_update == 1){
         $request->session()->flash('student_updated_successfully', 'Student details have been updated successfully');
        return redirect('/studentDetails/'.$stream, $student_id);
     } else{
        $request->session()->flash('student_not_updated', 'Failed to update student details');
        return redirect('/studentDetails/'.$stream, $student_id);
     }

        

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

        //check for confilict of id no, and email
        $email_conflict = DB::table('parents')->where('email', $email)->where('id', '!=', $parent_id)->get();
        if(!$email_conflict->isEmpty()){
            $request->session()->flash('edit_email_conflict2', 'There is another parent with the email '.$email);
            return redirect("/studentDetails/".$class_name.",".$student_id);
        }

        //check for confilict of id no, and email
        $id_no_conflict = DB::table('parents')->where('id_no', $id_no)->where('id', '!=', $parent_id)->get();
        if(!$id_no_conflict->isEmpty()){
            $request->session()->flash('edit_id_no_conflict2', 'There is another parent with the ID No.  '.$id_no);
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
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
  
        if($request->hasfile('image')){
            $imageName = time().'.'.$request->image->extension();  
   
            $request->image->move(public_path('images'), $imageName);

        }
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

        //check for kcpe index no conflict
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


        if($request->hasfile('image')){
            //get teacher 
        $student = DB::table('students')->where('id', $student_id)->get();

        if(!$student->isEmpty()){
            foreach($student as $user){
                    //delete image

                     if(file_exists(public_path("images/".$user->profile_pic))){
                         //the line below deletes the picture using old php, 
                       // unlink(public_path("images/".$user->teacher_profile_pic));
                             File::delete("images/".$user->profile_pic);
                    };

                    
            }
                
        }
         //update teacher info
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

     } else{
             //update teacher info
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
                    'nationality'=>$nationality
                   ]);
     }


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
        $out_of_session = $request->input('out_of_session');

        $current_date = date('Y-m-d');

        //check if student has uncleared disciplinary classes
        $uncleared_cases = DB::table('disciplinary_cases')
                             ->where('student_id', $student_id)
                             ->where('case_status', 'uncleared')
                             ->get();
        if(!$uncleared_cases->isEmpty()){
            $request->session()->flash('uncleared_cases', 'The student has uncleared disciplinary cases. The student should first clear them at deputy principal office!');
            
            if($out_of_session != "" || $out_of_session != null){
                return redirect('/students/Outofsession/'.$student_id);
            } else{

            return redirect('studentDetails/'.$class_name.','.$student_id);
            }
        }

        $room_allocated = DB::table('student_dorm_rooms')
                            ->where('student_id', $student_id)
                            ->where('allocation_status', 'active')
                            ->get();

        if(!$room_allocated->isEmpty()){
            $request->session()->flash('uncleared_cases', 'The student is still allocated a need at the accommodation facility! The room student needs to be disallocated from the room! please contact the person in charge of boarding!');
            
            if($out_of_session != "" || $out_of_session != null){
                return redirect('/students/Outofsession/'.$student_id);
            } else{
            return redirect('studentDetails/'.$class_name.','.$student_id);
            }
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
            
            if($out_of_session != "" || $out_of_session != null){
                return redirect('/students/Outofsession');
            } else{
             return redirect('students_details/'.$class_name);
            }

        } else{
            //set error messages
            $request->session()->flash('student_clearance_failed', 'Failed to clear student! Please contact admin for more details');
            
            if($out_of_session != "" || $out_of_session != null){
                return redirect('/students/Outofsession/'.$student_id);
            } else{
            return redirect('students_details/'.$class_name);
            }

        }
    }
    

    //function for adding student to out of session
    public function outOfSession(Request $request){

        //get the details from the dorm
        $student_id = $request->input('student_id');
        $class_name = $request->input('class_name');

        $current_date = date("Y-m-d");

        //first check if student is in session
        $room_allocated = DB::table('student_dorm_rooms')
                            ->where('student_id', $student_id)
                            ->where('status', 'active')
                            ->get();

        if(!$room_allocated->isEmpty()){
            $request->session()->flash('uncleared_cases', 'The student is still allocated a need at the accommodation facility! The room student needs to be disallocated from the room! please contact the person in charge of boarding!');
            return redirect('/students_details/'.$class_name);
    
        }

        //update student details
        $update_student = DB::table('students')
                            ->where('id', $student_id)
                            ->update([
                                'status'=>'out of session'
                            ]);

        //update the student class
        $update_class = DB::table('student_classes')
                          ->where('student_id', $student_id)
                          ->where('stream', $class_name)
                          ->update([
                              'status'=>'past'
                          ]);

        if($update_student == 1){



            //set message in flash session
            $request->session()->flash('status_updated_successfully', 'One student has been moved to out of session!');
            
            //insert student details in OutOfSession DB
            $insert_out_of_session = DB::table('out_of_sessions')
                                        ->insert([
                                            'student_id'=>$student_id,
                                            'date_from'=>$current_date,
                                            'session_status'=>'out',
                                            'created_at'=>now(),
                                            'updated_at'=>now()
                                        ]);
            
        } else{
            $request->session()->flash('status_update_failed', 'Failed to remove student out of session');
        }

        return redirect('/students_details/'.$class_name);
    }


    //function to show all students out of session
    public function showStudentsOutOfSession(){

        //get all the students out of session
        $all_students_out_of_session = DB::table('students')
                                         ->join('out_of_sessions', 'students.id', 'out_of_sessions.student_id')
                                         ->where('students.status', 'out of session')
                                         ->where('out_of_sessions.date_to', null)
                                         ->where('out_of_sessions.session_status', 'out')
                                         ->get();

    
        return view('OutOfSession.all_out_of_session', ['students'=>$all_students_out_of_session]);
                                     
    }

    //function to show specific student out of session
    public function specific_student_out_of_session($student_id){
        
        $student_id = $student_id;

        //get the student details from the database
        $student_details =  DB::table('students')
                                         ->join('out_of_sessions', 'students.id', 'out_of_sessions.student_id')
                                         ->where('students.status', 'out of session')
                                         ->where('out_of_sessions.date_to', null)
                                         ->where('out_of_sessions.session_status', 'out')
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
             
        return view('OutOfSession.specific_student_out_of_session', [
            'student_details'=>$student_details,
            'student_classes'=>$student_classes,
            'student_address'=>$student_address,
            'student_parents'=>$student_parents,
            'student_result_slips'=>$student_result_slips,
            'student_disciplinary_cases'=>$disciplinary_cases
            ]);
    }


    //function for returning student back to session
    public function resumeStudentToSession(Request $request){

        //get the details from the form
        $student_id = $request->input('student_id');
        $year = $request->input('year');
        $trial = $request->input('trial');
        $next_class = $request->input('next_class');
        $class_stream = $request->input('class_stream');

        //check if the student is has been through the class before
        $class_collide = DB::table('student_classes')
                           ->where('class_name', $next_class)
                           ->where('trial', $trial)
                           ->where('student_id', $student_id)
                           ->get();

        if(!$class_collide->isEmpty()){
             //set error message in a flash session
             $request->session()->flash('same_class', 'Student not assigned the class. Please check the trial period to 2 if the student has to repeat '.$next_class. ' class');
             return redirect('/students/Outofsession/'.$student_id);
        }

        //update the student class
        $assign_new_class = DB::table('student_classes')
                              ->insert([
                                  'student_id'=>$student_id,
                                  'year'=>$year,
                                  'class_name'=>$next_class,
                                  'stream'=>$class_stream,
                                  'trial'=>$trial,
                                  'status'=>'active',
                                  'created_at'=>now(),
                                  'updated_at'=>now()
                              ]);

        if($assign_new_class == 1){

            //update student status
            $update_student_status = DB::table('students')
                                        ->where('id', $student_id)
                                        ->update([
                                            'status'=>'active'
                                        ]);

            //remove the student from outOfSession table
            $update_out_of_session = DB::table('out_of_sessions')
                                        ->where('student_id', $student_id)
                                        ->update([
                                            'date_to'=>date("Y-m-d"),
                                            'session_status'=>'in',
                                            'updated_at'=>now()
                                        ]);

            //set success message
            $request->session()->flash('student_resumed', 'One student has resumed back to session and assigned Form '.$class_stream.'Find the student details here');
            return redirect('/studentDetails/'.$class_stream.','.$student_id);
        } else{
            //set success message
            $request->session()->flash('failed_to_resume', 'Failed to reassign the student a class in order to get back to session');
            return redirect('/students/Outofsession/'.$student_id);
        }

    }


    //promote all students to next class
    public function promoteAll(Request $request){

        //get the details from the form
        $completed = $request->input('completed');
        $next_class = $request->input('next_class');
        $real_class = $request->input('real_class');
        $students_year = $request->input('students_year');
        $previous_class = $request->input('previous_class');

        if($completed == "no"){

            //promote student to next class
            $year = date("Y");

            $all_students = DB::table('student_classes')
                             ->where('year', $students_year)
                             ->where('stream', $previous_class)
                             ->where('status', 'active')
                             ->get();

            if(!$all_students->isEmpty()){

                foreach($all_students as $student){

                    //mark the previous class as completed
                    $update_student_classes = DB::table('student_classes')
                                                ->where('student_id', $student->student_id)
                                                ->where('year', $students_year)
                                                ->where('stream', $previous_class)
                                                ->where('status', 'active')
                                                ->update([
                                                    'status'=>'completed'
                                                ]);
                    //insert a new class for the student

                    $insert_new_class = DB::table('student_classes')
                                         ->insert([
                                            'student_id'=>$student->student_id,
                                            'year'=>$year,
                                            'class_name'=>$real_class,
                                            'stream'=>$next_class,
                                            'trial'=>1,
                                            'status'=>'active',
                                            'created_at'=>now(),
                                            'updated_at'=>now()
                                         ]);
                }

                //set message in flash session
                $request->session()->flash('update_successful', 'Students who joined Form '.$previous_class. 'in '.$students_year.' have been promoted to Form '.$next_class);
                return redirect('/students_details/'.$previous_class);

            } else{

                //set message in flash session
                $request->session()->flash('update_failed', 'No student who joined Form ' .$previous_class. ' in the year '.$students_year);
                return redirect('/students_details/'.$previous_class);
            }


        } elseif($completed == "yeah"){

            //update all student classes to completed
            $students = DB::table('student_classes')
                                ->join('students', 'student_classes.student_id', 'students.id')
                                ->where('student_classes.year', $students_year)
                                ->where('student_classes.stream', $previous_class)
                                ->where('student_classes.status', 'active')
                                ->where('students.status', 'active')
                                ->get();

            if(!$students->isEmpty()){
                foreach($students as $student){
                    $update_details = DB::table('students')
                                        ->where('id', $student->id)
                                        ->update([
                                            'status'=>'completed'
                                        ]);

                    $update_student_classes = DB::table('student_classes')
                                                ->where('student_id', $student->id)
                                                ->where('year', $students_year)
                                                ->where('stream', $previous_class)
                                                ->where('status', 'active')
                                                ->update([
                                                    'status'=>'past'
                                                ]);
                }
        
                //set message in flash session
                $request->session()->flash('update_successful', 'Students have been marked as have completed school. Students details can be found under alumni students category.');
                return redirect('/students_details/'.$previous_class);
            } else{
                //set message in flash session
                $request->session()->flash('update_failed', 'No student who joined Form '.$previous_class. ' in the year '.$students_year);
                return redirect('/students_details/'.$previous_class);
            }
        }
    }

    //get all the students
    public function showAllStudents(){

        $students = DB::table('students')->get();

        return view('students.all_students', ['students'=>$students, 'message'=>"", 'parents_included'=>"no", 'class_name'=>"", 'streams'=>""]);
    }


    //filter students
    public function filterStudents(Request $request){

        $message = "";
        //get the details from the form
        $class_name = $request->input('class_name');
        $streams = $request->input('streams');
        $include_parents = $request->input('include_parents');

        if($class_name=="" && $streams=="" && $include_parents == ""){
                $students = DB::table('students')->get();
              

                return view('students.all_students', ['students'=>$students, 'message'=>"", 'parents_included'=>"no", 'class_name'=>"", 'streams'=>""]);
        }

        //parents not included
        if($include_parents == ""){
            //check for streams
            if($streams == "all"){
                $class_streams = $this->getStreams($class_name);
                $stream1 = $class_streams[0];
                $stream2 = $class_streams[1];

                $message = "List of students in class: ".$class_name;

                $students = DB::table('students')
                                ->join('student_classes', 'students.id', 'student_classes.student_id')
                                ->where(function ($query) use($stream1){
                                                            $query->where('student_classes.stream',  $stream1)
                                                                ->where('student_classes.status', 'active');
                                                        })->orWhere(function($query) use($stream2){
                                                            $query->where('student_classes.stream',  $stream2)
                                                                ->where('student_classes.status', 'active');
                                                        })->where('students.status', 'active')->get();

                        
               return view('students.all_students', ['students'=>$students, 'message'=>$message, 'parents_included'=>"no", 'class_name'=>$class_name, 'streams'=>$streams]);
             
            } else{
                $message = "List of students in Form ".$streams;
                $students = DB::table('students')
                                ->join('student_classes', 'students.id', 'student_classes.student_id')
                                ->where('student_classes.stream', $streams)
                                ->where('student_classes.status', 'active')
                                ->get();

            return view('students.all_students', ['students'=>$students, 'message'=>$message, 'parents_included'=>"no", 'all_streams'=>"no", 'class_name'=>$class_name, 'streams'=>$streams]);

            }

            
        } else{

            //parents details are included
             //check for streams
             if($streams == "all"){
                $class_streams = $this->getStreams($class_name);
                $stream1 = $class_streams[0];
                $stream2 = $class_streams[1];

                $message = "List of students in class: ".$class_name;

                $students = DB::table('students')
                                ->join('student_classes', 'students.id', 'student_classes.student_id')
                                ->where(function ($query) use($stream1){
                                                            $query->where('student_classes.stream',  $stream1)
                                                                ->where('student_classes.status', 'active');
                                                        })->orWhere(function($query) use($stream2){
                                                            $query->where('student_classes.stream',  $stream2)
                                                                ->where('student_classes.status', 'active');
                                                        })->where('students.status', 'active')->get();

                        
               return view('students.all_students', ['students'=>$students, 'message'=>$message, 'parents_included'=>"yes", 'all_streams'=>"yes", 'class_name'=>$class_name, 'streams'=>$streams]);
             
            } else{
                $message = "List of students in Form ".$streams;
                $students = DB::table('students')
                                ->join('student_classes', 'students.id', 'student_classes.student_id')
                                ->where('student_classes.stream', $streams)
                                ->where('student_classes.status', 'active')
                                ->get();

            return view('students.all_students', ['students'=>$students, 'message'=>$message, 'parents_included'=>"yes", 'all_streams'=>"no", 'class_name'=>$class_name, 'streams'=>$streams]);

            }


        }

    }


    //function for printing list of students
    public function downloadStudentList($class_name, $streams, $parents_included){
      
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->downloadStudentListPDF($class_name, $streams, $parents_included));
        // if($parents_included == "yes"){
        //     $pdf->setPaper('A4', 'landscape');
        // }
        return $pdf->stream();
    }

    public function downloadStudentListPDF($class_name, $streams, $parents_included){
        $students;

            //check for streams
            if($streams == "all"){
                $class_streams = $this->getStreams($class_name);
                $stream1 = $class_streams[0];
                $stream2 = $class_streams[1];

               
                $students = DB::table('students')
                                ->join('student_classes', 'students.id', 'student_classes.student_id')
                                ->where(function ($query) use($stream1){
                                                            $query->where('student_classes.stream',  $stream1)
                                                                ->where('student_classes.status', 'active');
                                                        })->orWhere(function($query) use($stream2){
                                                            $query->where('student_classes.stream',  $stream2)
                                                                ->where('student_classes.status', 'active');
                                                        })->where('students.status', 'active')
                                                        ->orderBy('admission_number', 'ASC')
                                                        ->get();

                        
             
            } else{
               
                $students = DB::table('students')
                                ->join('student_classes', 'students.id', 'student_classes.student_id')
                                ->where('student_classes.stream', $streams)
                                ->where('student_classes.status', 'active')
                                ->orderBy('admission_number', 'ASC')
                                ->get();


            }


            $output = "";
            if($parents_included == "no"){
                $output = $this->getListWithoutParents($students, $class_name, $streams);
            } elseif($parents_included == "yes"){
                $output = $this->getListWithParents($students, $class_name, $streams);
            }

            return $output;

    }

    public function getListWithoutParents($students, $class_name, $streams){

        if($students->isEmpty()){
            return "No students";
        }

        //get the system date
        $date = date('d-m-Y');
        $i = 1;

        $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg" alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>';
        if($streams == "all"){
            $output .='<h3 style="text-align:center; text-decoration: underline;">List of '.$class_name.' students</h3>';
        }
        else{
            $output .='<h3 style="text-align:center; text-decoration: underline;">List of Form '.$streams.' students</h3>';
 
        }
        $output .='
        <p style="text-align: right;"> '.$date.'</p>
        ';

        $output .='
        <table width="100%" style="border-collapse: collapse; border:0px;" >
        <tr>
            <th style="border: 1px solid; padding: 5px;" align="left" width="5%">#NO</th>
            <th style="border: 1px solid; padding: 5px;" align="left" width="15%">ADM No.</th>
            <th style="border: 1px solid; padding: 5px;" align="left" width="45%">Name</th>
            <th style="border: 1px solid; padding: 5px;" align="left" width="20%">Class stream</th>            
            <th style="border: 1px solid; padding: 5px;" align="left" width="15%">Gender</th>
        </tr>';


            if (!$students->isEmpty()){ 
                foreach ($students as $student){ 
                   $output .=' <tr>
                        <td style="border: 1px solid; padding: 5px;" align="left">'.$i++.'</td>
                        <td style="border: 1px solid; padding: 5px;" align="left">'.$student->admission_number.'</td>
                        <td style="border: 1px solid; padding: 5px;" align="left">'.$student->first_name.'  '.$student->middle_name.'  '.$student->last_name.'</td>
                       
                        <td style="border: 1px solid; padding: 5px;" align="left">'.$student->stream.'</td>
                       
                        <td style="border: 1px solid; padding: 5px;" align="left">'.$student->gender.'</td>
                        
                        
                    </tr>';
                }
            }
            $output .='
</table>';


        return $output;
        

    }


    public function getListWithParents($students, $class_name, $streams){

        if($students->isEmpty()){
            return "No students";
        }

        //get the system date
        $date = date('d-m-Y');
        $i = 1;

        $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg" alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>';
        if($streams == "all"){
            $output .='<h3 style="text-align:center; text-decoration: underline;">List of '.$class_name.' students and parents</h3>';
        }
        else{
            $output .='<h3 style="text-align:center; text-decoration: underline;">List of Form '.$streams.' students and parents</h3>';
 
        }
        $output .='
        <p style="text-align: right;"> '.$date.'</p>
        ';

        $output .='
        
        <table width="100%" style="border-collapse: collapse; border:0px;">
        <tr>
            <th style="border: 1px solid; padding: 5px;" align="left" width="5%">#NO</th>
            <th style="border: 1px solid; padding: 5px;" align="left" width="10%">ADM No.</th>
            <th style="border: 1px solid; padding: 5px;" align="left" >Student name</th>
            <th style="border: 1px solid; padding: 5px;" align="left" width="10%">Class</th>
            <th style="border: 1px solid; padding: 5px;" align="left" >Parent name</th>
            <th style="border: 1px solid; padding: 5px;" align="left" width="15%">Relationship</th>
            <th style="border: 1px solid; border-right: 1px solid; padding: 5px;" align="left" width="20%">Parent phone number</th>
        </tr>';

        

            if (!$students->isEmpty()){ 
                foreach ($students as $student){ 
                    $output.='    <tr >
                        <td style="border: 1px solid; padding: 5px;" align="left">'.$i++.'</td>
                        <td style="border: 1px solid; padding: 5px;" align="left">'.$student->admission_number.'</td>
                        <td style="border: 1px solid; padding: 5px;" align="left">'.$student->first_name.'  '.$student->last_name.'</td>
                       
                        <td style="border: 1px solid; padding: 5px;" align="left">'.$student->stream.'</td>';

                        
                        if (!$this->getStudentParents($student->student_id)->isEmpty()){ 
                           $output .=' <td style="border: 1px solid; padding: 5px;" align="left">';
                             foreach ($this->getStudentParents($student->student_id) as $parent){ 
                                $output .= $parent->first_name.' '.$parent->last_name.' <br>';
                             }
                            
                            $output .=' </td>

                            <td style="border: 1px solid; padding: 5px;" align="left">';
                             foreach ($this->getStudentParents($student->student_id) as $parent){ 
                                 if ($parent->relationship == null){ 
                                     $output .='-- <br>';
                                 } else{ 
                                   $output .= $parent->relationship.'<br>';
                                   
                                }
                             }
                            
                            $output .='
                            </td>

                            <td style="border: 1px solid; padding: 5px;" align="left">'; 
                             foreach ($this->getStudentParents($student->student_id) as $parent){ 
                                $output .=$parent->phone_no.'<br>';
                             }
                             $output .='
                            </td>

                            ';
                           
                            } else{ 
                            $output .='
                            <td style="border: 1px solid; padding: 5px;" align="left">--</td>
                            <td style="border: 1px solid; padding: 5px;" align="left">--</td>
                            <td style="border: 1px solid; padding: 5px;" align="left">--</td>';
                        }
                    
                        $output .='

                      
                    </tr>';
                     }
                     }
                    
       $output .='
</table>';


    return $output;

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

    public function getStreams($class_name){
        $streams;
        $real_class_name;

        //get the class streams
        if($class_name == 'Form 1' ){
            $streams = ['1E', '1W'];
        } else if($class_name == 'Form 2'){
            $streams = ['2E', '2W'];
        } else if($class_name == 'Form 3'){
            $streams = ['3E', '3W'];
        } elseif($class_name == 'Form 4'){
            $streams = ['4E', '4W'];
        } else{
            echo 'The class does not exist';
            exit();
        }

        return $streams;
    }

 
    public function getStudentParents($student_id){

        $student_parents = DB::table('student_parent')
                            ->join('parents', 'student_parent.parent_id', 'parents.id')
                            ->where('student_parent.student_id', $student_id)
                            ->get();
    
        return $student_parents;
    
    }
}
