<?php 
session_start();
//print_r($_SESSION);
require_once('connection.php');

//settings
$qab = "SELECT * FROM tb_setting where wst_show = 1 order by wst_id desc limit 1";
$rsb = mysqli_query($Connection, $qab) or die (mysqli_error($Connection));
$rowab = mysqli_fetch_assoc($rsb);

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title><?=$rowab['wst_title'];?> - <?=$rowab['wst_name'];?></title>

    <!-- Favicon -->
    <link rel="icon" href="./img/wst/<?=$rowab['wst_img'];?>">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="style.css">

     <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">

</head>
<body>
        <!-- Preloader -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- /Preloader -->

    <!-- Header Area Start -->
    <header class="header-area">