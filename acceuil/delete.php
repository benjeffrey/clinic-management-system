<?php
include './../conn.php';
session_start();

if(isset($_GET['what'])){
    if($_GET['what'] == 'param'){
        $id = $_GET['p'];
        $patient_id = $_GET['patient'];
        $sql = "delete from parametre where par_id = $id";
        $result = mysqli_query($conn, $sql);
        header('location:patient.php?id='.$patient_id.'');
    }
    if($_GET['what'] == 'patient'){
        $patient_id = $_GET['p_id'];
        $sql = "delete from patient where p_id = $patient_id";
        $result = mysqli_query($conn, $sql);
        header('location:liste.php');
    }
}