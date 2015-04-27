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
	
	require_once("loginFunctions.php");
	
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
	
	function getStyle($appname)
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
			
			$stmt2 = $connect->prepare("SELECT closed FROM position WHERE id = ? AND appname = ?");
			$stmt2->bind_param('ss', $id, $appname);
			$stmt2->execute();
			$stmt2->bind_result($closed);
			$stmt2->fetch();
			$stmt2->close();
			
			$stmt2 = $connect->prepare("SELECT width FROM position WHERE id = ? AND appname = ?");
			$stmt2->bind_param('ss', $id, $appname);
			$stmt2->execute();
			$stmt2->bind_result($width);
			$stmt2->fetch();
			$stmt2->close();
			
			$stmt2 = $connect->prepare("SELECT height FROM position WHERE id = ? AND appname = ?");
			$stmt2->bind_param('ss', $id, $appname);
			$stmt2->execute();
			$stmt2->bind_result($height);
			$stmt2->fetch();
			$stmt2->close();
			
			$stmt2 = $connect->prepare("SELECT topoffset FROM position WHERE id = ? AND appname = ?");
			$stmt2->bind_param('ss', $id, $appname);
			$stmt2->execute();
			$stmt2->bind_result($top);
			$stmt2->fetch();
			$stmt2->close();
			
			$stmt2 = $connect->prepare("SELECT rightoffset FROM position WHERE id = ? AND appname = ?");
			$stmt2->bind_param('ss', $id, $appname);
			$stmt2->execute();
			$stmt2->bind_result($right);
			$stmt2->fetch();
			$stmt2->close();
			
			$stmt2 = $connect->prepare("SELECT bottomoffset FROM position WHERE id = ? AND appname = ?");
			$stmt2->bind_param('ss', $id, $appname);
			$stmt2->execute();
			$stmt2->bind_result($bottom);
			$stmt2->fetch();
			$stmt2->close();
			
			$stmt2 = $connect->prepare("SELECT leftoffset FROM position WHERE id = ? AND appname = ?");
			$stmt2->bind_param('ss', $id, $appname);
			$stmt2->execute();
			$stmt2->bind_result($left);
			$stmt2->fetch();
			$stmt2->close();
			
			$outputString = "";
			
			if($closed == 0)
			{
				$outputString = $outputString + "position: absolute !important; ";
				
				$outputString = $outputString + "width: ".$width."px; ";
				$outputString = $outputString + "height: ".$height."px; ";
				$outputString = $outputString + "top: ".$top."px; ";
				$outputString = $outputString + "right: ".$width."px; ";
				$outputString = $outputString + "bottom: ".$bottom."px; ";
				$outputString = $outputString + "left: ".$left."px;";
			}
			else
			{
				$outputString = $outputString + "display: none;";
			}
			return $outputString;
		}
			
	}
	
	
?>