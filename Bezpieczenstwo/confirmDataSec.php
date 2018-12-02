<?php 
    require('session.php');
  
    $name = $_POST["name"];
    $sndrAcc = $_POST["senderAccount"];
    $amount = $_POST["amount"];
    $title = $_POST["title"];
    $_SESSION["name"] = $name;
    $_SESSION["senderAccount"] =  $sndrAcc;
    $_SESSION["amount"] = $amount;
    $_SESSION["title"] = $title;
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Bank</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <h1>Potwierdzenie przelewu</h1>
        <form method = "post" action="addDataSec.php">
            <div class="welcome">
                <div class="form-row">
                    <label>Nazwa odbiorcy</label>
                    <input type= "text" name= "name" maxlength="15" value ="<?php echo $name ?>" disabled>
                </div>
                <div class="form-row">
                    <label>Rachunek odbiorcy</label>
                    <input type= "text" name= "senderAccount" pattern="[0-9]{26}" value ="<?php echo $sndrAcc ?>" size="26" disabled>
                </div>
                <div class="form-row">
                    <label>Tytuł</label>
                    <input type= "text" name= "title" maxlength="15" value ="<?php echo $title ?>" disabled>
                </div>
                <div class="form-row">
                    <label>Kwota</label>
                    <input type= "number" min = "0.00" max="100000.00" step = "0.01" name= "amount"  value ="<?php echo $amount ?>" disabled>
                </div>
            </div>
            <div class="form-row"> 
                <input type="submit" value="Potwierdź">
            </div>
            <hr>
            <a href="makeTransfer.php">Anuluj</a>
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
        </form>
    </body>
</html>