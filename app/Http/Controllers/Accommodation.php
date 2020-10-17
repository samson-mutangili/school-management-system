<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Dormitory;

class Accommodation extends Controller
{
    //
    //function that displays the dashboard
    public function dashboard(){

        return view('accommodation_dashboard');

    }

    public function showDormitories(){

        //get the available dormitories
        $dormitories = Dormitory::all();

        return view('dormitories', ['dormitories'=>$dormitories]);
    }

    //function that saves dormitory data to db
    public function insertDormitory(Request $request){

        //get the data from the form
        $dorm_name = $request->input('dorm_name');
        $dorm_status = $request->input('dorm_status');

        //check if the dorm name already exists
        $check_dorm = Dormitory::where('name', $dorm_name)->get();

        if(!$check_dorm->isEmpty()){
            //set message in a flash session
            $request->session()->flash('dorm_exists', 'A dormitory with the name, '.$dorm_name.', already exists. You can click on the dormitory to check the available rooms or add new rooms.');
            return redirect('/accommodation_facility/dormitories');
        } else{
            //save the dormitory details
            $dorm = new Dormitory;
            $dorm->name = $dorm_name;
            $dorm->status = $dorm_status;
            $dorm->save();

            //set a message is a flash session
            $request->session()->flash('dorm_inserted', 'A new dormitory has been added successfully.');
            return redirect('/accommodation_facility/dormitories');

        }
    }


    //function to update dormitory details
    public function updateDormitory(Request $request){

        //get the data from the form
        $dorm_id = $request->input('dorm_id');
        $dorm_name = $request->input('dorm_name');
        $dorm_status = $request->input('dorm_status');


        if($dorm_name == null || $dorm_name == "" || $dorm_status == "" || $dorm_status == null){
            $request->session()->flash('name_empty', 'Dormitory details not updated because the dormitory details were empty!!');
            return redirect('/accommodation_facility/dormitories');
        }

        //check if the dorm name already exists
        $check_dorm = Dormitory::where('name', $dorm_name)
                                ->where('status', $dorm_status)                        
                                ->get();


        if(!$check_dorm->isEmpty()){
            //set message in a flash session
            $request->session()->flash('dorm_exists', 'A dormitory with the name, '.$dorm_name.', already exists. You can click on the dormitory to check the available rooms or add new rooms.');
            return redirect('/accommodation_facility/dormitories');
        } else{
             //update the corresponding dorm details
            $update_dorm = DB::table('dormitories')
            ->where('id', $dorm_id)
            ->update([
                'name'=>$dorm_name,
                'status'=>$dorm_status
            ]);

            if($update_dorm == 1){
            //set success message in a flash session
            $request->session()->flash('dorm_updated', 'Dormitory details have been updated successfully.');
            return redirect('/accommodation_facility/dormitories');
            } else{
            //set failure message in a flash session
            $request->session()->flash('update_failed', 'Error!! Failed to update dormitory details');
            return redirect('/accommodation_facility/dormitories');
            }
        }    

       
        
    }

    public function dormRooms($dorm_id){

        //get the dorm ID
        $dormID = $dorm_id;

        //get the dorm details
        $dorm_details = Dormitory::where('id', $dormID)->get();

        $dormName = "NOT_AVAILABLE";
        if(!$dorm_details->isEmpty()){
            foreach($dorm_details as $dorm){
                $dormName = $dorm->name;
                break;
            }
        }

        //get the dormitory rooms
        $dorm_rooms = DB::table('dormitories')
                         ->join('dormitories_rooms', 'dormitories.id', 'dormitories_rooms.dorm_id')
                         ->where('dormitories_rooms.dorm_id', $dormID)
                         ->where('dormitories_rooms.deleted', 'NO')
                         ->get();


        

        return view('dorm_rooms', ['dormID'=>$dormID, 'dormName'=>$dormName, 'dorm_rooms'=>$dorm_rooms]);
    }

    public function addRoom($dorm_id){

        //get the dorm id
        $dormID = $dorm_id;

        //get the dorm details
        $dorm_details = DB::table('dormitories')
                          ->select('name')
                          ->where('id', $dormID)
                          ->get();

        $dorm_name = "";
        if(!$dorm_details->isEmpty()){
            foreach($dorm_details as $dorm){
                $dorm_name = $dorm->name;
                break;
            }
        }

        //return to the view with the dormitory name
        return view('newRoom', ['dormID'=>$dormID, 'dormName'=>$dorm_name]);
        
    }

