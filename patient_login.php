<?php
include './conn.php';
session_start();

$code = $_POST["code"];

$sql = "select * from patient where code = '$code'";

$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result)>0){
    $_SESSION['patient'] = $user['nom'];
    $_SESSION['patient2'] = $user['prenom'];
    $_SESSION['tel'] = $user['tel'];

    header('location:./patient/');
}else{
    $_SESSION['error'] = "Le code etre ne correspond pas...";
    header("location:patient.php");
} 