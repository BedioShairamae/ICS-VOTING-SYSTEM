<?php

$servername = "localhost";
    $username = "u868455901_iscvs";
    $password = "3G9LYA>b";
    $dbname = "u868455901_iscvs";
    
    // Create connection
    $con =mysqli_connect($servername, $username, $password,$dbname);
    
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    } 
else {
 
}
/*
   $servername = "localhost";
    $username = "u940296134_iscuser";
    $password = ";TLMil3Gn";
    $dbname = "u940296134_iscvsdb";
    
    // Create connection
    $con =mysqli_connect($servername, $username, $password,$dbname);
    
    // Check connection
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    } 
else {
 
}


*/
?>
