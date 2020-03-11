@extends('layouts.dashboard')


@section('content')

<?php

//database credentials
$DB_SERVER =  "localhost";
$DB_USERNAME = "root";
$DB_PASSWORD = "";
$DB_NAME = "school_management_system";
 
/* Attempt to connect to MySQL database */
$db = mysqli_connect($DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
 
// Check connection
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} else {
    echo 'connected successfully';
}
    
?>
    
@endsection