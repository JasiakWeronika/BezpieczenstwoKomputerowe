<?php
    include('php/bazaDanych.php');
    session_start();
   
    $db = new portaldb();
   
    $user_check = $_SESSION['login_user'];
   
    $ses_sql = mysqli_query($db,"select login from users where login = '$user_check'");
   
    $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
    $login_session = $row['login'];
   
    if (!isset($_SESSION['login_user'])) {
        header("location:loginSec.php");
    }
?>