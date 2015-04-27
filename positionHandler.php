<?php
	session_start();
	
	$appname = $_POST['id'];
	$width = $_POST['width'];
	$height = $_POST['height'];
	$top = $_POST['top'];
	$right = $_POST['right'];
	$bottom = $_POST['bottom'];
	$left = $_POST['left'];
	
	$positions = array($id, $width,$height,$top,$right,$bottom,$left);
	
	require_once("loginFunctions.php");
	
	correctInput($positions);
	
	$appname = $positions[0];
	$width = $positions[1];
	$height = $positions[2];
	$top = $positions[3];
	$right = $positions[4];
	$bottom = $positions[5];
	$left = $positions[6];
	
	
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
			
			
			
			$sqlCommand = "INSERT INTO position (id, appname, width, height, topoffset, rightoffset, bottomoffset, leftoffset) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
							ON DUPLICATE KEY UPDATE width=Values(?) height=VALUES(?) topoffset=VALUES(?) rightoffset=VALUES(?) bottomoffset=VALUES(?) leftoffset=VALUES(?)";
			
			$entry = $connect->prepare($sqlCommand);
			
			
			$entry->bind_param('isiiiiiiiiiiii', $id, $appname, $width, $height, $top, $right, $bottom, $left, $width, $height, $top, $right, $bottom, $left);
				
			if($entry->execute())
			{
				echo "<p>Popupdata was updated</p>";
			}
		
		}
		mysqli_close($connect);
	}
	
	
	
	
?>