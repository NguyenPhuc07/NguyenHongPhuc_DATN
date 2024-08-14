<?php
ob_start();
define('__ROOT__', dirname(dirname(__FILE__)));
include ('./lib/session.php');
include ('./lib/database.php');
include ('./helper/format.php');
include ('./class/cartegory_class.php');
include ('./class/brand_class.php');
include ('./class/comment_class.php');
include ('./class/product_class.php');

Session::init();
Session::checkSession()
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/54f0cb7e4a.js" crossorigin="anonymous"></script>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="ckfinder/ckfinder.js"></script>
    <title>Admin-HONGPHUCSPORT</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>