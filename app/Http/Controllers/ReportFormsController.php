<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportFormsController extends Controller
{
    //

    public function getReportForms($class_name){

        //get the academic year, term and exam type
        //get the year, term and exam type
        $period = $this->getPeriod();

        $year = $period[0];
        $month = $period[1];
        $term = $period[2];
        $exam_type = $period[3];




    }

       //function that gets the time period
       public function getPeriod(){

        //get the academic year, term and exam type
        //get the year, term and exam type
        $year = date("Y");
        $month = date("m");
        $term;
        $exam_type;

       if($month >= 1 && $month <= 4){
           $term = 1;
           if($month == 1){
               $exam_type = "Opener";
           }
           else if($month == 2){
               $exam_type = "Mid term";
           }
           else if($month == 3 || $month == 4){
               $exam_type = "End term";
           }
       }
       else if($month >= 5 && $month <= 8){
           $term = 2;
           if($month == 5){
               $exam_type = "Opener";
           }
           else if($month == 6){
               $exam_type = "Mid term";
           }
           else if($month == 7 || $month == 8){
               $exam_type = "End term";
           }
       } 
       else if($month >= 9 && $month <= 12){
           $term = 3;
           if($month == 9){
               $exam_type = "Opener";
           }
           else if($month == 10){
               $exam_type = "Mid term";
           }
           else if($month == 11 || $month == 12){
               $exam_type = "End term";
           }
       }

       return array($year, $month, $term, $exam_type);

    }
}
