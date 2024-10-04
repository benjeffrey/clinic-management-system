<?php

$servername = "localhost";  
$username = "root";  
$password = ""; 

$database = "cae_clinic"; 

 // Create a connection  
 $conn = mysqli_connect($servername,  
     $username, $password, $database); 
if($conn){
    //echo "connected";
}else die("Error". mysqli_connect_error()); 