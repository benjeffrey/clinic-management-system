<?php
include './../conn.php';
session_start();

 // Create a PHPMailer object
//  use PHPMailer\PHPMailer\PHPMailer;
//  use PHPMailer\PHPMailer\Exception;

if(isset($_POST['modifier'])){
  // $nom = $_POST['nom'];
  // $prenom = $_POST['prenom'];
  // $sex = $_POST['sex'];
  // $qaurtier = $_POST['qaurtier'];
  // $profession = $_POST['profession'];
  // $tel = $_POST['tel'];

  // if(isset($_GET['patient']) && isset($_GET['id']) && $_GET['patient']!='' && $_GET['id']!=''){
    $patient = $_GET['patient'];
    $cons_id = $_GET['id'];
  // }

    $doc = $_POST['doc'];
    $motif = $_POST['motif'];
    $histoire = $_POST['histoire'];

    $AM = $_POST['AM'];
    $AI = $_POST['AI'];
    $AT = $_POST['AT'];
    $AO = $_POST['AO'];
    $AE = $_POST['AE'];
    $AP = $_POST['AP'];
    $AF = $_POST['AF'];

    $enquete = $_POST['enquete'];
    $EP = $_POST['EP'];
    $diag = $_POST['diag'];
    $bilan = $_POST['bilan'];
    $traitement = $_POST['traitement'];

  $sql = "UPDATE consultations SET doc_name='$doc', motif='$motif', histoire='$histoire', AM='$AM', AI='$AI', AT='$AT', AO='$AO', AE='$AE', AP='$AP', AF='$AF', enquete='$enquete', EP='$EP', diag='$diag', bilan='$bilan', traitement='$traitement', date=CURDATE(), heure=CURTIME() where cons_id=$cons_id";
  $result = mysqli_query($conn,$sql);
  if($result){
      $_SESSION['modifier_cons'] = '<div class="flex items-center p-4 text-green-800 rounded-lg bg-green-50 w-12/12 mx-auto my-4" role="alert">
      <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
      </svg>
      <span class="sr-only">Info</span>
      <div class="ms-3 text-sm font-medium">Consultation Modifie Avec Succes !</div>
      <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 " data-dismiss-target="#alert-3" aria-label="Close">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
        </svg>
      </button>
  </div>';

      header('Location: modifier_cons.php?id='.$patient.'&cons='.$cons_id.'');
  }
}



elseif(isset($_POST['ajouter'])){
    $p_id = $_GET['id2'];

    $doc = $_POST['doc'];
    $motif = $_POST['motif'];
    $histoire = $_POST['histoire'];

    $AM = $_POST['AM'];
    $AI = $_POST['AI'];
    $AT = $_POST['AT'];
    $AO = $_POST['AO'];
    $AE = $_POST['AE'];
    $AP = $_POST['AP'];
    $AF = $_POST['AF'];

    $enquete = $_POST['enquete'];
    $EP = $_POST['EP'];
    $diag = $_POST['diag'];
    $bilan = $_POST['bilan'];
    $traitement = $_POST['traitement'];

    $sql = "insert into consultations (p_id, doc_name, motif, histoire, AM, AI, AT, AO, AE, AP, AF, enquete, EP, diag, bilan, traitement) values ($p_id, '$doc', '$motif', '$histoire', '$AM', '$AI', '$AT', '$AO', '$AE', '$AP', '$AF', '$enquete', '$EP', '$diag', '$bilan', '$traitement')";
    $result = mysqli_query($conn,$sql);
    if($result){
        $_SESSION['ajoute_cons'] = '<div class="flex items-center p-4 text-green-800 rounded-lg bg-green-50 w-12/12 mx-auto my-4" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium"> Consultation ajoute Avec Succes !</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 " data-dismiss-target="#alert-3" aria-label="Close">
          <span class="sr-only">Close</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
        </button>
    </div>';

        header('Location: ajouter_cons.php?id='.$p_id.'');
    }
}