<?php
session_start();
date_default_timezone_set('Asia/Tehran');
require_once __DIR__.DIRECTORY_SEPARATOR.'../jdf.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'../autoLoad.php';
?>
<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>سیستم تیکت</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/bootstrap-rtl.css">
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top" id="navb">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">پروژه تیکت از سیدحسین حسینی</a>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="./panel.php">
                    <?php
                    if (!isset($_SESSION['ACC'])){
                        echo 'لطفا وارد وبسایت شوید ';
                    }else{
                        echo $_SESSION['name'].' '.'عزیز به وبسایت خوش آمدید';
                    }
                    ?>
                </a></li>
            <li><?php if (isset($_SESSION['ACC'])){
                echo '<a href="exit.php" class="btn btn-danger">خروج از وبسایت</a>';
                    } ?></li>
        </ul>
    </div>
</nav>

<br><br><br><br><br>