<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CommunicationsController extends Controller
{
    //
    function getStudents(Request $request, $class_name)
    {
        $stream1;
        $stream2;

        //get the real classes
        if($class_name == "Form1"){
            $stream1 = "1E";
            $stream2 = "1W";
        } else if($class_name == "Form2"){
            $stream1 = "2E";
            $stream2 = "2W";
        } else if($class_name == "Form3"){
            $stream1 = "3E";
            $stream2 = "3W";
        } else if($class_name == "Form4"){
            $stream1 = "4E";
            $stream2 = "4W";
        } else{
            $students = DB::table('students')->where('status', "5678")->get();
            $request->session()->flash('class_not_found', 'The class '.$class_name.' was not found');
            return view('emails.toAllStudents', ['students'=>$students] );
        }

         $all_students = DB::table('students')
                            ->join('student_classes', 'students.id', 'student_classes.student_id')
                            ->where(function ($query) use($stream1){
                                                            $query->where('student_classes.stream',  $stream1)
                                                                  ->where('student_classes.status', 'active');
                                                        })->orWhere(function($query) use($stream2){
                                                            $query->where('student_classes.stream', $stream2)
                                                                  ->where('student_classes.status', 'active');
                                                        })->get();

                                    
     
       //return to view
       return view('emails.toAllStudents', ['students'=>$all_students, 'class_form'=>$class_name]);

       
    }

    //function for sending email to all parents
    public function sendMailToClassParents(Request $request){

        //get the details from the form
        $class_name = $request->input('class_name');
        $subject = $request->input('subject');
        $message_body = $request->input('message_body');

        $details = [
            'subject'=>$subject,
            'message_body'=>$message_body
        ];

        $stream1;
        $stream2;

        $i = 0;
        //get the real classes
        if($class_name == "Form1"){
            $stream1 = "1E";
            $stream2 = "1W";
        } else if($class_name == "Form2"){
            $stream1 = "2E";
            $stream2 = "2W";
        } else if($class_name == "Form3"){
            $stream1 = "3E";
            $stream2 = "3W";
        } else if($class_name == "Form4"){
            $stream1 = "4E";
            $stream2 = "4W";
        } else{
            $students = DB::table('students')->where('status', "5678")->get();
            $request->session()->flash('class_not_found', 'The class '.$class_name.' was not found');
            return view('emails.toAllStudents', ['students'=>$students] );
        }




         $all_students = DB::table('students')
                            ->join('student_classes', 'students.id', 'student_classes.student_id')
                            ->where(function ($query) use($stream1){
                                                            $query->where('student_classes.stream',  $stream1)
                                                                  ->where('student_classes.status', 'active');
                                                        })->orWhere(function($query) use($stream2){
                                                            $query->where('student_classes.stream', $stream2)
                                                                  ->where('student_classes.status', 'active');
                                                        })->get();

        if(!$all_students->isEmpty()){

             
            $response = null;
            system("ping -c 1 google.com", $response);
            if($response == 0)
            {
                // there is internet connection

                    //foreach student, get the parent details
                foreach($all_students as $student){

                    //get the parents details 
                    $student_parents = DB::table('student_parent')
                                        ->join('parents', 'student_parent.parent_id', 'parents.id')
                                        ->where('student_parent.student_id', $student->id)
                                        ->get();

                    if(!$student_parents->isEmpty()){
                        //get the emails
                        foreach($student_parents as $parent){
                            $parent_email = $parent->email;
                            //send email to parent
                             \Mail::to($parent_mail)->send(new \App\Mail\MailToParent($details));
                            
                        }

                    }
                }


                //messages have been send, redirect with success message
                $request->session()->flash('messages_send', 'Emails have been send to all parents who have students in '.$class_name);
                return redirect('/Communications/'.$class_name);
            } else{
                //no internet connection
                $request->session()->flash('no_internet', 'Failed to connect! Please ensure that you are connected to internet in order to send the messages!');
                return redirect('/Communications/'.$class_name);
            }


            

        }

        echo "am done ";

    }
   

}
