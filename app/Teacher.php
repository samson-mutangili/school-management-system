<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //define table to be used
    protected $table = 'teachers';

    //function to return teacher's roles and responsibilities
    function teacher_roles_and_responsibilities(){
        return $this->hasOne('App\Roles_and_responsibilities', 'teacher_id', 'id');
    }

    //function that return the classes that the teacher teaches
    function myClasses(){
        return $this->hasMany('App\Teacher_classes', 'teacher_id', 'id');
    }
}
