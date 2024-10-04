<?php
include './../conn.php';
session_start();

 // Create a PHPMailer object
//  use PHPMailer\PHPMailer\PHPMailer;
//  use PHPMailer\PHPMailer\Exception;

// 
if(isset($_POST['modifier'])){
  if(isset($_GET['mod'])){
    $patient_id = $_GET['mod'];
  }
    // echo'okay';
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $sex = $_POST['sex'];
    $quartier = $_POST['quartier'];
    $profession = $_POST['profession'];
    $tel = $_POST['tel'];
    $SM = $_POST['SM'];
    $rel = $_POST['rel'];
    $DOB = $_POST['DOB'];
    $POB = $_POST['POB'];
    // $temp = $_POST['temp'];
    $age = $_POST['age'];
    // $TA = $_POST['TA'];
    // $poids = $_POST['poids'];
    // $pouls = $_POST['pouls'];
    // $raison = $_POST['raison'];
    
    $sql = "UPDATE patient SET nom='$nom', prenom='$prenom', sex='$sex', quartier='$quartier', profession='$profession', tel='$tel', SM='$SM', religion='$rel', DOB='$DOB', POB='$POB', age='$age', date=CURDATE(), heure=CURTIME() where p_id=$patient_id";
    $result = mysqli_query($conn,$sql);
    if($result){
        
        $_SESSION['modif_patient'] = '<div class="flex items-center p-4 text-green-800 rounded-lg bg-green-50 w-12/12 mx-auto my-4" role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">Patient Modifie avec succes !</div>
            <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 " data-dismiss-target="#alert-3" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            </button>
        </div>';
        header('location:modifier.php?mod='.$patient_id.'');
        // echo'yes';\
    }
}

  
        // header('Location: modifier.php?mod='.$_GET["mod"].'');
// }

if(isset($_POST['book'])){
    $date = $_POST['date'];
    $raison = $_POST['raison'];

    $pat_id = $_GET['pat'];
    $pat_name = $_SESSION['patient'];
    $tel = $_SESSION['tel'];
    $doc_id = $_GET['doc'];
    $doc_name = $_GET['doc_name']; 
    $sql = "insert into appointment (pat_id, patient, tel, nom, raison, date) values ($pat_id, '$pat_name', '$tel', '$doc_name', '$raison', '$date')";
    $result = mysqli_query($conn,$sql);
    if($result){
        $_SESSION['ajoute_book'] = '<div class="flex items-center p-4 text-green-800 rounded-lg bg-green-50 w-12/12 mx-auto my-4" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">Rendez-vous Enregistre avec succes !</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 " data-dismiss-target="#alert-3" aria-label="Close">
          <span class="sr-only">Close</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
        </button>
    </div>';


        header("Location: book.php?doc=$doc_id");
    }
}