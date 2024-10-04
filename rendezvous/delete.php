<?php
include './../conn.php';
session_start();

if(isset($_GET['what'])){
    if($_GET['what'] == 'app'){
        $status = $_GET['status'];
        $id = $_GET['id'];
        $get = "select * from appointment where a_id = $id";
        $result_g = mysqli_query($conn, $get);
        $h = mysqli_fetch_assoc($result_g);

        $patient = $h['patient'];
        $tel = $h['tel'];
        $doc = $h['nom'];
        $raison = $h['patient'];
        $date = $h['date'];

        // save to history first
        $save = "insert into historique (patient, tel, nom, raison, date, status) values ('$patient','$tel', '$doc', '$raison', '$date', '$status' )";
        $result_s = mysqli_query($conn, $save);

        // delete appointment
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