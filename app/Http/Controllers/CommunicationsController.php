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
        $teacher_id = $request->session()->get('teacher_id');

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
                             \Mail::to($parent_email)->send(new \App\Mail\MailToParent($details));
                              //save the message details to db
                             $save_message = DB::table('MailToStudentMessages')
                                                ->insert([
                                                    'student_id'=>$parent->student_id,
                                                    'from_teacher_id'=>$teacher_id,
                                                    'to_parent_id'=>$parent->parent_id,
                                                    'subject'=>$subject,
                                                    'message_body'=>$message_body,
                                                    'date_send'=>now(),
                                                    'created_up'=>now(),
                                                    'updated_at'=>now()
                                                ]);

                            
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
   

    //function for getting the send messages
    public function getGeneralReport(){

        $date_from = "";
        $date_to = "";

        //get the mail messages
        $mail_messages = DB::table('mailtostudentmessages')->get();
        if($mail_messages->isEmpty()){
            $request->session()->flash('no_reports', 'There are no mail messages that have been send');
        }

        return view('reports.communications_report', ['mail_messages'=>$mail_messages, 'date_from'=>$date_from, 'date_to'=>$date_to]);
    }


    //function that filters reports by dates
    public function reportByDates(Request $request){

        //get the dates range
        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $mail_messages = DB::table('mailtostudentmessages')
                            ->whereBetween('date_send', [$date_from, $date_to])
                            ->orderBy('date_send', 'Asc')
                            ->get();
        if($mail_messages->isEmpty()){
            $request->session()->flash('no_reports', 'There are no mail messages that have been send as from date '.$date_from.' to date '.$date_to);
        }

        return view('reports.communications_report', ['mail_messages'=>$mail_messages, 'date_from'=>$date_from, 'date_to'=>$date_to]);
   
    }


    //function to delete a message
    public function deleteMessage(Request $request){


        //get the message id
        $message_id = $request->input('message_id');

        $delete = DB::table('mailtostudentmessages')->where('message_id', $message_id)->delete();

        if($delete == 1){
            $request->session()->flash('message_deleted', 'One message has been deleted successfully');
            return redirect('/communications/general/report');
        } else{
            $request->session()->flash('message_not_deleted', 'Failed to delete the message');
            return redirect('/communications/general/report');
        }
    }
}
