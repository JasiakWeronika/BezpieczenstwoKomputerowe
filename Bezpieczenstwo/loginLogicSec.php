<?php
    session_start();
    require_once(__DIR__."/php/bazaDanych.php");
    $OK = isset($_POST["login"]) && isset($_POST["psswrd"]) && isset($_SESSION[$sessionKEY]) && ($_SESSION[$sessionKEY] === $sessionVAL);
  
    if (!$OK) {
        header("location: login.php");
    }

    $LOGIN = $_POST["login"];
    $PSSWRD = $_POST["psswrd"];
  
    $db = new portaldb();

    $sql = "SELECT password FROM users WHERE login = '$LOGIN'";
    $result = $db->query($sql);
  
    if ($result->num_rows == 1) {
	   $row = $result->fetch_assoc();
	   if (password_verify($PSSWRD, $row["password"])) {
            echo "Zalogowano pomyślnie";
            $_SESSION['login_user'] = $LOGIN;
            header("location: mainPage.php");
        } else {
            header("location: loginSec.php");
            $error = "Podano błędne hasło";
        }  
    } else {
        header("location: loginSec.php");
    }
    $db->close();
?>
