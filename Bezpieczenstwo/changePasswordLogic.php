<?php
    require("session.php");
    $OK = isset($_POST["oldpsswrd"]) && isset($_POST["psswrd"]) && isset($_POST["psswrd2"]) && isset($_SESSION[$sessionKEY]) && ($_SESSION[$sessionKEY] === $sessionVAL);
  
    if (!$OK) {
        header("location: change.php");
    }

    $LOGIN = $_SESSION['login_user'];
    $PSSWRD = $_POST["psswrd"];
  
    $db = new portaldb();

    $sql = "SELECT password FROM users WHERE login = '$LOGIN'";
    $result = $db->query($sql);
  
    if ($result->num_rows == 1) {
	   $PSSWRD = password_hash($PSSWRD, PASSWORD_DEFAULT);
	   $sql2 = "UPDATE users SET password = ? WHERE login = ?";
	
	   $polecenie = $db -> prepare($sql2);
	   $polecenie -> bind_param("ss", $PSSWRD, $LOGIN);
	   $polecenie -> execute();
	   $polecenie -> close();
	
	   header("location: mainPage.php");
    } else {
	   header("location: resetPassword.php");
    }
  $db->close();
?>