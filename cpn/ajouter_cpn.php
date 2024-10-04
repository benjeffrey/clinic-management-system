<?php
include './../conn.php';
session_start();
if(!isset($_SESSION['logined'])){
    $_SESSION['error'] = 'login dabord !';
    header("location:./../login.php");
}

if(isset($_GET['id']) && $_GET['id']!=''){
    $id = $_GET['id'];
    // echo $id;
}else header("location:liste.php");

$sql = "select * from patient where p_id = $id";

    $i=0;
    $result = mysqli_query($conn, $sql);
    $p = mysqli_fetch_assoc($result);


    $sql_doc = "select * from docteurs";
    $result_doc = mysqli_query($conn, $sql_doc);
    $total_doc = mysqli_num_rows($result_doc);
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
                            <a href="./" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-green-500">
                                <i class="fas fa-chart-area pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">DASHBOARD</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="./liste.php" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">
                                <i class="fas fa-tasks pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">LISTE PATIENTS</span>
                            </a>
                        </li>
                        <!-- <li class="mr-3 flex-1">
                            <a href="./ajouter.php" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-blue-600">
                                <i class="fas fa-user-plus fa-inverse pr-0 md:pr-3 text-blue-600"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">AJOUTER</span>
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
                        <h1 class="font-bold pl-2">Nouvelle Consultation prenatale de: <?=$p['nom']?></h1>
                    </div>
                </div>

                <!-- tryyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyyy -->
                <div class="flex flex-wrap -mx-3 mb-5">
                    <div class="w-full max-w-full px-3 mb-6  mx-auto">
                        <div class="relative flex-[1_auto] flex flex-col break-words min-w-0 bg-clip-border rounded-[.95rem] bg-white m-5">
                        <div class="relative flex flex-col min-w-0 break-words border border-dashed bg-clip-border rounded-2xl border-stone-200 bg-light/30">
                            <!-- card header -->
                            <!-- end card header -->
                            <!-- form -->
                            <form name="ajouter" method="POST" action="add_cpn.php?id2=<?=$id?>">
                            <div class="space-y-12 p-10">
                                <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base font-semibold leading-7 text-gray-900">Nouvelle Consultationde Prenatale de: <a class="text-blue-600" href="patient.php?id=<?=$p['p_id']?>"><?=$p['nom']?></a></h2>

                                <div class="w-full my-3">
                                    <label for="doc" class="block text-sm font-medium leading-6 text-gray-900">Consultation par Docteur...*</label>
                                    <select name="doc" id="doc" class="w-1/2 ml-auto mr-auto p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" disabled selected hidden>Choisir...</option>
                                        <?php
                                        while($d = mysqli_fetch_assoc($result_doc)){
                                            echo "<option value='".$d['nom']."'>".$d['nom']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <p class="mt-1 text-sm leading-6 text-gray-600">Remplir les infos de la consultation du patient <a href="patient.php?id=<?=$id?>" class="text-blue-600"><?=$p['nom']?></a> pour la journee du <?=date('d/m/y')?>.</p>
                                <?php
                                    if(isset($_SESSION['ajoute_cpn'])){
                                        echo $_SESSION['ajoute_cpn'];
                                        unset($_SESSION['ajoute_cpn']);
                                    }
                                ?>

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                                    <div class="col-span-full">
                                    <label for="EG" class="block text-sm font-medium leading-6 text-gray-900">Etat General*</label>
                                    <div class="mt-2">
                                        <textarea required id="EG" name="EG" rows="3" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                    </div>
                                    <p class="mt-1 text-sm leading-6 text-gray-600">Etat General du patient</p>
                                    </div>    
                                </div>
                                <!-- hr line femme enceinte -->
                                <div class="inline-flex items-center justify-center w-full">
                                    <hr class="w-full h-px my-10 bg-red-300 border-0 dark:bg-red-200">
                                    <span class="absolute px-2 font-medium text-red-500 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-900">EXAMENS PHYSIQUE</span>
                                </div>
                                <!-- end hr line -->
                                <div class="mt-1 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-6">
                                    <div class="col-span-full">
                                        <label for="conj" class="block text-sm font-medium leading-6 text-gray-900">Conjonctive*</label>
                                        <div class="mt-2">
                                            <textarea required id="conj" name="conj" rows="3" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-full">
                                        <label for="ES" class="block text-sm font-medium leading-6 text-gray-900">Etat Seins*</label>
                                        <div class="mt-2">
                                            <textarea required id="ES" name="ES" rows="3" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-full">
                                        <label for="abdomen" class="block text-sm font-medium leading-6 text-gray-900">Abdomen*</label>
                                        <div class="mt-2">
                                            <textarea required id="abdomen" name="abdomen" rows="3" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-full">
                                        <label for="HU" class="block text-sm font-medium leading-6 text-gray-900">Hauteur Uterine*</label>
                                        <div class="mt-2">
                                            <textarea required id="HU" name="HU" rows="3" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-full">
                                        <label for="CA" class="block text-sm font-medium leading-6 text-gray-900">Circonference Abdominale*</label>
                                        <div class="mt-2">
                                            <textarea required id="CA" name="CA" rows="3" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-full">
                                        <label for="MAF" class="block text-sm font-medium leading-6 text-gray-900">Mouvement actifs fœtal*</label>
                                        <div class="mt-2">
                                            <textarea required id="MAF" name="MAF" rows="3" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-full">
                                        <label for="BDCF" class="block text-sm font-medium leading-6 text-gray-900">Battement de Coeur Fœtal*</label>
                                        <div class="mt-2">
                                            <textarea required id="BDCF" name="BDCF" rows="3" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                        </div>
                                    </div>

                                    <hr class="col-span-full bg-red-300 h-px border-0">

                                    <div class="col-span-full">
                                        <label for="plaintes" class="block text-sm font-medium leading-6 text-gray-900">Plaintes*</label>
                                        <div class="mt-2">
                                            <textarea required id="plaintes" name="plaintes" rows="3" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-full">
                                        <label for="TV" class="block text-sm font-medium leading-6 text-gray-900">Touchee vaginale*</label>
                                        <div class="mt-2">
                                            <textarea required id="TV" name="TV" rows="4" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                        </div>
                                    </div>

                                    <label for="small" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Oedeme?</label>
                                    </div>
                                    <div class="w-full">
                                    <select name="oedem" id="small" class="w-1/2 ml-auto mr-auto p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected>Choisir...</option>
                                        <option value="oui">OUI</option>
                                        <option value="non">NON</option>
                                    </select>
                                

                                    <div class="col-span-full">
                                        <label for="RE" class="block text-sm font-medium leading-6 text-red-400">Resultats echographie*</label>
                                        <div class="mt-2">
                                            <textarea required id="RE" name="RE" rows="3" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-span-full">
                                        <label for="conc" class="block text-sm font-medium leading-6 text-red-400">Conclusion*</label>
                                        <div class="mt-2">
                                            <textarea required id="conc" name="conc" rows="3" class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
                                        </div>
                                    </div>

                                

                                </div>

                            </div>

                            <div class="mt-3 flex items-center justify-end gap-x-6">
                                <button name="ajouter" type="submit" class="rounded-md bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Ajouter</button>
                            </div>
                            </form>

                            <!-- end form -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>




<script>
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
