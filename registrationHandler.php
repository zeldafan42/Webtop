<?php
	
	$forename = $_POST['forename'];
	$surname = $_POST['surname'];
	$username = $_POST['username'];
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$picture = $_POST['picture'];
	$email = $_POST['email'];
	$activated = 0;
	
	if(strcmp($forename,"") == 0 || strcmp($surname,"") == 0 || strcmp($username,"") == 0 || strcmp($password,"") == 0 || strcmp($picture,"") == 0 || strcmp($email,"") == 0)
	{
		echo "<p>Please insert </p>";
	}
	else
	{
		$connect = mysqli_connect ("localhost", "root", "password","brunnhilde");
		
		if(mysqli_connect_errno() == 0)
		{
			echo "<p>Verbindung wurde aufgebaut</p>";
			$sqlCommand = "INSERT INTO user (forename, surname, username, password, picture, email, activated) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$entry = $connect->prepare($sqlCommand);
			$entry->bind_param('ssssssi', $forename, $surname, $username, $password, $picture, $email, $activated);
			
			if($entry->execute())
			{
				echo "<p>Datensatz wurde erfolgreich hinzugefügt, muss aber noch freigegeben werden</p>";
			}
	
		}
		mysqli_close($connect);
	}
	
	
	echo "Klicken Sie auf 'OK' um zum Login zurückzukehren";	
	echo "<form action=\"index.php\" method=\"POST\">";
	echo "<input type=\"submit\" value=\"OK\"/>";
	echo "</form>";

?>