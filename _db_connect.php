<?php

$hostname = "localhost";
$username = "root";
$password = "";
$database = "Employee";

mysqli_report(MYSQLI_REPORT_OFF);
/* @ is used to suppress warnings */
$conn = @mysqli_connect($hostname, $username , $password , $database);
if (!$conn) {
    /* Use your preferred error logging method here */
    error_log('Connection error: ' . mysqli_connect_error());
    echo "Error" ;
}





?>