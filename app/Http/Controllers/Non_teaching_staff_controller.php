<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//import the model
use App\Non_teaching_staff_model;

use Illuminate\Support\Facades\DB;

class Non_teaching_staff_controller extends Controller
{

 
    //function to insert non teaching staff details into the database
    public function insertStaff(Request $request){

        //get the current system date as the hire date of the staff
        $hire_date = date("Y-m-d");

        //make a new object of the model
        $staff = new Non_teaching_staff_model;

        //get the details from the form and save them in the respective fields
        $staff->first_name = $request->input('first_name');
        $staff->middle_name = $request -> input('middle_name');
        $staff->last_name = $request -> input('last_name');
        $staff->phone_no = $request -> input('phone_no');
        $staff->email = $request -> input('email');
        $staff->id_no = $request -> input('id_no');
        $staff->emp_no = $request -> input('emp_no');
        $staff->category = $request -> input('category');
        $staff->gender = $request -> input('gender');
        $staff->religion = $request -> input('religion');
        $staff->nationality = $request -> input('nationality');
        $staff->salary = $request -> input('salary');
        $staff->hired_date = $hire_date;
        $staff->save();

        //fetch all the non teaching staff records from the database
        //$non_teaching_staff = Non_teaching_staff_model::all();

        //fetch the staff details and paginate
        $non_teaching_staff = DB::table('non_teaching_staff')
                                  ->where('status', 'active')
                                  ->paginate(8);

        return view('non_teaching_staff_details', ['non_teaching_staff'=>$non_teaching_staff]);
    }

    public function showStaff(Request $request){

      //fetch the staff details and paginate
      $non_teaching_staff = DB::table('non_teaching_staff')
                            ->where('status', 'active')
                            ->paginate(10);

      $no_to_paginate = 10;
      $sort_order = "all";

      //get the data from the sort form and assign to variables through a condition
      if($request->input('no_to_paginate') != null){
        $no_to_paginate = $request->input('no_to_paginate');
      }
      
      if($request->input('sort_order') != null){
        $sort_order = $request->input('sort_order');
      }
      

      if($request->input('no_to_paginate') != null){

        if( $no_to_paginate == null){
          $no_to_paginate = 8;
        }
        //fetch the staff details and paginate
        $non_teaching_staff = DB::table('non_teaching_staff')
                                ->where('status', 'active')
                                ->paginate($no_to_paginate);

      }

      if($sort_order != null){

        //if the selected value is all, fetch all the non teaching staff details
        if($sort_order == "all"){
          if( $request->input('no_to_paginate') == null){
            $no_to_paginate = 10;
          }
          //fetch the staff details and paginate
            $non_teaching_staff = DB::table('non_teaching_staff')
                                    ->where('status', 'active')
                                    ->paginate($no_to_paginate);
        }
        else{
          if( $no_to_paginate == null){
            $no_to_paginate = 10;
          }
          //fetch the staff details and paginate
          $non_teaching_staff = DB::table('non_teaching_staff')
                                    ->where('status', 'active')
                                    ->where('category', $sort_order)
                                    ->paginate($no_to_paginate);
        }
      }

      

      $i=1;
      //get the number page
      $page = $request->input('page');
      if($page != null){
        if($page == 1){
          $i = 1;
        } else{
          $i = $i + $no_to_paginate;
        }
        
      }



      //fetch all the non teaching staff records from the database
      // $non_teaching_staff = Non_teaching_staff_model::all();

      return view('non_teaching_staff_details', ['non_teaching_staff'=>$non_teaching_staff, 'i'=>$i]);
    
    }

    //function for showing a specific staff details
    public function specificStaff($id){

      //get the id of the staff
      $staff_id = $id;

      //select the details of the user from the database
      $staff_details = Non_teaching_staff_model::where('id', $staff_id)->get();

       //return to aview together with staff data
      return view('staff_details', ['staff_details'=>$staff_details, 'not_updated'=>'not update']);

    }

