<?php 
    require_once(__DIR__."/php/bazaDanych.php");
    session_start();
    $_SESSION[$sessionKEY] = $sessionVAL;
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Bank</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <h1>Resetuj hasło</h1>
        <form method = "post" action="resetPasswordLogic.php">
            <div class="form-row">
                <label>Login</label>
                <input type= "text" name= "login" maxlength="15" required>
            </div>
            <div class="form-row">
                <label>E-mail</label>
                <input type= "email" id="email" name="email" maxlength="100" required>
            </div> 
            <div  class="form-row"> 
                <input type="submit" value="Resetuj">
            </div>
            <hr>
            <a href="loginSec.php">Powrót do logowania</a>   
        </form>
    </body>
</html>