<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SendMailController extends Controller
{
    //function for sending email to parent
    public function sendMailToParent(Request $request){

        //get the data from the form
        $student_id = $request->input('student_id');
        $class_name = $request->input('class_name');
        $out_of_session = $request->input('out_of_session');
        
        //get the message details        
        $subject= $request->input('subject'); 
        $message_body = $request->input('message_body');

        $details = [
            'subject'=>$subject,
            'message_body'=>$message_body
        ];

        //get the teacher id
        $teacher_id = $request->session()->get('teacher_id');

        
        $current_date = date("Y-m-d h:i:sa");
       


        $student_parent = DB::table('student_parent')
                            ->join('parents', 'student_parent.parent_id', 'parents.id')
                            ->where('student_parent.student_id', $student_id)
                            ->get();

        if(!$student_parent->isEmpty()){

             
            $response = null;
            system("ping -c 1 google.com", $response);
            if($response == 0)
            {
                // there is internet connection
                //send email inorder for the user to get the token
                foreach($student_parent as $parent){

                    //send email to parent
                    \Mail::to($parent->email)->send(new \App\Mail\MailToParent($details));

                    //save the message details to db
                    $save_message = DB::table('MailToStudentMessages')
                                      ->insert([
                                          'student_id'=>$student_id,
                                          'from_teacher_id'=>$teacher_id,
                                          'to_parent_id'=>$parent->id,
                                          'subject'=>$subject,
                                          'message_body'=>$message_body,
                                          'date_send'=>$current_date
                                      ]);

                    if($save_message == 1){
                        //set success  message
                        $request->session()->flash('message_saved', 'Message has been send and saved successfully');
                        if($out_of_session != "" || $out_of_session != null){
                            return redirect('/students/Outofsession/'.$student_id);
                        } else{
                            return redirect('/studentDetails/'.$class_name.','.$student_id);
                        }
                    } else{
                        //set error message
                        $request->session()->flash('message_send_not_saved', 'Message has been send but not saved in the system!');
                       
                        if($out_of_session != "" || $out_of_session != null){
                            return redirect('/students/Outofsession/'.$student_id);
                        } else{
                         return redirect('/studentDetails/'.$class_name.','.$student_id);
                        }
                    }
                }

               
            } else{
                //no internet connection
                $request->session()->flash('no_internet', 'Failed to connect! Please ensure that you are connected to internet in order to send the message!');
               
                if($out_of_session != "" || $out_of_session != null){
                    return redirect('/students/Outofsession/'.$student_id);
                } else{
                return redirect('/studentDetails/'.$class_name.','.$student_id);
                }
            }

        } else{
            //set error message
            $request->session()->flash('no_parent', 'Message not Send! No parent found for the student!!');
            
            if($out_of_session != "" || $out_of_session != null){
                return redirect('/students/Outofsession/'.$student_id);
            } else{
            return redirect('/studentDetails/'.$class_name.','.$student_id);
            }
        }

       








    }
}
