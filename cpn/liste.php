<?php
include './../conn.php';
session_start();
if(!isset($_SESSION['logined'])){
    $_SESSION['error'] = 'login dabord !';
    header("location:./../login.php");
}

$sql = "select * from patient order by p_id desc";
// echo $sql;
    $i=0;
    $result = mysqli_query($conn, $sql);
    $t_p = mysqli_num_rows($result);
    // var_dump($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CAE - DASHBOARD</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/> <!--Replace with your tailwind.css once created-->
    <!-- <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet"> Totally optional :) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12">

<header>
    <!--Nav-->
    <nav aria-label="menu nav" class="bg-gray-800 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">

        <div class="flex flex-wrap items-center">
            <div class="flex flex-shrink md:w-1/3 justify-center md:justify-start text-white">
                
            </div>

            <div class="flex flex-1 md:w-1/3 justify-center md:justify-start text-white px-2">
                <span class="relative w-full">
                    <form action="search.php" method="post">
                        <input aria-label="search" name="word" type="search" id="search" placeholder="Rechercher Patient..." class="w-full bg-gray-900 text-white transition border border-transparent focus:outline-none focus:border-gray-400 rounded py-3 px-2 pl-10 appearance-none leading-normal">
                        <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-800 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
                    </form>
                    <div class="absolute search-icon" style="top: 1rem; left: .8rem;">
                        <svg class="fill-current pointer-events-none text-white w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M12.9 14.32a8 8 0 1 1 1.41-1.41l5.35 5.33-1.42 1.42-5.33-5.34zM8 14A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"></path>
                        </svg>
                    </div>
                </span>
            </div>

            <div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
                <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
                    
                    <li class="flex-1 md:flex-none md:mr-3">
                        <div class="relative inline-block">
                            <button onclick="toggleDD('myDropdown')" class="drop-button text-white py-2 px-2"> <span class="pr-2"><i class="em em-robot_face"></i></span> CPN <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg></button>
                            <div id="myDropdown" class="dropdownlist absolute bg-gray-800 text-white right-0 mt-3 p-3 overflow-auto z-30 invisible">
                                <div class="border border-gray-800"></div>
                                <a href="./../acceuil/index.php" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block">ACCEUIL</a>
                                <a href="./../docteur/index.php" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block">DOCTEUR</a>


<a href="./../cpn/index.php" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block">CPN</a><a href="./../rendezvous/index.php" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block">RENDEZ-VOUS</a>
                                                                <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block">LABO</a>                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
</header>


