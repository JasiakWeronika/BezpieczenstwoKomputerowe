<?php
	include('session.php');
	$username = $_SESSION['login_user'];
	$sql2 = "SELECT bankaccount FROM users WHERE login = '$username'";
	$result = $db -> query($sql2);
  
	if ($result->num_rows == 1) {
		$row = $result->fetch_assoc();
		$recAcc = $row["bankaccount"];
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
    	<h1>Bank</h1>
    	<div class="welcome">
    		<?php
    			echo "<p>Witaj <b>".$username."!</b></p>";
    			echo  '<p>Twój numer konta to <div id="account">'.$recAcc.'</div></p>';
    		?>
    	</div>
		<a href = "makeTransfer.php">Wykonaj przelew</a>
		<br>
		<a href = "showTransfers.php">Pokaż historię przelewów</a>
		<br>
		<a href = "changePassword.php">Zmień hasło</a>
		<hr>
		<a href="logoutSec.php">Wyloguj się</a>
	</body>
</html>