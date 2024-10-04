
<?php
include './conn.php';
session_start();
if(isset($_SESSION['patient'])) header("location:./patient/index.php");
$sql = "select * from patient order by nom";

    $i=0;
    $result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>CAE - PATIENT</title>
</head>
<body>
<section class="bg-gray-50 dark:bg-gray-900">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="./" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
          <img class="w-32 h-auto mr-2" height="auto"  src="./img/logo-clinic.jpg" alt="logo">
      </a>
      <div class="w-full mb-20 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Entrez votre code personnel.
              </h1>
              <form class="space-y-4 md:space-y-6" action="patient_login.php" method="POST">
                  <div>
                      <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Si vous navez pas de code ou avez oublie, veuillez contacter la clinique</label>
                      <!-- <select name="nom" id="nom" class="bg-gray-50 w-full mt-2 p-2 border-solid border border-blue-500 rounded-xl">
                        <option value="" disabled selected hidden>Choisir...</option>
                          <?php
                        //   while($p = mysqli_fetch_assoc($result)){
                        //       echo "<option value='".$p['nom']."'>".$p['nom']." ".$p['prenom']."</option>";
                        //   }
                          ?>
                      </select> -->
                  </div>
                  <div>
                      <label for="code" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Entrez le code qui vous a ete donne a la clinique</label>
                      <input type="texte" name="code" id="code"class="bg-gray-50 border border-blue-500 text-gray-900 sm:text-sm rounded-xl focus:ring-blue-600 focus:border-blue-600 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                  </div>
                  <p class="text-center text-sm font-light text-red-500 dark:text-red-400">
                      <?php
                      if(isset($_SESSION['error'])){
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                      }
                      ?>
                  </p>
                  <button type="submit" class="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                  <label for="toggle" class="text-gray-500 text-center dark:text-gray-300 text-sm">Le code a 8 chiffre</label>
              </form>
          </div>
      </div>
  </div>
</section>


</body>

<script>
function visibility() {
  var x = document.getElementById("pwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

</script>
</html>