<main>

    <div class="flex flex-col md:flex-row">
        <nav aria-label="alternative nav">
            <div class="bg-gray-800 shadow-xl h-20 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48 content-center">

                <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                    <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left">
                        <li class="mr-3 flex-1">
                            <a href="./" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-blue-500">
                                <i class="fas fa-chart-area pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">DASHBOARD</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="./liste.php" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-pink-600">
                                <i class="fas fa-tasks pr-0 md:pr-3 text-pink-600"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">LISTE PATIENTS</span>
                            </a>
                        </li>
                        <!-- <li class="mr-3 flex-1">
                            <a href="./ajouter.php" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-green-500">
                                <i class="fas fa-user-plus fa-inverse pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">AJOUTER</span>
                            </a>
                        </li> -->
                        
                        <li class="mr-3 flex-1">
                            <a onclick="return logout();" href="./../logout.php" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-red-500">
                                <i class="fas fa-sign-out-alt fa-fw pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">LOGOUT</span>
                            </a>
                        </li>
                    </ul>
                </div>


            </div>
        </nav>
        <section class="w-full">
            <div id="main" class="main-content w-full flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">

                <div class="bg-gray-800 pt-3">
                    <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
                        <h1 class="font-bold pl-2">LISTE DES PATIENTS INSCRITS</h1>
                    </div>
                </div>

                
                <!-- tryyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy -->
                <div class="flex flex-wrap -mx-3 mb-5">
                    <div class="w-full max-w-full px-3 mb-6  mx-auto">
                        <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
                        <div class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
                            <!-- card header -->
                            <div class="px-9 pt-5 flex justify-between items-stretch flex-wrap min-h-[70px] pb-0 bg-transparent">
                            <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl/tight text-dark">
                                <span class="mr-3 font-semibold text-dark">liste des patients de l'hopital</span>
                                <span class="mt-1 font-medium text-secondary-dark text-lg/normal">liste complète (<?=$t_p?>) patients</span>
                            </h3>
                            </div>
                            <!-- end card header -->
                            <!-- card body  -->
                            <div class="flex-auto block py-8 pt-6 px-9">
                            <div class="overflow-x-auto">
                                <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-[0.95rem] text-secondary-dark">
                                    <th class="text-left pl-5 pb-3 min-w-[170px]">NOM</th>
                                    <th class="text-left pl-5 pb-3 min-w-[100px]">tel</th>
                                    <th class="text-left pl-5 pb-3 min-w-[100px]">SEX</th>
                                    <th class="text-left pl-5 pb-3 min-w-[100px]">AGE</th>
                                    <th class="text-left pl-5 pb-3 pr-12 min-w-[100px]">PROFESSION</th>
                                    <!-- <th class="text-left pl-5 pb-3 min-w-[50px]">ACTION</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($p = mysqli_fetch_assoc($result)){
                                    $i++;
                                    echo '<tr class="border-b border-dashed last:border-b-0">';
                                    echo '<td class="px-4 py-3 whitespace-nowrap"><a href="patient.php?id='.$p['p_id'].'">'.$p['nom'].' '.$p['prenom'].'</a></td>';
                                    echo '<td class="px-4 py-3 whitespace-nowrap"><a href="patient.php?id='.$p['p_id'].'">'.$p['tel'].'</a></td>';
                                    echo '<td class="px-4 py-3 whitespace-nowrap"><a href="patient.php?id='.$p['p_id'].'">'.$p['sex'] .'</a></td>';
                                    echo '<td class="px-4 py-3 whitespace-nowrap"><a href="patient.php?id='.$p['p_id'].'">'.$p['age'] .'</a></td>';
                                    echo '<td class="px-4 py-3 whitespace-nowrap"><a href="patient.php?id='.$p['p_id'].'">'.$p['profession'] .'</a></td>';
                                    // echo '<td class="px-3 py-3 whitespace-nowrap">';
                                    // echo '<a class="color-blue-200" href="modifier.php?mod='.$p['p_id'].'"><button class="bg-blue-500 text-white font-bold mr-3 py-1 px-4 rounded"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>';
                                    // echo '<a onclick="return del();" class="color-blue-200" href="delete.php?what=patient&p_id='.$p['p_id'].'"><button class="bg-red-400 text-white font-bold py-1 px-4 rounded"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>';
                                    // echo '</td>';
                                    echo '</tr>';
                                    } 
                                    if($t_p == 0){
                                        echo '<tr>
                                        <td colspan="5">
                                        <br><br><br><br>
                                        <center>
                                        <img src="../img/notfound.svg" width="10%">
                                        
                                        <br>
                                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Pas de patient pour le moment...</p>
                                        </a>
                                        </center>
                                        <br><br><br><br>
                                        </td>
                                        </tr>';
                                    }
                                    ?>
                                    
                                    
                                    
                                </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>




<script>

    function del(){
        return confirm("Confirmer Suppression?");
    }
    function link(id){
        windows.location='index.php?id='+id+'';
    }
    function logout(){
        return confirm("est-tu sure?");
    }
    /*Toggle dropdown list*/
    function toggleDD(myDropMenu) {
        document.getElementById(myDropMenu).classList.toggle("invisible");
    }
    /*Filter dropdown options*/
    function filterDD(myDropMenu, myDropMenuSearch) {
        var input, filter, ul, li, a, i;
        input = document.getElementById(myDropMenuSearch);
        filter = input.value.toUpperCase();
        div = document.getElementById(myDropMenu);
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
            var dropdowns = document.getElementsByClassName("dropdownlist");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains('invisible')) {
                    openDropdown.classList.add('invisible');
                }
            }
        }
    }
</script>


</body>

</html>
