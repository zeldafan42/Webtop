<?php
	session_start();
	$_SESSION[$_POST['id']] = getStyle();
	
	$appname = $_POST['id'];
	$width = $_POST['width'];
	$height = $_POST['height'];
	$top = $_POST['top'];
	$right = $_POST['right'];
	$bottom = $_POST['bottom'];
	$left = $_POST['left'];
	
	$positions = array($id, $width,$height,$top,$right,$bottom,$left);
	
	$positions = correctInput($positions);
	
	if(strcmp($forename,"") == 0 || strcmp($surname,"") == 0 || strcmp($username,"") == 0 || strcmp($password,"") == 0 || strcmp($picture,"") == 0 || strcmp($email,"") == 0)
	{
		echo "<p>Error: Positions were modified</p>";
	}
	else
	{
		$connect = mysqli_connect ("localhost", "root", "password","brunnhilde");
		
		if(mysqli_connect_errno() == 0)
		{
			echo "<p>Verbindung wurde aufgebaut</p>";
			
			$stmt = $connect->prepare("SELECT id FROM user WHERE username = ?");
			$stmt->bind_param('s', $_SESSION['username']);
			
			$stmt->execute();
			$stmt->bind_result($id);
			$stmt->fetch();
			$stmt->close();
			
			
			/*$sqlCommand = "UPDATE position
							SET width=? height=? top=? right=? bottom=? left=?
							WHERE id=".$id." AND appname=?";
			
			$entry = $connect->prepare($sqlCommand);
			$entry->bind_param('iiiiiis', $width, $height, $top, $right, $bottom, $left, $appname);
			*/
			
			
			
			/*$sqlCommand = "INSERT INTO position (id, appname, width, height, topoffset, rightoffset, bottomoffset, leftoffset) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
							ON DUPLICATE KEY UPDATE id=VALUES(?)";
			$entry = $connect->prepare($sqlCommand);
			
			
			$entry->bind_param('isiiiiii', $id, $appname, $width, $height, $top, $right, $bottom, $left);
				
			if($entry->execute())
			{
				echo "<p>Datensatz wurde erfolgreich hinzugefügt, muss aber noch freigegeben werden</p>";
			}*/
		
		}
		mysqli_close($connect);
	}
	
	
?>