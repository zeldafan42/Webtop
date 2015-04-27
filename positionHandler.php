<?php
	session_start();
	
	$appname = $_POST['id'];
	$width = $_POST['width'];
	$height = $_POST['height'];
	$top = $_POST['top'];
	$right = $_POST['right'];
	$bottom = $_POST['bottom'];
	$left = $_POST['left'];
	
	$positions = array($appname, $width,$height,$top,$right,$bottom,$left);
	
	require_once("loginFunctions.php");
	
	correctInput($positions);
	
	$appname = $positions[0];
	$width = $positions[1];
	$height = $positions[2];
	$top = $positions[3];
	$right = $positions[4];
	$bottom = $positions[5];
	$left = $positions[6];
	
	
	if(strcmp($appname,"") == 0 || strcmp($width,"") == 0 || strcmp($height,"") == 0 || strcmp($top,"") == 0 || strcmp($right,"") == 0 || strcmp($bottom,"") == 0 || strcmp($left,"") == 0)
	{
		return;
	}
	else
	{
		$connect = new mysqli ("localhost", "root", "password","brunnhilde");
		
		if($connect->errno == 0)
		{
			echo "Verbindung wurde aufgebaut";
			
			$stmt = $connect->prepare("SELECT id FROM user WHERE username = ?");
			$stmt->bind_param('s', $_SESSION['username']);
			
			$stmt->execute();
			$stmt->bind_result($id);
			$stmt->fetch();
			$stmt->close();
			
			
			
			$sqlCommand = "INSERT INTO position (id, appname, width, height, topoffset, rightoffset, bottomoffset, leftoffset, closed) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)
							ON DUPLICATE KEY UPDATE width=?, height=?, topoffset=?, rightoffset=?, bottomoffset=?, leftoffset=?, closed=0";
			
			$entry = $connect->prepare($sqlCommand);
			
			
			$entry->bind_param('isssssssssssss', $id, $appname, $width, $height, $top, $right, $bottom, $left, $width, $height, $top, $right, $bottom, $left);
			$entry->execute();
			echo "executed";
		
		}
		$connect->close();
	}
	
	
	
	
?>