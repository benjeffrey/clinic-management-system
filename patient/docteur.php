<?php
include './../conn.php';
session_start();
if(!isset($_SESSION['patient'])){
    $_SESSION['error'] = 'Entrez dabord vos infos!';
    header("location:./../patient.php");
}
$patient = $_SESSION['patient'];
$nom = $_SESSION['patient'];

if(isset($_GET['id']) && $_GET['id']!=''){
    $id = $_GET['id'];
    // echo $id;
}else header("location:liste_docteur.php");

$sql = "select * from docteurs where id = $id";
// $parametre = "select * from parametre where p_id = $id order by par_id desc";

    $i=0;
    $result = mysqli_query($conn, $sql);
    // $param = mysqli_query($conn, $parametre);
    // $total = mysqli_num_rows($param);
    $doc = mysqli_fetch_assoc($result);
    $doc_name = $doc['nom'];
    // var_dump($result);

$dis = "select * from dispo where doc_name = '$doc_name'";
$res = mysqli_query($conn, $dis);
$dispo = mysqli_fetch_assoc($res);
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
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
        .sub-table{
            animation: transitionIn-Y-bottom 0.5s;
        }

        .add-doc-form-container{
            padding: 25px;
            margin-top: 30px;
            
        }
        .btn-primary-soft {
            background-color: #D8EBFA;
            /* border: 1px solid rgba(57, 108, 240, 0.1); */
            color: #1969AA;
            font-weight: 500;
            font-size: 16px;
            border: none;
        }
        .btn{    
            cursor: pointer;
            padding: 8px 20px;
            outline: none;
            text-decoration: none;
            font-size: 15px;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            border-radius: 5px;
            font-family: 'Inter', sans-serif;
        }
        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            opacity: 1;
        }
        .overlay:target {
            visibility: visible;
            opacity: 1;
            
        }
        
        .popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 50%;
            position: relative;
            transition: all 5s ease-in-out;
        }
        
        .popup h2 {
            margin-top: 0;
            color: #333;
        }
        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }
        .popup .close:hover {
            color: var(--primarycolorhover);
        }
        .popup .content {
            max-height: 30%;
            overflow: auto;
        }
        
        @media screen and (max-width: 700px){
            .box{
            width: 70%;
            }
            .popup{
            width: 70%;
            }
        }
    </style>
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
                        <input aria-label="search" name="word" type="search" id="search" placeholder="Rechercher Docteur..." class="w-full bg-gray-900 text-white transition border border-transparent focus:outline-none focus:border-gray-400 rounded py-3 px-2 pl-10 appearance-none leading-normal">
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
                            <button onclick="toggleDD('myDropdown')" class="drop-button text-white py-2 px-2"> <span class="pr-2"><i class="em em-robot_face"></i></span> <?=$nom?> <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg></button>
                            <div id="myDropdown" class="dropdownlist absolute bg-gray-800 text-white right-0 mt-3 p-3 overflow-auto z-30 invisible">
                                <div class="border border-gray-800"></div>
                                <a onclick="return logout();" href="./../logout.php?who=patient" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block">logout</a>
                            </div>
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
                                <i class="fas fa-chart-area pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">ACCEUIL</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="./liste_docteur.php" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-pink-600">
                                <i class="fas fa-tasks pr-0 md:pr-3 text-pink-600"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">LISTE DOCTEUR</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="./rendezvous.php" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-green-500">
                                <i class="fas fa-tasks fa-inverse pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">RENDEZ-VOUS</span>
                            </a>
                        </li>
                        
                        <li class="mr-3 flex-1">
                            <a onclick="return logout();" href="./../logout.php?who=patient" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-red-500">
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
                        <h1 class="uppercase font-bold pl-2">DOCTEUR: <?= $doc['nom']?></h1>
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
                                <span class="mr-3 font-semibold text-dark">infos sur Dr. <span class="uppercase text-blue-600"><?=$doc['nom']?> </span></span>
                            </h3>
                            </div>

                            <!-- other patient infos here -->

                            <div class="w-full p-4 bg-white sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                            <div class="flow-root">
                                    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <li class="py-3 sm:py-4">
                                            <div class="flex items-center">
                                                
                                                <div class="flex-1 min-w-0 ms-4">
                                                    <p class=" uppercase text-lg font-medium text-gray-900 truncate dark:text-white">
                                                        <?=$doc['nom']?>
                                                    </p>
                                                    <p class="text-md text-gray-500 truncate dark:text-gray-400">
                                                        <?=$doc['prenom']?>
                                                    </p>
                                                </div>
                                                <div class="flex-1 min-w-0 ms-4">
                                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                        Specialite
                                                    </p>
                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                        <?=$doc['specialite']?>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <!-- <li class="py-3 sm:py-4">
                                            <div class="flex items-center">
                                                
                                                <div class="flex-1 min-w-0 ms-4">
                                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                        <?=$p['profession']?>
                                                    </p>
                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                        <a href="tel:<?=$p['tel']?>"><?=$p['tel']?></a>
                                                    </p>
                                                </div>
                                                <div class="flex-1 min-w-0 ms-4">
                                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                        <?=$p['SM']?>
                                                    </p>
                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                        <?=$p['religion']?>
                                                    </p>
                                                </div>
                                            </div>
                                        </li> -->
                                        <!-- <li class="py-3 sm:py-4">
                                            <div class="flex items-center">
                                                
                                                <div class="flex-1 min-w-0 ms-4">
                                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                        <?=$p['sex']?>
                                                    </p>
                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                        <?=$p['age']?>
                                                    </p>
                                                </div>
                                                <div class="flex-1 min-w-0 ms-4">
                                                    <p class="text-xs text-gray-400 truncate dark:text-gray-300">
                                                        AAAA/MM/JJ
                                                    </p>
                                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                        <?=$p['DOB']?>
                                                    </p>
                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                        <?=$p['POB']?>
                                                    </p>
                                                </div>
                                            </div>
                                        </li> -->
                                    </ul>
                            </div>
                            </div>

                            
                            <!-- end other  infos -->

                            <div class="px-9 pt-3 flex justify-between items-stretch flex-wrap min-h-[50px] pb-0 bg-transparent">
                            <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl/tight text-dark">
                                <span class="mt-0 font-medium text-secondary-dark text-lg/normal">Dr <?=$doc['nom']?> est disponibles ces jours dans la semaine:</span>
                            </h3>
                            </div>
                            <!-- end card header -->
                            <!-- card body  -->
                            <div class="flex-auto block py-8 pt-6 px-9">
                            <!-- plus button -->
                            
                                <a href="book.php?doc=<?=$id?>&patient=<?=$patient?>" class="my-2 md:my-3 ml-1 align-middle text-white no-underline hover:text-white">
                                    <button class="my-2 bg-blue-500 font-bold py-2 px-5 rounded">
                                        <i class="fas fa-plus pr-0 md:pr-3 text-white"></i>
                                        Prendre Rendez-vous!
                                    </button> 
                                </a>
                            </div>
                            <!-- avail days -->
                            
                            <!-- This example requires Tailwind CSS v2.0+ -->
