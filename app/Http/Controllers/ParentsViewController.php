<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParentsViewController extends Controller
{
    //function for logging in as parent
    public function parentLogin(Request $request){

        //get the details from the form
        $email = $request->input('email');
        $password = $request->input('password');


        //check if user exists
        $check_user = DB::table('parents')
                        ->where('email', $email)
                        ->get();

        if($check_user->isEmpty()){
            $request->session()->flash('invalid_user', 'Parent with that email does not exist in the system!!');
            $request->session()->flash('email', $email);

            return redirect('/parentlogin');
        } else{
            //check for password
            $check_password = DB::table('parents')
                                ->where('email', $email)
                                ->where('id_no', $password)
                                ->get();
            if($check_password->isEmpty()){
                $request->session()->flash('invalid_password', 'You entered wrong password!!');
                $request->session()->flash('email', $email);
                return redirect('/parentlogin');
            } else{
                //redirect to the correct panel

                $parent_id;
                foreach($check_password as $parent ){
                    $parent_id = $parent->id;
                    $username = $parent->first_name; 

                }

                //add the user details to a session
                $request->session()->put('parent_details', $check_password);
                $request->session()->put('username', $username);
                $request->session()->put('is_parent', true);
                $request->session()->put('parent_id', $parent_id);

                return redirect('/parents/children/'.$parent_id);
            }
        }


    }

    //function to display parent children
    public function parentChildren($parentID){


        //get the children associated with the parent
        $parent_id = $parentID;

        //get children
        $parent_children = DB::table('students')
                             ->join('student_parent', 'students.id', 'student_parent.student_id')
                             ->where('student_parent.parent_id', $parent_id)
                             ->get();

        return view('parents_view.landing_page', ['children'=>$parent_children, 'parent_id'=>$parent_id]);
    }

    //function to get specific child
    public function specificChild($parent_id, $child_id){

        

        //get the student details from the database
        $student_details = DB::table('students')
                                ->where('id', $child_id)
                                ->get();

        $student_classes = DB::table('student_classes')
                              ->where('student_id', $child_id)
                              ->get();

        $student_address = DB::table('addresses')
                             ->join('student_address', 'addresses.id', 'student_address.address_id')
                             ->where('student_address.student_id', $child_id)
                             ->get();

        $student_parents = DB::table('parents')
                             ->join('student_parent', 'parents.id', 'student_parent.parent_id')
                             ->where('student_parent.student_id', $child_id)
                             ->get();
                             
        $student_result_slips = DB::table('student_marks_ranking')
                                  ->where('student_id', $child_id)
                                  ->get();

        $disciplinary_cases = DB::table('disciplinary_cases')
                                ->join('teachers', 'disciplinary_cases.teacher_id', 'teachers.id')
                                ->where('disciplinary_cases.student_id', $child_id)
                                ->get();
        $student_fees = DB::table('students')
                             ->join('fee_balances', 'students.id', 'fee_balances.student_id')
                             ->where('students.id', $child_id)
                             ->get();
         $fee_transactions = DB::table('fee_transactions')
                               ->where('student_id', $child_id)
                               ->get();
             
        return view('parents_view.specific_child', [
            'student_details'=>$student_details,
            'student_classes'=>$student_classes,
            'student_address'=>$student_address,
            'student_parents'=>$student_parents,
            'student_result_slips'=>$student_result_slips,
            'student_disciplinary_cases'=>$disciplinary_cases,
            'parent_id'=>$parent_id,
            'fee_transactions'=>$fee_transactions,
            'student_fees'=>$student_fees
            ]);
    }
}
