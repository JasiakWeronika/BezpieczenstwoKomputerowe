<?php
    session_start();
    require_once(__DIR__."/php/bazaDanych.php");
    $OK = isset($_POST["login"]) && isset($_POST["email"]) && isset($_SESSION[$sessionKEY]) && ($_SESSION[$sessionKEY] === $sessionVAL);
  
    if (!$OK) {
        header("location: reset.php");
    }

    $LOGIN = $_POST["login"];
    $EMAIL = $_POST["email"];
  
    $db = new portaldb();

    $sql = "SELECT password FROM users WHERE login = '$LOGIN' AND email = '$EMAIL'";
    $result = $db->query($sql);
  
    if ($result->num_rows == 1) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 12; $i++) {
            $randstring .= $characters[rand(0, strlen($characters)-1)];
        }
	   $PSSWRD = password_hash($randstring, PASSWORD_DEFAULT);
	   $sql2 = "UPDATE users SET password = ? WHERE login = ? AND email = ?";
	
	   $polecenie = $db -> prepare($sql2);
	   $polecenie -> bind_param("sss", $PSSWRD, $LOGIN, $EMAIL);
	   $polecenie -> execute();
	   $polecenie -> close();
	
	   echo "Nowe hasło: ".$randstring;
    } else {
	  header("location: resetPassword.php");
    }
    $db->close();
?>