<div class="flow-root mx-auto my-auto pb-10">
  <ul role="list" class="-mb-8">
    <?php
    if($dispo['lundi'] == 1)
    echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/check -->
              <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Lundi (Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';
    
    else echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/thumb-up -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Lundi (Non Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';

    if($dispo['mardi'] == 1)
    echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/check -->
              <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Mardi (Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';
    
    else echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/thumb-up -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Mardi (Non Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';

    if($dispo['mercredi'] == 1)
    echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/check -->
              <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Mercredi (Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';
    
    else echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/thumb-up -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Mercredi (Non Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';

    if($dispo['jeudi'] == 1)
    echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/check -->
              <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Jeudi (Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';
    
    else echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/thumb-up -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Jeudi (Non Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';

    if($dispo['vendredi'] == 1)
    echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/check -->
              <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Vendredi (Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';
    
    else echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/thumb-up -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Vendredi (Non Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';

    if($dispo['samedi'] == 1)
    echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/check -->
              <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Samedi (Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';
    
    else echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/thumb-up -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Samedi (Non Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';

    if($dispo['dimanche'] == 1)
    echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-grayy-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/check -->
              <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
              </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Dimanche (Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';
    
    else echo'<li>
      <div class="relative pb-8">
        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-grayy-200" aria-hidden="true"></span>
        <div class="relative flex space-x-3">
          <div>
            <span class="h-8 w-8 rounded-full bg-red-500 flex items-center justify-center ring-8 ring-white">
              <!-- Heroicon name: solid/thumb-up -->
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#FFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
            </span>
          </div>
          <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
            <div>
              <p class="text-sm text-gray-500"><span class="font-medium text-gray-900">Dimanche (Non Dispo)</span></p>
            </div>
          </div>
        </div>
      </div>
    </li>';
?>

                            <!--end avail days -->
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