    public function insertNewRoom(Request $request){

        //get the details from the form
        $dormName = $request->input('dormName');
        $dorm_id = $request->input('dorm_id');
        $room_no = $request->input('room_no');
        $room_capacity = $request->input('room_capacity');
        $room_status = $request->input('room_status');

        //check if the room already exists in db
        $room_available = DB::table('dormitories_rooms')
                            ->where('dorm_id', $dorm_id)
                            ->where('room_no', $room_no)
                            ->where('deleted', 'NO')
                            ->get();

        if(!$room_available->isEmpty()){
            //set error message
            $request->session()->flash('room_available','A room with the room number, '.$room_no.', is already available!!');
            return view('newRoom', ['dormName'=>$dormName, 'dormID'=>$dorm_id, 'room_no'=>$room_no, 'room_capacity'=>$room_capacity, 'room_status'=>$room_status]);
        }
        else{
            //save the room details
            $save_room = DB::table('dormitories_rooms')
                           ->insert([
                                'dorm_id'=>$dorm_id,
                                'room_no'=>$room_no,
                                'room_capacity'=>$room_capacity,
                                'room_status'=>$room_status
                           ]);

            //set success message in a session
            $request->session()->flash('room_saved', 'A new room has been added successfully');
            return redirect('/accommodation_facility/dormitory/'.$dorm_id);
            
        }

    }

    public function removeRoom(Request $request)
    {
       //get the room id      
       $room_id = $request->input('room_id');

       //get the dormID
       $dorm_id = $request->input('dorm_id');

       $deleted = DB::table('dormitories_rooms')
                    ->where('id', $room_id)
                    ->update([
                        'deleted'=>'YES'
                    ]);

        if($deleted == 1){
            //set message in a flash session
            $request->session()->flash('deleted_success', 'Room has been removed successfully');
            return redirect('/accommodation_facility/dormitory/'.$dorm_id);
        } else{
            //set message in a flash session
            $request->session()->flash('deleted_fail', 'Room has not been removed');
            return redirect('/accommodation_facility/dormitory/'.$dorm_id);
        }
    }

    //function for editing dormitory rooms
    public function editRoom(Request $request){

        //get the details from the form
        $dorm_id = $request->input('dorm_id');
        $room_id = $request->input('room_id');
        $room_no = $request->input('room_no');
        $room_capacity = $request->input('room_capacity');
        $room_status = $request->input('room_status');

        //check for empty fields
        if($room_no == "" || $room_no == null || $room_capacity == "" || $room_capacity == null || $room_status == "" || $room_status == null){
            //set message in a flash session
            $request->session()->flash('empty_field', 'Failed to update room details. Some input fields were empty!!');
            return redirect('/accommodation_facility/dormitory/'.$dorm_id);
        }

        //check for negative room capacity
        if($room_capacity < 1){
            //set message in a flash session
            $request->session()->flash('negative_capacity', 'Room capacity can not be less than 1. You entered '.$room_capacity);
            return redirect('/accommodation_facility/dormitory/'.$dorm_id);
        }
         //check for unreasonable room capacity
         if($room_capacity > 1000){
            //set message in a flash session
            $request->session()->flash('large_capacity', 'Room capacity cannot exceed 1000. You entered '.$room_capacity);
            return redirect('/accommodation_facility/dormitory/'.$dorm_id);
        }

        //update the room details
        $update_room = DB::table('dormitories_rooms')
                         ->where('id', $room_id)
                         ->update([
                             'room_no'=>$room_no,
                             'room_capacity'=>$room_capacity,
                             'room_status'=>$room_status
                         ]);

            //set message in a flash session
            $request->session()->flash('update_success', 'Dormitory room details have been updated successfully');
            return redirect('/accommodation_facility/dormitory/'.$dorm_id);
        


    }

    public function studentRooms($class_name){

        $className = $class_name;

        //get the students in the class
        $students = DB::table('students')
                      ->where('class', $className)
                      ->where('status', 'active')
                      ->get();
                    
        $student_rooms = DB::table('student_dorm_rooms')
                           ->where('status', 'active')
                           ->get();

        $dorm_rooms = DB::table('dormitories')
                        ->join('dormitories_rooms', 'dormitories.id', 'dormitories_rooms.dorm_id')
                        ->where('dormitories_rooms.deleted', 'NO')
                        ->get();


        return view('studentRooms', ['className'=>$className, 'students'=>$students, 'student_rooms'=>$student_rooms, 'dorm_rooms'=>$dorm_rooms]);
    }

