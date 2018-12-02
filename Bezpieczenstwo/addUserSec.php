<?php
    session_start();
    require_once(__DIR__."/php/bazaDanych.php");
    $OK = isset($_POST["login"]) && isset($_POST["psswrd"]) && isset($_POST["email"]) && isset($_SESSION[$sessionKEY]) && ($_SESSION[$sessionKEY] === $sessionVAL);
  
    if (!$OK) {
        header("location: registration.php");
    }
  
    $LOGIN = substr(trim($_POST["login"]),0,15);
    $PSSWRD = password_hash($_POST["psswrd"], PASSWORD_DEFAULT);
    $EMAIL = $_POST["email"];
  
    $db = new portaldb();
    do {
        $bankAccountValue = rand(111111111, 999999999);
        $bankAccount = strval($bankAccountValue);
        $bankAccountValue2 = rand(111111111, 999999999);
        $bankAccount = $bankAccount.strval($bankAccountValue2);
        $bankAccountValue3 = rand(11111111, 99999999);
        $bankAccount = $bankAccount.strval($bankAccountValue3);
	
        $sql = "SELECT login FROM useres WHERE bankaccount = '$bankAccount'";
        $result = $db->query($sql);
    } while ($result->num_rows != 0);

    $polecenie = $db->prepare("INSERT INTO users (login, password, email, bankaccount) VALUES (?, ?, ?, ?)");

    $polecenie->bind_param("ssss", $LOGIN, $PSSWRD, $EMAIL, $bankAccount);

    $polecenie->execute();
  
    $polecenie->close();
    $db->close();
    $_SESSION = [];
    session_destroy();   
    session_unset();
    header("location: loginSec.php");
?>
