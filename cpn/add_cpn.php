<?php
include './../conn.php';
session_start();

 // Create a PHPMailer object
//  use PHPMailer\PHPMailer\PHPMailer;
//  use PHPMailer\PHPMailer\Exception;

if(isset($_POST['modifier'])){
    $patient = $_GET['patient'];
    $cpn = $_GET['id'];

    $doc = $_POST['doc'];
    $EG = $_POST['EG'];
    $conj = $_POST['conj'];
    $ES = $_POST['ES'];
    $abdomen = $_POST['abdomen'];
    $HU = $_POST['HU'];
    $CA = $_POST['CA'];
    $MAF = $_POST['MAF'];
    $BDCF = $_POST['BDCF'];
    $plaintes = $_POST['plaintes'];
    $TV = $_POST['TV'];
    $RE = $_POST['RE'];
    $conclusion = $_POST['conc'];
    $oedem = $_POST['oedem'];

  $sql = "UPDATE cpn SET doc_name='$doc', EG='$EG', conj='$conj', ES='$ES', abdomen='$abdomen', HU='$HU', CA='$CA', MAF='$MAF', BDCF='$BDCF', plaintes='$plaintes', TV='$TV',RE='$RE',conclusion='$conclusion',oedem='$oedem', date=CURDATE(), heure=CURTIME() where cpn_id=$cpn";
  $result = mysqli_query($conn,$sql);
  if($result){
      $_SESSION['modifier_cpn'] = '<div class="flex items-center p-4 text-green-800 rounded-lg bg-green-50 w-12/12 mx-auto my-4" role="alert">
      <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
      </svg>
      <span class="sr-only">Info</span>
      <div class="ms-3 text-sm font-medium">CPN Modifie Avec Succes !</div>
      <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 " data-dismiss-target="#alert-3" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
      </button>
  </div>';

      header('Location: modifier_cpn.php?id='.$patient.'&cpn='.$cpn.'');
  }
}



elseif(isset($_POST['ajouter'])){

    $p_id = $_GET['id2'];
    // $temp = $_POST['temp'];
    $doc = $_POST['doc'];
    $EG = $_POST['EG'];
    $conj = $_POST['conj'];
    $ES = $_POST['ES'];
    $abdomen = $_POST['abdomen'];
    $HU = $_POST['HU'];
    $CA = $_POST['CA'];
    $MAF = $_POST['MAF'];
    $BDCF = $_POST['BDCF'];
    $plaintes = $_POST['plaintes'];
    $TV = $_POST['TV'];
    $RE = $_POST['RE'];
    $conclusion = $_POST['conc'];
    $oedem = $_POST['oedem'];
    
    $sql = "insert into cpn (p_id, doc_name, EG, conj, ES, abdomen, HU, CA, MAF, BDCF, plaintes, TV, RE, conclusion, oedem) values ('$p_id', '$doc', '$EG', '$conj', '$ES', '$abdomen', '$HU', '$CA', '$MAF', '$BDCF', '$plaintes', '$TV', '$RE','$conclusion', '$oedem')";
    $result = mysqli_query($conn,$sql);
    if($result){
        $_SESSION['ajoute_cpn'] = '<div class="flex items-center p-4 text-green-800 rounded-lg bg-green-50 w-12/12 mx-auto my-4" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">Parametre Ajoute Avec Succes !</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 " data-dismiss-target="#alert-3" aria-label="Close">
          <span class="sr-only">Close</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
        </button>
    </div>';

    header('Location: ajouter_cpn.php?id='.$p_id.'');
  }
}