    public function deallocateRoom(Request $request){

        //get the student room id
        $studentRoomID = $request->input('student_room_id');

        //get the class name
        $className = $request->input('className');

        //get the current system date
        $date_to = date("d-m-Y");

        $deallocate = DB::table('student_dorm_rooms')
                        ->where('id', $studentRoomID)
                        ->update([
                            'date_to'=>$date_to,
                            'status'=>'deallocated'
                        ]);

        if($deallocate == 1){
            //set a message in a flash session
            $request->session()->flash('room_deallocated', 'Student room was deallocated successfully');

            //return redirect
            return redirect('/accommodation_facility/studentRooms/'.$className);
        } else{
            //set a message in a flash session
            $request->session()->flash('deallocation_failed', 'Deallocation of student room failed!!');

            //return redirect
            return redirect('/accommodation_facility/studentRooms/'.$className);
        }

        
    }

    public function allocateRoomForm($student_id, $class_name){

        $studentID = $student_id;
        $className = $class_name;

        //get the dormitories available
        $dorms = DB::table('dormitories')->where('status', 'Good')->get();

        //get the student_details
        $student_details = DB::table('students')->where('id', $studentID)->get();

        $available_dorm_rooms = DB::table('dormitories')->where('name', 'fff56')->get();
        $student_name = "";
        $adm_no = 0;

        $dorm_name = "";
        if(!$student_details->isEmpty()){
            foreach($student_details as $student){
                $student_name = $student->first_name . " " .$student->middle_name ." " .$student->last_name;
                $adm_no = $student->admission_number;
            }
        }

        return view('allocate_room', ['dorm_name'=>$dorm_name, 'student_id'=>$studentID, 'class_name'=>$className , 'student_name'=>$student_name, 'adm_no'=>$adm_no, 'dorms'=>$dorms, 'available_dorm_rooms'=>$available_dorm_rooms]);
    }

    public function saveRoom(Request $request){

        //get the details from the form
        $student_id = $request->input('student_id');
        $class_name = $request->input('class_name');
        $student_name = $request->input('student_name');
        $adm_no = $request->input('adm_no');
        $dorm = $request->input('dorm');
        $room = $request->input('room');

        //get the dormitories available
        $available_dorms = DB::table('dormitories')->where('status', 'Good')->get();

        if($dorm == "" || $dorm == null){

            $available_dorm_rooms = DB::table('dormitories')->where('name', 'fff56')->get();

            //return to the view
            return view('allocate_room', ['class_name'=>$class_name, 'student_id'=>$student_id, 'adm_no'=>$adm_no, 'student_name'=>$student_name, 'dorms'=>$available_dorms, 'dorm_name'=>$dorm, 'available_dorm_rooms'=>$available_dorm_rooms]);
        }

        if($dorm != "" && $room == ""){

            //get the dorm id
        $dorms_id = DB::table('dormitories')
                      ->select('id')
                      ->where('name', $dorm)
                      ->get();

        $dorm_id = 1;
        if(!$dorms_id->isEmpty()){
            foreach($dorms_id as $dormitory_id){
                $dorm_id = $dormitory_id->id;
            }
        }

        //check for the available rooms in the dormitory
        $available_dorm_rooms = DB::table('dormitories_rooms')
                                  ->where('dorm_id', $dorm_id)
                                  ->where('room_status', 'Good')
                                  ->where('deleted', 'NO')
                                  ->get();

        //return to the form with room options
        return view('allocate_room', ['class_name'=>$class_name, 'student_id'=>$student_id, 'adm_no'=>$adm_no, 'student_name'=>$student_name, 'dorms'=>$available_dorms, 'available_dorm_rooms'=>$available_dorm_rooms, 'dorm_name'=>$dorm]);


        }


        if($dorm != "" && $room != ""){

            //get the dorm id
            $dorms_id = DB::table('dormitories')
                      ->select('id')
                      ->where('name', $dorm)
                      ->get();

            $dorm_id = 1;
            if(!$dorms_id->isEmpty()){
                foreach($dorms_id as $dormitory_id){
                    $dorm_id = $dormitory_id->id;
                }
            }

            //check for dorm and room consistency
            $dormitory_room = DB::table('dormitories_rooms')
                                ->where('dorm_id', $dorm_id)
                                ->where('room_no', $room)
                                ->where('room_status', 'Good')
                                ->where('deleted', 'NO')
                                ->get();

            if(!$dormitory_room->isEmpty()){


                $dorm_room_id = 1;
                //get the room id
                foreach($dormitory_room as $dorm_room){
                    $dorm_room_id = $dorm_room->id;
                }

                //get the current date
                $date_from = date('d-m-Y');

                $student_room = DB::table('student_dorm_rooms')
                                  ->insert([
                                    'student_id'=>$student_id,
                                    'room_id'=>$dorm_room_id,
                                    'date_from'=>$date_from
                                  ]);

                if($student_room == 1){
                    //set a message in a flash session
                    $request->session()->flash('allocation_successful', 'Student has been allocated a room successfully');

                    //return redirect
                    return redirect('/accommodation_facility/studentRooms/'.$class_name);
                } else{

                    //set a message in a flash session
                    $request->session()->flash('allocation_failed', 'Allocation of dormitory room to student has failed');

                    //return redirect
                    return redirect('/accommodation_facility/studentRooms/'.$class_name);
                }

            } else{
                        //get the dorm id
                $dorms_id = DB::table('dormitories')
                            ->select('id')
                            ->where('name', $dorm)
                            ->get();

                $dorm_id = 1;
                if(!$dorms_id->isEmpty()){
                    foreach($dorms_id as $dormitory_id){
                        $dorm_id = $dormitory_id->id;
                    }
                }

                //check for the available rooms in the dormitory
                $available_dorm_rooms = DB::table('dormitories_rooms')
                                        ->where('dorm_id', $dorm_id)
                                        ->where('room_status', 'Good')
                                        ->where('deleted', 'NO')
                                        ->get();

                //return to the form with room options
                return view('allocate_room', ['class_name'=>$class_name, 'student_id'=>$student_id, 'adm_no'=>$adm_no, 'student_name'=>$student_name, 'dorms'=>$available_dorms, 'available_dorm_rooms'=>$available_dorm_rooms, 'dorm_name'=>$dorm]);

            }
        }
        
        

        


    }

