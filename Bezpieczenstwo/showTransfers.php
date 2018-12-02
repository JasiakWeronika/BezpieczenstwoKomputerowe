<?php
	include('session.php');	
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <title>Bank</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    	<h1>Historia</h1>
    	<table>
    		<thead>
    			<tr>
    				<th><b>Data</b></th>
    				<th><b>Odbiorca</b></th>
    				<th><b>Racunek odbiorcy</b></th>
    				<th><b>Rachunek</b></th>
    				<th><b>Tytuł</b></th>
    				<th><b>Kwota</b></th>
    		</thead>
    		<tbody>
    			<?php
					$TMPL = "<tr><td>{{date}}</td><td>{{rcvName}}</td><td>{{sndrAcc}}</td><td>{{rcvAcc}}</td><td>{{title}}</td><td>{{amount}}</td></tr>";
								
					$username = $_SESSION['login_user'];
					
					$sql2 = "SELECT bankaccount FROM users WHERE login = '$username'";
					$result = $db -> query($sql2);
				  
					if ($result->num_rows == 1) {
						$row = $result->fetch_assoc();
						$recAcc = $row["bankaccount"];
					}
					
					$db = new portaldb();
					$sql = "SELECT * FROM transfers WHERE senderAccount = $recAcc OR receiverAccount = $recAcc";
					
					$result = $db->query($sql);	
				  	while (($row = $result -> fetch_assoc()) !== null) {
				    	$kopiaTMPL = $TMPL;
				    	$s = str_replace( 
				    		["{{date}}", "{{rcvName}}", "{{sndrAcc}}", "{{rcvAcc}}", "{{title}}", "{{amount}}"],
				      		[$row['date'], $row['receiverName'], $row['senderAccount'], $row['receiverAccount'], $row['title'], $row['amount']], $kopiaTMPL);
				    	echo $s;
				  	}
				  	$result->close();
				  	$db->close();
				?>
			</tbody>
		</table>
    	<hr>
    	<a href='mainPage.php'>Powrót do menu</a>
    </body>
</html>
