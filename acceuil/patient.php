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
$parametre = "select * from parametre where p_id = $id order by par_id desc";

    $i=0;
    $result = mysqli_query($conn, $sql);
    $param = mysqli_query($conn, $parametre);
    $total = mysqli_num_rows($param);
    $p = mysqli_fetch_assoc($result);
    // var_dump($result);

$cons = "select * from consultations where p_id = $id order by cons_id desc";

    $result_cons = mysqli_query($conn, $cons);
    $total_cons = mysqli_num_rows($result_cons);

$pre = "select * from cpn where p_id = $id order by cpn_id desc";

    $result_cpn = mysqli_query($conn, $pre);
    $total_cpn = mysqli_num_rows($result_cpn);


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
                            <button onclick="toggleDD('myDropdown')" class="drop-button text-white py-2 px-2"> <span class="pr-2"><i class="em em-robot_face"></i></span> ACCEUIL <svg class="h-3 fill-current inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
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
                        <li class="mr-3 flex-1">
                            <a href="./ajouter.php" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-green-500">
                                <i class="fas fa-user-plus fa-inverse pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">AJOUTER</span>
                            </a>
                        </li>
                        
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
                        <h1 class="uppercase font-bold pl-2">PATIENT: <?= $p['nom']?></h1>
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
                                <span class="mr-3 font-semibold text-dark">infos sur le patient <a href="modifier.php?mod=<?=$id?>" class="uppercase text-blue-600"><?=$p['nom']?> <i class="fa fa-pencil text-blue-600" aria-hidden="true"></i></a></span>
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
                                                        <?=$p['nom']?>
                                                    </p>
                                                    <p class="text-md text-gray-500 truncate dark:text-gray-400">
                                                        <?=$p['prenom']?>
                                                    </p>
                                                </div>
                                                <div class="flex-1 min-w-0 ms-4">
                                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                        Quartier
                                                    </p>
                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                        <?=$p['quartier']?>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="py-3 sm:py-4">
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
                                        </li>
                                        <li class="py-3 sm:py-4">
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
                                        </li>
                                        <li class="py-3 sm:py-4">
                                            <div class="flex items-center">
                                                
                                                <div class="flex-1 min-w-0 ms-4">
                                                    <p class="text-md font-medium text-gray-900 truncate dark:text-white">
                                                        enregistre(e) le:
                                                    </p>
                                                    <p class="text-md text-gray-500 truncate dark:text-gray-400">
                                                        <?=$p['date']?> <?=$p['heure']?>
                                                    </p>
                                                </div>
                                                <div class="flex-1 min-w-0 ms-4">
                                                    <p class="text-md font-medium text-gray-900 truncate dark:text-white">
                                                        Assurance:
                                                    </p>
                                                    <p class="text-md text-gray-500 truncate dark:text-gray-400">
                                                        <?=$p['assurance']?>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="py-3 sm:py-4">
                                            <div class="flex items-center">
                                                <div class="flex-1 min-w-0 ms-4">
                                                    <p class="text-4xl text-blue-700 truncate dark:text-yellow-400">
                                                        <?=$p['code']?>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        
                                    </ul>
                            </div>
                            </div>

                            
                            <!-- end other  infos -->

                            <div class="px-9 pt-3 flex justify-between items-stretch flex-wrap min-h-[50px] pb-0 bg-transparent">
                            <h3 class="flex flex-col items-start justify-center m-2 ml-0 font-medium text-xl/tight text-dark">
                                <span class="mt-1 font-medium text-secondary-dark text-lg/normal">parametre, consultation, et labo</span>
                            </h3>
                            </div>
                            <!-- end card header -->
                            <!-- card body  -->
                            <div class="flex-auto block py-8 pt-6 px-9">
                            <!-- plus button -->
                            <div class="overflow-x-auto">
                                <a href="ajouter_param.php?id=<?=$id?>" class="my-2 md:my-3 ml-1 align-middle text-white no-underline hover:text-white">
                                    <button class="my-2 bg-blue-500 font-bold py-2 px-5 rounded">
                                        <i class="fas fa-plus pr-0 md:pr-3 text-white"></i>
                                        Ajouter Parametre
                                    </button> 
                                </a>
                            </div>
                            <!-- table for parameters -->
                            <div class="flex-auto block py-8 pt-6 px-0">
                            <div class="overflow-x-auto">
                                <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-[0.95rem] text-secondary-dark">
                                    <th class="pb-3 text-left min-w-[100px]">temperature (°C)</th>
                                    <th class="pb-3 text-left min-w-[80px]">tension arteriel (mmHg)</th>
                                    <th class="pb-3 text-left min-w-[60px]">poids (Kg)</th>
                                    <th class="pb-3 text-left min-w-[60px]">pouls (bpm)</th>
                                    <th class="pb-3 text-left pr-12 min-w-[100px]">raison</th>
                                    <th class="pb-3 text-left pr-12 min-w-[50px]">Date</th>
                                    <th class="pb-3 pr-12 min-w-[50px]">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($pa = mysqli_fetch_assoc($param)){
                                    $i++;
                                    echo '<tr class="border-b border-dashed last:border-b-0">';
                                    echo '<td class="px-4 py-3 whitespace-nowrap">'.$pa['temperature'].'</td>';
                                    echo '<td class="px-4 py-3 whitespace-nowrap">'.$pa['tension_arteriel'].'</td>';
                                    echo '<td class="px-4 py-3 whitespace-nowrap">'.$pa['poids'] .'</td>';
                                    echo '<td class="px-4 py-3 whitespace-nowrap">'.$pa['pouls'] .'</td>';
                                    echo '<td class="px-4 py-3 whitespace-nowrap">'.$pa['raison'] .'</td>';
                                    echo '<td class="px-4 py-3 whitespace-nowrap">'.$pa['date'] .'</td>';
                                    echo '<td class="px-4 py-3 whitespace-nowrap">';
                                    echo '<a class="color-blue-200" href="?id='.$id.'&action=view_param&p='.$pa['par_id'].'"><button class="bg-blue-500 text-white font-bold py-1 px-4 rounded"><i class="fa fa-eye" aria-hidden="true"></i></button></a>';
                                    echo '<a class="color-blue-200 px-2" href="modifier_param.php?patient='.$id.'&param='.$pa['par_id'].'"><button class="bg-green-500 text-white font-bold py-1 px-4 rounded"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>';
                                    echo '<a onclick="return del();" class="color-blue-200" href="delete.php?what=param&p='.$pa['par_id'].'&patient='.$id.'"><button class="bg-red-400 text-white font-bold py-1 px-4 rounded"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>';
                                    echo '</td></tr>';
                                    } 
                                    if($total == 0){
                                        echo '<tr>
                                        <td colspan="9">
                                        <br><br><br><br>
                                        <center>
                                        <img src="../img/notfound.svg" width="10%">
                                        
                                        <br>
                                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Pas de parametre pour le moment...</p>
                                        </a>
                                        </center>
                                        <br><br><br><br>
                                        </td>
                                        </tr>';
                                    }
                                    ?>
                                    
                                    
                                    
                                </tbody>
                                </table>

                                <?php
                                if(isset($_GET['action']) && $_GET['action']=='view_param'){
                                $p = $_GET['p'];
                                $sqlmain= "select * from parametre where par_id='$p'";
                                $result=mysqli_query($conn, $sqlmain);
                                $row=$result->fetch_assoc();
                                $temp=$row["temperature"];
                                $TA=$row["tension_arteriel"];
                                $poids=$row["poids"];
                                $pouls=$row["pouls"];
                                $SP=$row["SP"];
                                $FR=$row["FR"];
                                $BCF = $row["BCF"];
                                $HU = $row["HU"];
                                $CA = $row["CA"];
                                $oedem = $row["oedem"];
                                $raison=$row["raison"];
                                $date=$row["date"];
                                $heure=$row["heure"];
                                echo '
                                <div id="popup1" class="overlay overflow-auto">
                                        <div class="popup">
                                        <center>
                                            <h2></h2>
                                            <a class="close" href="patient.php?id='.$id.'">&times;</a>
                                            <div style="display: flex;justify-content: center; width:100%" class="max-h-50">
                                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                            
                                                <tr>
                                                    <td>
                                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Details Du parametre.</p><br><br>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    
                                                    <td class="label-td" colspan="2">
                                                        <label for="name" class="form-label">temperature: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        '.$temp.' °C<br><br>
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Email" class="form-label">Tension Arteriel: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.$TA.' mmHg<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="nic" class="form-label">Poids: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.$poids.' Kg<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label">Pouls: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.$pouls.'  bpm<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label">Saturation Pulmonaire: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.$SP.'%<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label">Frequence Respiratoir: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.$FR.' rpm<br><br>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label"><hr class="h-px bg-red-300 border-0 dark:bg-red-200"><br>Jour: </label>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="label-td" colspan="2">
                                                '.$date.'<br><br>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label">Heure: </label>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="label-td" colspan="2">
                                                '.$heure.'<br><br>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label">Raison de la visite: </label>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="label-td" colspan="2">
                                                '.$raison.'<br><br>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                        <a href="patient.php?id='.$id.'"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                                    
                                                        
                                                    </td>
                                    
                                                </tr>
                                            

                                            </table>
                                            </div>
                                        </center>
                                        <br><br>
                                </div>
                                </div>
                                ';}
                                ?>

                                <!-- Popup Card -->
                                <div id="popupCard" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden">
                                    <div class="flex justify-center items-center h-full">
                                        <div class="bg-white p-8 max-w-md rounded shadow-lg relative">
                                            <button id="closePopup" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
                                            <!-- Content of the popup card -->
                                            <h2 class="text-xl font-semibold mb-4">Patient Details</h2>
                                            <div id="popupContent"></div>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                            <!-- end parameter table -->
                            <!-- consultation table -->
                            <div class="overflow-x-auto">
                                <div href="ajouter_cons.php?id=<?=$id?>" class="my-2 md:my-3 ml-1 align-middle text-white no-underline hover:text-white">
                                    <button class="my-2 bg-gray-500 font-bold py-2 px-5 rounded">
                                        <i class="fas fa-plus pr-0 md:pr-3 text-white"></i>
                                        Nouvelle Consultation
                                    </button> 
                                </div>
                            </div>
                            <!-- table for parameters -->
                            <div class="flex-auto block py-8 pt-6 px-0">
                            <div class="overflow-x-auto w-full">
                                <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-[0.95rem] text-secondary-dark">
                                    <th class="pb-3 text-left pl-3 min-w-[30px]">Docteur</th>
                                    <th class="pb-3 text-left pl-3 min-w-[40px]">Motif</th>
                                    <th class="pb-3 text-left pl-3 min-w-[50px]">Diagnostique</th>
                                    <th class="pb-3 text-left pl-3 min-w-[40px]">Bilan</th>
                                    <th class="pb-3 text-left pr-12 pl-3 min-w-[50px]">Traitement</th>
                                    <th class="pb-3 text-left pr-12 pl-3 min-w-[30px]">Date</th>
                                    <th class="pb-3 pr-12 min-w-[40px]">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($c = mysqli_fetch_assoc($result_cons)){
                                    $i++;
                                    echo '<tr class="border-b border-dashed last:border-b-0">';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">'.$c['doc_name'].'</td>';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">'.nl2br(htmlspecialchars($c['motif'])).'</td>';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">'.nl2br(htmlspecialchars($c['diag'])) .'</td>';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">'.nl2br(htmlspecialchars($c['bilan'])) .'</td>';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">'.nl2br(htmlspecialchars($c['traitement'])) .'</td>';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">'.$c['date'] .'</td>';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">';
                                    echo '<a class="color-blue-200" href="?id='.$id.'&action=view_cons&c='.$c['cons_id'].'"><button class="bg-blue-500 text-white font-bold py-1 px-4 rounded"><i class="fa fa-eye" aria-hidden="true"></i></button></a>';
                                    // echo '<a class="color-blue-200 px-2" href="modifier_cons.php?id='.$id.'&cons='.$c['cons_id'].'"><button class="bg-green-500 text-white font-bold py-1 px-4 rounded"><i class="fa fa-pencil" aria-hidden="true"></i></button></a>';
                                    // echo '<a onclick="return del();" class="color-blue-200" href="delete.php?what=cons&c='.$c['cons_id'].'&patient='.$id.'"><button class="bg-red-400 text-white font-bold py-1 px-4 rounded"><i class="fa fa-trash-o" aria-hidden="true"></i></button></a>';
                                    echo '</td>';
                                    echo '</tr>';
                                    } 
                                    if($total_cons == 0){
                                        echo '<tr>
                                        <td colspan="9">
                                        <br><br><br><br>
                                        <center>
                                        <img src="../img/notfound.svg" width="10%">
                                        
                                        <br>
                                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Pas de consultation pour le moment...</p>
                                        </a>
                                        </center>
                                        <br><br><br><br>
                                        </td>
                                        </tr>';
                                    }
                                    ?>
                                    
                                    
                                    
                                </tbody>
                                </table>

                                <?php
                                if(isset($_GET['action']) && $_GET['action']=='view_cons'){
                                $c = $_GET['c'];
                                $sqlmain= "select * from consultations where cons_id='$c'";
                                $result=mysqli_query($conn, $sqlmain);
                                $row=$result->fetch_assoc();
                                $doc = $row['doc_name'];
                                $motif = $row['motif'];
                                $histoire = $row['histoire'];

                                $AM = $row['AM'];
                                $AI = $row['AI'];
                                $AT = $row['AT'];
                                $AO = $row['AO'];
                                $AE = $row['AE'];
                                $AP = $row['AP'];
                                $AF = $row['AF'];

                                $enquete = $row['enquete'];
                                $EP = $row['EP'];
                                $diag = $row['diag'];
                                $bilan = $row['bilan'];
                                $traitement = $row['traitement'];
                                $date=$row["date"];
                                $heure=$row["heure"];
                                echo '
                                <div id="popup1" class="overlay overflow-auto">
                                        <div class="popup">
                                        <center>
                                            <h2></h2>
                                            <a class="close" href="patient.php?id='.$id.'">&times;</a>
                                            <div style="display: flex;justify-content: center; width:100%" class="max-h-50">
                                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                            
                                                <tr>
                                                    <td>
                                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Details De la consultation.</p><br><br>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    
                                                    <td class="label-td" colspan="2">
                                                        <label for="name" class="form-label text-lg font-medium">Consulte par: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        Dr. '.$doc.'<br><br>
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Email" class="form-label text-lg font-medium">Motif de la consultation: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($motif)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="nic" class="form-label text-lg font-medium">Hisoire du patient: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($histoire)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium"><hr class="h-px bg-red-300 border-0 dark:bg-red-200"><br>Antecedent Medicaux: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($AM)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Antecedent Immunologique: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($AI)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Antecedent Toxicologique: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($AT)).'<br><br>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Antecedent Obstetrical: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($AO)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Antecedent Environnemental: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($AE)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Antecedent Personnel: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($AP)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Antecedent Familial: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($AF)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label text-lg font-medium"><hr class="h-px bg-red-300 border-0 dark:bg-red-200"><br>Enquete de System: </label>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="label-td text-sm" colspan="2">
                                                '.nl2br(htmlspecialchars($enquete)).'<br><br>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label text-lg font-medium">Examen Physique: </label>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="label-td" colspan="2">
                                                '.nl2br(htmlspecialchars($EP)).'<br><br>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label text-lg font-medium text-blue-600">Diagnostique: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="label-td" colspan="2">
                                                '.nl2br(htmlspecialchars($diag)).'<br><br>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label text-lg font-medium text-blue-600">Bilan(Examens): </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="label-td" colspan="2">
                                                '.nl2br(htmlspecialchars($bilan)).'<br><br>
                                                </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label text-lg font-medium text-blue-600">Traitement(conduite a tenir): </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="label-td" colspan="2">
                                                '.nl2br(htmlspecialchars($traitement)).'<br><br>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label text-lg font-medium">Jour: </label>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="label-td" colspan="2">
                                                '.$date.'<br><br>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label text-lg font-medium">Heure: </label>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="label-td" colspan="2">
                                                '.$heure.'<br><br>
                                                </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2">
                                                        <a href="patient.php?id='.$id.'"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                                    
                                                        
                                                    </td>
                                    
                                                </tr>
                                            

                                            </table>
                                            </div>
                                        </center>
                                        <br><br>
                                </div>
                                </div>
                                ';}
                                ?>

                                <!-- Popup Card -->
                                <div id="popupCard" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden">
                                    <div class="flex justify-center items-center h-full">
                                        <div class="bg-white p-8 max-w-md rounded shadow-lg relative">
                                            <button id="closePopup" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
                                            <!-- Content of the popup card -->
                                            <h2 class="text-xl font-semibold mb-4">Patient Details</h2>
                                            <div id="popupContent"></div>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            <!-- end consultation table -->

                            
                            <!-- CPN table -->
                        <div class="overflow-x-auto">
                                <div href="ajouter_cpn.php?id=<?=$id?>" class="my-2 md:my-3 ml-1 align-middle text-white no-underline hover:text-white">
                                    <button class="my-2 bg-gray-500 font-bold py-2 px-5 rounded">
                                        <i class="fas fa-plus pr-0 md:pr-3 text-white"></i>
                                        Nouvelle CPN
                                    </button> 
                                </div>
                            </div>
                            <!-- table for CPN -->
                            <div class="flex-auto block py-8 pt-6 px-0">
                            <div class="overflow-x-auto w-full">
                                <table class="w-full my-0 align-middle text-dark border-neutral-200">
                                <thead class="align-bottom">
                                    <tr class="font-semibold text-[0.95rem] text-secondary-dark">
                                    <th class="pb-3 text-left pl-3 min-w-[30px]">Docteur</th>
                                    <th class="pb-3 text-left pl-3 min-w-[40px]">Hauteur Urinaire</th>
                                    <th class="pb-3 text-left pl-3 min-w-[50px]">Circumference abdominale</th>
                                    <th class="pb-3 text-left pl-3 min-w-[40px]">echographie</th>
                                    <th class="pb-3 text-left pr-12 pl-3 min-w-[50px]">conclusion</th>
                                    <th class="pb-3 text-left pr-12 pl-3 min-w-[50px]">date</th>
                                    <th class="pb-3 pr-12 min-w-[40px]">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($cpn = mysqli_fetch_assoc($result_cpn)){
                                    $i++;
                                    echo '<tr class="border-b border-dashed last:border-b-0">';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">'.$cpn['doc_name'].'</td>';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">'.nl2br(htmlspecialchars($cpn['HU'])).'</td>';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">'.nl2br(htmlspecialchars($cpn['CA'])) .'</td>';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">'.nl2br(htmlspecialchars($cpn['RE'])) .'</td>';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">'.nl2br(htmlspecialchars($cpn['conclusion'])) .'</td>';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">'.$cpn['date'] .'</td>';
                                    echo '<td class="px-2 py-3 whitespace-nowrap">';
                                    echo '<a class="color-blue-200" href="?id='.$id.'&action=view_cpn&c='.$cpn['cpn_id'].'"><button class="bg-blue-500 text-white font-bold py-1 px-4 rounded"><i class="fa fa-eye" aria-hidden="true"></i></button></a>';
                                    echo '</td></tr>';
                                    } 
                                    if($total_cpn == 0){
                                        echo '<tr>
                                        <td colspan="9">
                                        <br><br><br><br>
                                        <center>
                                        <img src="../img/notfound.svg" width="10%">
                                        
                                        <br>
                                        <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Pas de consultation prenatale pour le moment...</p>
                                        </a>
                                        </center>
                                        <br><br><br><br>
                                        </td>
                                        </tr>';
                                    }
                                    ?>
                                    
                                    
                                    
                                </tbody>
                                </table>

                                <?php
                                if(isset($_GET['action']) && $_GET['action']=='view_cpn'){
                                $c = $_GET['c'];
                                $sqlmain= "select * from cpn where cpn_id='$c'";
                                $result=mysqli_query($conn, $sqlmain);
                                $row=$result->fetch_assoc();

                                $doc = $row['doc_name'];
                                $EG = $row['EG'];
                                $conj = $row['conj'];
                                $ES = $row['ES'];
                                $abdomen = $row['abdomen'];
                                $HU = $row['HU'];
                                $CA = $row['CA'];
                                $MAF = $row['MAF'];
                                $BDCF = $row['BDCF'];
                                $plaintes = $row['plaintes'];
                                $TV = $row['TV'];
                                $RE = $row['RE'];
                                $conclusion = $row['conclusion'];
                                $oedem = $row['oedem'];
                                
                                $date=$row["date"];
                                $heure=$row["heure"];
                                echo '
                                <div id="popup1" class="overlay overflow-auto">
                                        <div class="popup">
                                        <center>
                                            <h2></h2>
                                            <a class="close" href="patient.php?id='.$id.'">&times;</a>
                                            <div style="display: flex;justify-content: center; width:100%" class="max-h-50">
                                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                            
                                                <tr>
                                                    <td>
                                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Details De la consultation.</p><br><br>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    
                                                    <td class="label-td" colspan="2">
                                                        <label for="name" class="form-label text-lg font-medium">Consulte par: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        Dr. '.$doc.'<br><br>
                                                    </td>
                                                    
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Email" class="form-label text-lg font-medium">Etat General: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($EG)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="nic" class="form-label text-lg font-medium"><hr class="h-px bg-red-300 border-0 dark:bg-red-200"><br>Conjonctive: </label>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($conj)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Etat seins: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($ES)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Abdomen: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($abdomen)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Hauteur Uterine: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($HU)).'<br><br>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Circonference Abdominale: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($CA)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Mouvement actifs fœtal: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($MAF)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Battement de Coeur Fœtal: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($BDCF)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Plaintes: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($plaintes)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="Tele" class="form-label text-lg font-medium">Touchee Vaginale: </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($TV)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label text-lg font-medium"><hr class="h-px bg-red-300 border-0 dark:bg-red-200"><br>Oedeme: </label>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                    '.nl2br(htmlspecialchars($oedem)).'<br><br>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label text-lg font-medium"><hr class="h-px bg-red-300 border-0 dark:bg-red-200"><br>Resultats Echographie: </label>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="label-td text-sm" colspan="2">
                                                '.nl2br(htmlspecialchars($RE)).'<br><br>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label text-lg font-medium">Conclusion: </label>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="label-td" colspan="2">
                                                '.nl2br(htmlspecialchars($conclusion)).'<br><br>
                                                </td>
                                                </tr>
                                                
                                                <tr>
                                                <td class="label-td" colspan="2">
                                                '.$date.'<br><br>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td class="label-td" colspan="2">
                                                        <label for="spec" class="form-label text-lg font-medium">Heure: </label>
                                                        
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="label-td" colspan="2">
                                                '.$heure.'<br><br>
                                                </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td colspan="2">
                                                        <a href="patient.php?id='.$id.'"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                                    
                                                        
                                                    </td>
                                    
                                                </tr>
                                            

                                            </table>
                                            </div>
                                        </center>
                                        <br><br>
                                </div>
                                </div>
                                ';}
                                ?>

                                <!-- Popup Card -->
                                <div id="popupCard" class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-50 hidden">
                                    <div class="flex justify-center items-center h-full">
                                        <div class="bg-white p-8 max-w-md rounded shadow-lg relative">
                                            <button id="closePopup" class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">&times;</button>
                                            <!-- Content of the popup card -->
                                            <h2 class="text-xl font-semibold mb-4">Patient Details</h2>
                                            <div id="popupContent"></div>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>
                            <!-- end CPN table -->

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
