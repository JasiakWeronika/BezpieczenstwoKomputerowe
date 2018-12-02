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
        <h1>Logowanie</h1>
        <form method ="post" action="loginLogicSec.php">
            <div class="form-row">
                <label>Login</label>
                <input type="text" name="login" maxlength="15" required>
            </div>
            <div class="form-row">
                <label>Hasło</label>
                <input type="password" id="haslo" name="psswrd" maxlength="30" required>
            </div>
            <div  class="form-row"> 
                <input type="submit" value="Zaloguj">
            </div> 
            <hr>
            <a href="resetPassword.php">Resetuj hasło</a>
            <br>
            <a href="registrationSec.php">Zarejestruj się</a>
        </form>
    </body>
</html>