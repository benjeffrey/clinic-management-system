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
    $age = $_POST['age'];
    $assu = $_POST['assu'];

    // generer code
    $un = $nom[0];
    $deux = substr($DOB, 8, 2);
    $trois = substr($DOB, 5, 2);
    $quatre = substr($DOB, 2, 2);
    $cinq = $prenom[0];
    $code = $un . $deux . $trois . $quatre . $cinq;
    $code = strtoupper($code);
    
    $sql = "UPDATE patient SET nom='$nom', prenom='$prenom', sex='$sex', quartier='$quartier', profession='$profession', tel='$tel', SM='$SM', religion='$rel', DOB='$DOB', POB='$POB', age='$age', assurance='$assu', code='$code', date=CURDATE(), heure=CURTIME() where p_id=$patient_id";
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

if(isset($_POST['patient'])){
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
    $age = $_POST['age'];
    $assu = $_POST['assu'];

    // generer code
    $un = $nom[0];
    $deux = substr($DOB, 8, 2);
    $trois = substr($DOB, 5, 2);
    $quatre = substr($DOB, 2, 2);
    $cinq = $prenom[0];
    $code = $un . $deux . $trois . $quatre . $cinq;
    $code = strtoupper($code);
    $code = strtoupper($code);

    $sql = "insert into patient (nom, prenom, sex, quartier, profession, tel, SM, religion, DOB, POB, age, assurance, code) values ('$nom', '$prenom', '$sex', '$quartier', '$profession', '$tel', '$SM', '$rel', '$DOB', '$POB', '$age', '$assu', '$code')";
    $result = mysqli_query($conn,$sql);
    if($result){
        $_SESSION['ajoute_patient'] = '<div class="flex items-center p-4 text-green-800 rounded-lg bg-green-50 w-12/12 mx-auto my-4" role="alert">
        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div class="ms-3 text-sm font-medium">Patient Ajoute avec succes !</div>
        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 " data-dismiss-target="#alert-3" aria-label="Close">
          <span class="sr-only">Close</span>
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
        </button>
    </div>';

        // // SMTP server configuration
        // $smtpHost = 'smtp.gmail.com';
        // $smtpPort = 465; // Use the appropriate port for your SMTP server (e.g., 587 for TLS/STARTTLS, 465 for SSL)
        // $smtpUsername = 'w.t.b.jeffrey@gmail.com';
        // $smtpPassword = '29MAI2003.';

        // // Collect booking information
        // $name = $_POST['name'];
        // $email = $_POST['email'];
        // $hair = $_POST['hair'];
        // $date = $_POST['date'];
        // $time = $_POST['time'];

        // // Compose email content
        // $subject = "Booking Confirmation Email";
        // $message = "Dear $name,\n\nThank you for booking with us. On the $date at $time\n\nRegards,\nAKWABA Hair Braiding";

        // // Set up email headers
        // $headers = "From: w.t.b.jeffrey@gmail.com\r\n";
        // $headers .= "Reply-To: bben10tenison@gmail.com\r\n";
        // $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        // // SMTP authentication
        // $smtpAuth = true;


        // require 'PHPMailer/src/Exception.php';
        // require 'PHPMailer/src/PHPMailer.php';
        // require 'PHPMailer/src/SMTP.php';
        // // require 'PHPMailer/PHPMailerAutoload.php';
        // $mail = new PHPMailer;

        // // SMTP configuration
        // $mail->isSMTP();
        // $mail->Host = $smtpHost;
        // $mail->Port = $smtpPort;
        // $mail->SMTPAuth = $smtpAuth;
        // $mail->Username = $smtpUsername;
        // $mail->Password = $smtpPassword;
        // $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, 'ssl' also accepted

        // // Send email
        // $mail->setFrom('w.t.b.jeffrey@gmail.com', 'AKWABA Hair Braiding');
        // $mail->addAddress($email, $name);
        // $mail->Subject = $subject;
        // $mail->Body = $message;
        // if($mail->send()){
        //     echo 'email sent';
        // }else echo 'error sending';


        header('Location: ajouter.php');
    }
}