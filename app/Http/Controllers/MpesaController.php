<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MpesaController extends Controller
{
    //
    public function generateAccessToken()
    {
        //define consumer key and secret key
        $consumer_key="rcYMz3oVW1Qe07jKAYievBHS3dQzGKap";
        $consumer_secret="V3pwXUr2OQobxAB8";
        //use base64 to combine the consumer key and they secret key
        $credentials = base64_encode($consumer_key.":".$consumer_secret);

        //generate access token
        $url = "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Authorization: Basic ".$credentials, "Content-Type:application/json"));
        curl_setopt($curl, CURLOPT_HEADER,false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //define variable to pass to from safaricom API
        $curl_response = curl_exec($curl);
        //we use json_decode to convert a JSON object to a php object.
        $access_token=json_decode($curl_response);
        //we access our generated M-pesa access token.
        return $access_token->access_token;
    }
}
