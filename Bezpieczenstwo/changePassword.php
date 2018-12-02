<?php 
    require("session.php");
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
        <h1>Zmiana hasła</h1>
        <form method = "post" action="changePasswordLogic.php">
            <div class="form-row">
                <label>Obecne hasło</label>
                <input type= "password" name= "oldpsswrd" maxlength="30" required>
            </div>
            <div class="form-row">
                <label>Nowe hasło</label>
                <input type= "password" id="psswrd" name="psswrd" maxlength="30" required>
            </div> 
            <div class="form-row">
                <label>Powtórz hasło</label>
                <input type= "password" id="psswrd2" name="psswrd2" maxlength="30" required>
            </div> 
            <div  class="form-row"> 
                <input type="submit" value="Zmień">
            </div>
            <hr>
            <a href="mainPage.php">Powrót do menu</a>
        </form>
        <script>
            var password = document.getElementById("psswrd"), confirm_password = document.getElementById("psswrd2");
            function validatePassword() {
                if (password.value != confirm_password.value) {
                    confirm_password.setCustomValidity("Passwords Don't Match");
                } else {
                    confirm_password.setCustomValidity('');
                }
            }
            password.onchange = validatePassword;
            confirm_password.onkeyup = validatePassword;
        </script>
    </body>
</html>