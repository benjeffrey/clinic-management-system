<?php
include './conn.php';
session_start();

$email = $_POST["email"];
$pwd = $_POST["mdp"];

$sql = "select * from user where email = '$email' and password = '$pwd'";

$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if(mysqli_num_rows($result)>0){
    $_SESSION['logined'] = $user['email'];
    if($_SESSION['logined'] == 'acceuil@cae.com') header("location:./acceuil/index.php");
    elseif($_SESSION['logined'] == 'visite@cae.com') header("location:./visite/index.php");
}else{
    $_SESSION['error'] = "Mauvais email ou mot de pass";
    header("location:login.php");
} 