    public function editRoomForm($student_id, $class_name){
        //get the student id and class name
        $studentID = $student_id;
        $className = $class_name;

        //get the student dormitory rooms
        $student_room = DB::table('student_dorm_rooms')
                          ->join('dormitories_rooms', 'student_dorm_rooms.room_id', 'dormitories_rooms.id')
                          ->where('student_dorm_rooms.student_id', $studentID)
                          ->where('student_dorm_rooms.status', 'active')
                          ->get();

        
        //get the dormitories available
        $dorms = DB::table('dormitories')->where('status', 'Good')->get();

        //get the student_details
        $student_details = DB::table('students')->where('id', $studentID)->get();


        if(!$student_room->isEmpty()){
            foreach($student_room as $room){
                //check for the available rooms in the dormitory
                 $available_dorm_rooms = DB::table('dormitories_rooms')
                                    ->where('dorm_id', $room->dorm_id)
                                    ->where('room_status', 'Good')
                                    ->where('deleted', 'NO')
                                    ->get();
            }
        }
        
        $student_name = "";
        $adm_no = 0;

        $dorm_name = "";
        if(!$student_details->isEmpty()){
            foreach($student_details as $student){
                $student_name = $student->first_name . " " .$student->middle_name ." " .$student->last_name;
                $adm_no = $student->admission_number;
            }
        }

        return view('edit_allocated_room', ['student_room'=>$student_room, 'dorm_name'=>$dorm_name, 'student_id'=>$studentID, 'class_name'=>$className , 'student_name'=>$student_name, 'adm_no'=>$adm_no, 'dorms'=>$dorms, 'available_dorm_rooms'=>$available_dorm_rooms]);
    
        
    }


