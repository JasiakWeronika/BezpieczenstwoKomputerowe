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
        <h1>Rejestracja</h1>
        <form method = "post" action="addUserSec.php">
            <div class="form-row">
                <label>Login</label>
                <input type= "text" name= "login" maxlength="15" required>
            </div>
            <div class="form-row">
                <label>Hasło</label>
                <input type= "password" id="haslo" name="psswrd" maxlength="30" required>
            </div>
            <div class="form-row">
                <label>Powtórz hasło</label>
                <input type= "password" id="hasloczek" name="psswrd2" maxlength="30" required>
            </div>
            <div class="form-row">
                <label>E-mail</label>
                <input type= "email" name= "email" maxlength="100" required>
            </div>
            <div  class="form-row"> 
                <input type="submit" value="Zarejestruj">
            </div>
            <hr>
            <a href="loginSec.php">Powrót do logowania</a>
            <script>
                var password = document.getElementById("haslo"), confirm_password = document.getElementById("hasloczek");
                function validatePassword() {
                    if (password.value != confirm_password.value) {
                        confirm_password.setCustomValidity("Hasła nie zgadzają się!");
                    } else {
                        confirm_password.setCustomValidity('');
                    }
                }
                password.onchange = validatePassword;
                confirm_password.onkeyup = validatePassword;
            </script>
        </form>
    </body>
</html>