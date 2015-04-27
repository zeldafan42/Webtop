<?php	
	require_once("loginFunctions.php");
	require_once("fotoFunctions.php");
	
	$forename = correctInput($_POST['forename']);
	$surname = correctInput($_POST['surname']);
	$username = correctInput($_POST['username']);
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$email = correctInput($_POST['email']);
	
	
	
	
	// A list of permitted file extensions
	$allowed = array('png', 'jpg', 'gif');
	
	if(!is_dir("./uploads"))
	{
		mkdir("./uploads");
	}
	
	if(!is_dir("./uploads/userpics"))
	{
		mkdir("./uploads/userpics");
	}
	
	if(!is_dir("./uploads/thumbs"))
	{
		mkdir("./uploads/thumbs");
	}
	
	if(isset($_FILES['picture']) &&
			!$_FILES['picture']['error'] &&
			$_FILES['picture']['size']> 0 &&
			$_FILES['picture']['tmp_name'] &&
			is_uploaded_file($_FILES['picture']['tmp_name']))
	{
	
		$extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
		$newFileName = uniqid("usrimg_",TRUE).".".$extension;
	
		if(!in_array(strtolower($extension), $allowed) || !($_FILES['picture']['type'] == "image/png" || $_FILES['picture']['type'] == "image/gif" || $_FILES['picture']['type'] == "image/jpeg"))
		{
			echo '<p id="uploadStatus">Filetype rejected</p>';
		}
		elseif(move_uploaded_file($_FILES['picture']['tmp_name'], 'uploads/'.$newFileName))
		{
			echo '<p id="uploadStatus">Upload completed</p>';
			create_thumb($newFileName, 32,32);
			unlink('uploads/'.$newFileName);
			copy('uploads/thumbs/'.$newFileName, 'uploads/userpics/'.$newFileName);
			unlink('uploads/thumbs/'.$newFileName);
		}
	}
	else
	{
		echo '<p id="uploadStatus">Upload failed</p>';
	}
	
	
	$picture = 'uploads/userpics/'.$newFileName;
	
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
				echo "<p>Datensatz wurde erfolgreich hinzugefügt</p>";
			}
	
		}
		$connect->close();
	}
	
	
	echo "Klicken Sie auf 'OK' um zum Login zurückzukehren";	
	echo "<form action=\"index.php\" method=\"POST\">";
	echo "<input type=\"submit\" value=\"OK\"/>";
	echo "</form>";
?>
