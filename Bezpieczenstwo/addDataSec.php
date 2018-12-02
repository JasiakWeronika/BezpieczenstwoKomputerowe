<?php 
    require('session.php');
  
    $name = $_SESSION["name"];
    $sndrAcc = $_SESSION["senderAccount"];
    $amount = $_SESSION["amount"];
    $title = $_SESSION["title"];
  
    $login = $_SESSION['login_user'];
    $date=date('Y-m-d H:i:s');
  
    $db = new portaldb();
    $sql = "SELECT bankaccount FROM users WHERE login = '$login'";
    $result = $db -> query($sql);
  
    if ($result->num_rows == 1) {
        echo $date;
	  
        $row = $result->fetch_assoc();
        $recAcc = $row["bankaccount"];
	  
        $polecenie = $db->prepare("INSERT INTO transfers (receiverName, senderAccount, receiverAccount, amount, title, date) VALUES (?, ?, ?, ?, ? , ?)");

        $polecenie->bind_param("ssssss", $name, $sndrAcc, $recAcc, $amount, $title, $date);

        $polecenie->execute();
	
        if ($db->error != "")   {
            echo "Błędnie podane dane.";
        }
  
        $polecenie->close();
        $db->close();
    } else {
        echo "błąd";
}
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Bank</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <h1>Przelew został wykonany!</h1>
        <form method = "post" action="mainPage.php">
            <div class="welcome">
                <div class="form-row">
                    <label>Nazwa odbiorcy: <?php echo $name ?> </label>
                </div>
                <div class="form-row">
                    <label>Rachunek odbiorcy: <?php echo $sndrAcc ?></label>
                </div>
                <div class="form-row">
                    <label>Rachunek nadawcy: <?php echo $recAcc ?></label>   
                </div>
                <div class="form-row">
                    <label>Kwota: <?php echo $amount ?></label>    
                </div>
                <div class="form-row">
                    <label>Tytuł: <?php echo $title ?></label>
                </div>
                <div class="form-row">
                    <label>Data: <?php echo $date ?></label>
                </div>          
                <div class="form-row"> 
                    <input type="submit" value="Wróć">
                </div>  
            </div>
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