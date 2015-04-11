<?php
	
	$forename = $_POST['forename'];
	$surname = $_POST['surname'];
	$username = $_POST['username'];
	$password = password_hash($_POST['surname'], PASSWORD_BCRYPT);
	$picture = $_POST['picture'];
	$email = $_POST['email'];
	$activated = 0;
	
	$connect = mysqli_connect ("localhost", "root", "password","brunnhilde");
	
	if(mysqli_connect_errno() == 0)
	{
		echo "<p>Verbindung wurde aufgebaut</p>";
		$entry = "INSERT INTO user (forename, surname, username, password, picture, email, activated) VALUES ('$forename', '$surname', '$username', '$password', '$picture', '$email', '$activated')";
		
		$eintrag = mysqli_query($connect,$entry);
		
		if($eintrag)
		{
			echo "<p>Datensatz wurde erfolgreich hinzugefügt, muss aber noch freigegeben werden</p>";
		}
		else {
			echo $eintrag;
		}
	}
	
	
	mysql_close($connect);
	
	
	echo "Klicken Sie auf 'OK' um zum Login zurückzukehren";	
	echo "<form action=\"index.php\" method=\"POST\">";
	echo "<input type=\"submit\" value=\"OK\"/>";
	echo "</form>";

?>