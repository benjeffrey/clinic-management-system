<?php
include './../conn.php';
session_start();

if(isset($_GET['what'])){
    if($_GET['what'] == 'app'){
        $id = $_GET['id'];
        $sql = "delete from appointment where a_id = $id";
        $result = mysqli_query($conn, $sql);
        header('location:rendezvous.php?id='.$patient_id.'');
    }
    // if($_GET['what'] == 'patient'){
    //     $patient_id = $_GET['p_id'];
    //     $sql = "delete from patient where p_id = $patient_id";
    //     $result = mysqli_query($conn, $sql);
    //     header('location:liste.php');
    // }
}