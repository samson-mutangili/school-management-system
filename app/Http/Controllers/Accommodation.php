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
                         ->get();


        

        return view('dorm_rooms', ['dormID'=>$dormID, 'dormName'=>$dormName, 'dorm_rooms'=>$dorm_rooms]);
    }
}
