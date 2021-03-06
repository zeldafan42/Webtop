<?php	
	require_once("loginFunctions.php");
	require_once("fotoFunctions.php");
	
	$forename = correctInput($_POST['forename']);
	$surname = correctInput($_POST['surname']);
	$username = correctInput($_POST['username']);
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$email = correctInput($_POST['email']);
	
	$picture = uploadUserPicture($_FILES['picture']);
	
	if(strcmp($forename,"") == 0 || strcmp($surname,"") == 0 || strcmp($username,"") == 0 || strcmp($password,"") == 0 || strcmp($picture,"") == 0 || strcmp($email,"") == 0)
	{
		echo "<p>Please insert </p>";
	}
	else
	{
		$connect = new mysqli ("localhost", "root", "password","brunnhilde");
		
		if($connect->errno == 0)
		{
			echo "<p>Verbindung wurde aufgebaut</p>";
			$sqlCommand = "INSERT INTO user (forename, surname, username, password, picture, email) VALUES (?, ?, ?, ?, ?, ?)";
			$entry = $connect->prepare($sqlCommand);
			$entry->bind_param('ssssss', $forename, $surname, $username, $password, $picture, $email);
			
			if($entry->execute())
			{
				echo "<p>Datensatz wurde erfolgreich hinzugef�gt</p>";
			}
	
		}
		$connect->close();
	}
	
	
	echo "Klicken Sie auf 'OK' um zum Login zur�ckzukehren";	
	echo "<form action=\"index.php\" method=\"POST\">";
	echo "<input type=\"submit\" value=\"OK\"/>";
	echo "</form>";
?>
