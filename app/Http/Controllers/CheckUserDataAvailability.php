<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


class CheckUserDataAvailability extends Controller
{
    //

    function checkParentIDNo(Request $request){
        if($request->get('id_no') ){
            $parent_id_no = $request->get('id_no');
            $data = DB::table('parents')->where('id_no', $parent_id_no)->count();

            if($data > 0){
                echo 'not_unique';
            } else{
                echo 'unique';
            }
        } else{
               
        }
    }
}
