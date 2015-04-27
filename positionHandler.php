<?php
	session_start();
	
	require_once("loginFunctions.php");
	
	$appname = correctInput($_POST['id']);
	$width = correctInput($_POST['width']);
	$height = correctInput($_POST['height']);
	$top = correctInput($_POST['top']);
	$right = correctInput($_POST['right']);
	$bottom = correctInput($_POST['bottom']);
	$left = correctInput($_POST['left']);
	
	
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