    public function saveEditedRoom(Request $request){

        //get the details from the form
        $student_id = $request->input('student_id');
        $class_name = $request->input('class_name');
        $student_name = $request->input('student_name');
        $adm_no = $request->input('adm_no');
        $dorm = $request->input('dorm');
        $room = $request->input('room');

        $student_room = DB::table('student_dorm_rooms')->where('id', 0)->get();
        //get the dormitories available
        $available_dorms = DB::table('dormitories')->where('status', 'Good')->get();

        if($dorm == "" || $dorm == null){

            $available_dorm_rooms = DB::table('dormitories')->where('name', 'fff56')->get();

            //return to the view
            return view('edit_allocated_room', ['student_room'=>$student_room, 'class_name'=>$class_name, 'student_id'=>$student_id, 'adm_no'=>$adm_no, 'student_name'=>$student_name, 'dorms'=>$available_dorms, 'dorm_name'=>$dorm, 'available_dorm_rooms'=>$available_dorm_rooms]);
        }

        if($dorm != "" && $room == ""){

            //get the dorm id
        $dorms_id = DB::table('dormitories')
                      ->select('id')
                      ->where('name', $dorm)
                      ->get();

        $dorm_id = 1;
        if(!$dorms_id->isEmpty()){
            foreach($dorms_id as $dormitory_id){
                $dorm_id = $dormitory_id->id;
            }
        }

        //check for the available rooms in the dormitory
        $available_dorm_rooms = DB::table('dormitories_rooms')
                                  ->where('dorm_id', $dorm_id)
                                  ->where('room_status', 'Good')
                                  ->where('deleted', 'NO')
                                  ->get();

        //return to the form with room options
        return view('edit_allocated_room', ['student_room'=>$student_room, 'class_name'=>$class_name, 'student_id'=>$student_id, 'adm_no'=>$adm_no, 'student_name'=>$student_name, 'dorms'=>$available_dorms, 'available_dorm_rooms'=>$available_dorm_rooms, 'dorm_name'=>$dorm]);


        }


        if($dorm != "" && $room != ""){

            //get the dorm id
            $dorms_id = DB::table('dormitories')
                      ->select('id')
                      ->where('name', $dorm)
                      ->get();

            $dorm_id = 1;
            if(!$dorms_id->isEmpty()){
                foreach($dorms_id as $dormitory_id){
                    $dorm_id = $dormitory_id->id;
                }
            }

            //check for dorm and room consistency
            $dormitory_room = DB::table('dormitories_rooms')
                                ->where('dorm_id', $dorm_id)
                                ->where('room_no', $room)
                                ->where('room_status', 'Good')
                                ->where('deleted', 'NO')
                                ->get();

            if(!$dormitory_room->isEmpty()){

                $dorm_room_id = 1;
                //get the room id
                foreach($dormitory_room as $dorm_room){
                    $dorm_room_id = $dorm_room->id;
                }

                //get the current student room
                $student_room_details = DB::table('student_dorm_rooms')
                                          ->where('student_id', $student_id)
                                          ->where('room_id', $dorm_room_id)
                                          ->where('status', 'active')
                                          ->get();
                if(!$student_room_details->isEmpty()){
                    //set a message in a flash session
                    $request->session()->flash('room_update_successful', 'Student room has been updated successfully');

                    //return redirect
                    return redirect('/accommodation_facility/studentRooms/'.$class_name);
                }
                else{

                    //get the current date
                    $date_from = date('d-m-Y');
                    $date_to = date('d-m-Y');

                    //first update db
                    $update_previous_room = DB::table('student_dorm_rooms')
                                              ->where('student_id', $student_id)
                                              ->update([
                                                'date_to'=>$date_to,
                                                'status'=>'changed'
                                              ]);
                    
                    //insert a new row 
                    $insert_student_room = DB::table('student_dorm_rooms')
                                             ->insert([
                                                 'student_id'=>$student_id,
                                                 'room_id'=>$dorm_room_id,
                                                 'date_from'=>$date_from
                                             ]);

                    if($insert_student_room == 1){
                    //set a message in a flash session
                    $request->session()->flash('room_update_successful', 'Student room has been updated successfully');

                    //return redirect
                    return redirect('/accommodation_facility/studentRooms/'.$class_name);
                    } else{

                        //set a message in a flash session
                        $request->session()->flash('room_updated_failed', 'Student room has not been updated!!');

                        //return redirect
                        return redirect('/accommodation_facility/studentRooms/'.$class_name);
                    }
                }

            } else{
                        //get the dorm id
                $dorms_id = DB::table('dormitories')
                            ->select('id')
                            ->where('name', $dorm)
                            ->get();

                $dorm_id = 1;
                if(!$dorms_id->isEmpty()){
                    foreach($dorms_id as $dormitory_id){
                        $dorm_id = $dormitory_id->id;
                    }
                }

                //check for the available rooms in the dormitory
                $available_dorm_rooms = DB::table('dormitories_rooms')
                                        ->where('dorm_id', $dorm_id)
                                        ->where('room_status', 'Good')
                                        ->where('deleted', 'NO')
                                        ->get();

                //return to the form with room options
                return view('edit_allocated_room', ['student_room'=>$student_room, 'class_name'=>$class_name, 'student_id'=>$student_id, 'adm_no'=>$adm_no, 'student_name'=>$student_name, 'dorms'=>$available_dorms, 'available_dorm_rooms'=>$available_dorm_rooms, 'dorm_name'=>$dorm]);

            }
        }

    }

