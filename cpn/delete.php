<?php
include './../conn.php';
session_start();

if(isset($_GET['what'])){
    if($_GET['what'] == 'cpn'){
        $id = $_GET['c'];
        $patient_id = $_GET['patient'];
        $sql = "delete from cpn where cpn_id = $id";
        $result = mysqli_query($conn, $sql);
        header('location:patient.php?id='.$patient_id.'');
    }
}