    //function to edit staff details
    public function editStaff(Request $request){
      //get the id of the staff
      $staff_id = $request->input('id');

      //query to update non teaching staff details
      $staff = DB::table('non_teaching_staff')
                      ->where('id', $request->input('id'))
                      ->update([
                        'first_name' => $request->input('first_name'),
                        'middle_name' => $request -> input('middle_name'),
                        'last_name' => $request -> input('last_name'),
                        'phone_no' => $request -> input('phone_no'),
                        'email' => $request -> input('email'),
                        'id_no' => $request -> input('id_no'),
                        'emp_no' => $request -> input('emp_no'),
                        'category' => $request -> input('category'),
                        'gender' => $request -> input('gender'),
                        'religion' => $request -> input('religion'),
                        'nationality' => $request -> input('nationality'),
                        'salary' => $request -> input('salary')
                      ]);

      //put an update message in a flash session
      $request->session()->flash('update_successfully', 'Staff details were successfully updated');
      //return to the staff details view
      return redirect('/staff_details/'.$staff_id);

    }

    public function archiveStaff(Request $request){

      //get the date, which represents the date the employee left
      $date_left = date("Y-m-d");

      //update the corresponding employee details
      $staff = DB::table('non_teaching_staff')
                  ->where('id', $request->input('id'))
                  ->update([
                    'status' => 'archived',
                    'date_left' => $date_left
                  ]);

      //put some data in a flash session which represents the message to be displayed
      $request->session()->flash('staff_archived', '1 non teaching staff details have been archived.');
      
      //return to the non teaching staff details
      return redirect('/nonTeachingStaffDetails');

    }

    //function to show all alumni staff details
    public function showAlumni(Request $request){


      //fetch the staff details and paginate
      $alumni_staff_details = DB::table('non_teaching_staff')
                            ->where('status', 'archived')
                            ->paginate(10);

      $no_to_paginate = 10;
      $sort_order = "all";

      //get the data from the sort form and assign to variables through a condition
      if($request->input('no_to_paginate') != null){
        $no_to_paginate = $request->input('no_to_paginate');
      }
      
      if($request->input('sort_order') != null){
        $sort_order = $request->input('sort_order');
      }
      

      if($request->input('no_to_paginate') != null){

        if( $no_to_paginate == null){
          $no_to_paginate = 8;
        }
        //fetch the staff details and paginate
        $alumni_staff_details = DB::table('non_teaching_staff')
                                ->where('status', 'archived')
                                ->paginate($no_to_paginate);

      }

      if($sort_order != null){

        //if the selected value is all, fetch all the non teaching staff details
        if($sort_order == "all"){
          if( $request->input('no_to_paginate') == null){
            $no_to_paginate = 10;
          }
          //fetch the staff details and paginate
            $alumni_staff_details = DB::table('non_teaching_staff')
                                    ->where('status', 'archived')
                                    ->paginate($no_to_paginate);
        }
        else{
          if( $no_to_paginate == null){
            $no_to_paginate = 10;
          }
          //fetch the staff details and paginate
          $alumni_staff_details = DB::table('non_teaching_staff')
                                    ->where('status', 'archived')
                                    ->where('category', $sort_order)
                                    ->paginate($no_to_paginate);
        }
      }

      

      $i=1;
      //get the number page
      $page = $request->input('page');
      if($page != null){
        if($page == 1){
          $i = 1;
        } else{
          $i = $i + $no_to_paginate * (page -1);
        }
        
      }




      //return to a view with alumni details
      return view('alumni_staff_details', ['alumni_staff_details' => $alumni_staff_details, 'i'=>$i]);
    }

    //show the details of a specific alumni staff
    public function specificAlumni($id){

      //get the value of the  id
      $alumni_staff_id = $id;

      //query to select the specific alumni non teaching staff details
      $specific_alumni_details = Non_teaching_staff_model::where('id', $alumni_staff_id)->get();

      //return to a view with the alumni details
      return view('alumni_nonTeaching_staff_details', ['specific_alumni_details' => $specific_alumni_details]);
    }
}