    public function detailedReport(){

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->detailedReportPDF());
        return $pdf->stream();
        
    }

    public function detailedReportPDF(){

        //get the dorms available

        $dorms = DB::table('dormitories')->get();

        //get the system date
        $date = date('d-m-Y');

        $output = '
        <p style="text-align: center;"><img src="images/egerton_university_logo.jpg" alt="logo here"/></p>
        <h2 style="text-align: center; ">SHINERS HIGH SCHOOL</h2>
        <p style="text-align: center; font-size: 17px;">P.O BOX 67-64700 NJORO, KENYA. Email:shinershighschool@gmail.com</p>
        <h2 style="text-align:center; text-decoration: underline;">Accommodation facility department</h2>
        <p style="float: right;"> '.$date.'</p>
        ';

        if(!$dorms->isEmpty()){
            foreach($dorms as $dorm){

                $output .='
    
                    <p style="font-size: 17px;">Dormitory name: ' .$dorm->name.' </p> 
                    <p style="font-size: 17px;">Dormitory status: ' .$dorm->status.' </p> 
                    

                    <p style="font-size: 17px; text-decoration: underline;">'.$dorm->name.' dormitory rooms</p>


                    <table width="100%" style="border-collapse: collapse; border:0px;">
                        <tr>
                            <th style="border: 1px solid; padding: 5px;" align="left" width="8%" >S/No</th>
                            <th style="border: 1px solid; padding: 5px;"  align="left" >Room number</th>
                            <th style="border: 1px solid; padding: 5px;"  align="left">Total capacity</th>
                            <th style="border: 1px solid; padding: 5px;" align="left" >Available Capacity</th>
                            <th style="border: 1px solid; padding: 5px;" align="left">Room status</th>
                            

                        </tr>

                        ';
                        $i = 1;
                        //get the dormitory rooms
                        $dorms_rooms = DB::table('dormitories_rooms')
                                         ->where('dorm_id', $dorm->id)
                                         ->get();

                        if(!$dorms_rooms->isEmpty()){

                            $total_capacity = 0;
                            $total_available_capacity = 0;

                            foreach($dorms_rooms as $dorm_room){

                                //get the number of rooms occupied
                                $rooms_occupied = DB::table('student_dorm_rooms')
                                                    ->where('room_id', $dorm_room->id)
                                                    ->where('status', 'active')
                                                    ->count();
                                $available_capacity = $dorm_room->room_capacity - $rooms_occupied;

                                
                                $total_capacity += $dorm_room->room_capacity;
                                $total_available_capacity += $available_capacity; 

                                $output .= ' 
                                    <tr>
                                        <td  style="border: 1px solid; padding: 5px;"> '.$i++.'</td>
                                        <td  style="border: 1px solid; padding: 5px;"> '.$dorm_room->room_no.'</td>
                                        <td  style="border: 1px solid; padding: 5px;"> '.$dorm_room->room_capacity.'</td>
                                        <td  style="border: 1px solid; padding: 5px;"> '.$available_capacity.'</td>
                                        <td  style="border: 1px solid; padding: 5px;"> '.$dorm_room->room_status.'</td>
                                    </tr>
                            
                    ';
                            }
                        }

                        $output .='
                            <tr>
                                <td  style="border: 1px solid; padding: 5px;" colspan="2"> Total</td>
                                <td  style="border: 1px solid; padding: 5px;"> '.$total_capacity.'</td>
                                <td  style="border: 1px solid; padding: 5px;"> '.$total_available_capacity.'</td>
                                <td  style="border: 1px solid; padding: 5px;"> </td>
                            </tr>
                        
                        </table>
        
                        <br>
                        ';
                        
    
            }
        } else{

            $output .='
            
            <p style="color: red;">No rooms available</p>
            
            ';
        }
        

        return $output;
       
    }
}
