<?php
include './conn.php';
session_start();

if(isset($_GET['who']) && $_GET['who']=='patient'){
    unset($_SESSION['patient']);
    $_SESSION['error'] = 'you are logged out!';

    header("location:patient.php");
}
else{
    unset($_SESSION['logined']);
    $_SESSION['error'] = 'you are logged out!';
    
    header("location:login.php");
}

