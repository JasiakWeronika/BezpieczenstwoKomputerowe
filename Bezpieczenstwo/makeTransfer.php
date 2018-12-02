<?php 
    require('session.php');
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
        <h1>Przelew</h1>
        <form method = "post" action="confirmDataSec.php">
            <div class="form-row">
                <label>Nazwa odbiorcy</label>
                <input type= "text" name= "name" maxlength="15" required>
            </div>
            <div class="form-row">
                <label>Rachunek odbiorcy</label>
                <input type= "text" name= "senderAccount" pattern="[0-9]{26}" id="blad" required>
            </div>
            <div class="form-row">
                <label>Tytuł</label>
                <input type= "text" name= "title" maxlength="15" required>
            </div>
            <div class="form-row">
                <label>Kwota</label>
                <input type= "number" min = "0.00" max="100000.00" step = "0.01" name= "amount" wpisz kwotę.." required>
            </div>
            <div  class="form-row"> 
                <input type="submit" value="Wykonaj">
            </div>
            <hr>
            <a href="mainPage.php">Powrót do menu</a>
            <script>
                var password = document.getElementById("haslo"), confirm_password = document.getElementById("hasloczek");
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
            <script type="text/javascript" src="defender.js"></script>
        </form>
    </body>
</html>