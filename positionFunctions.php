<?php
	function getStyle($appname)
	{
	
		$connect = mysqli_connect ("localhost", "root", "password","brunnhilde");
	
		if(mysqli_connect_errno() == 0)
		{
	
			$stmt = $connect->prepare("SELECT id FROM user WHERE username = ?");
			$stmt->bind_param('s', $_SESSION['username']);
	
			$stmt->execute();
			$stmt->bind_result($id);
			$stmt->fetch();
			$stmt->free_result();
			$stmt->close();
				
			$stmt2 = $connect->prepare("SELECT closed, width, height, topoffset, rightoffset, bottomoffset, leftoffset, Count(closed) FROM position WHERE id = ? AND appname = ?");
			$stmt2->bind_param('ss', $id, $appname);
			$stmt2->execute();
			$stmt2->bind_result($closed, $width, $height, $top, $right, $bottom, $left, $count);
			$stmt2->fetch();
			$stmt2->free_result();
			$stmt2->close();
				
			$outputString = "";
				
			if($closed == 0 && $count > 0)
			{
				$outputString .= "position: absolute !important; ";
	
				$outputString .= "width: ".$width."; ";
				$outputString .= "height: ".$height."; ";
				$outputString .= "top: ".$top."; ";
				$outputString .= "right: ".$width."; ";
				$outputString .= "bottom: ".$bottom."; ";
				$outputString .= "left: ".$left.";";
			}
				
			return $outputString;
		}
			
	}
	
	function getOpenWindws()
	{
		
		$id = getUserId();
		
		if($id == -1)
		{
			return;
		}
		
		$connect = mysqli_connect ("localhost", "root", "password","brunnhilde");
		
		if(mysqli_connect_errno() == 0)
		{
		
			$stmt2 = $connect->prepare("SELECT appname, closed FROM position WHERE id = ?");
			$stmt2->bind_param('s', $id);
			$stmt2->execute();
			$stmt2->bind_result($appname, $closed);
			
			$apps = array();
			
			while($stmt2->fetch())
			{
				if($closed == 0 && stristr($appname, "app"))
				{
					array_push($apps,$appname);
				}
			}
			
			
			
			$stmt2->free_result();
			$stmt2->close();
		
			return $apps;
		}
	}
	
	function getUserId()
	{
		$connect = mysqli_connect ("localhost", "root", "password","brunnhilde");
		
		if(mysqli_connect_errno() == 0)
		{
		
			$stmt = $connect->prepare("SELECT id FROM user WHERE username = ?");
			$stmt->bind_param('s', $_SESSION['username']);
		
			$stmt->execute();
			$stmt->bind_result($id);
			$stmt->fetch();
			$stmt->free_result();
			$stmt->close();
			
			return $id;
		}
		return -1;
	}
	
	function closeApp($appname)
	{
		$id = getUserId();
		
		if($id == -1)
		{
			return;
		}
		
		$connect = mysqli_connect ("localhost", "root", "password","brunnhilde");
		
		if(mysqli_connect_errno() == 0)
		{
			$stmt2 = $connect->prepare("UPDATE position SET closed=1 WHERE id = ? AND appname = ?");
			$stmt2->bind_param('ss', $id, $appname);
			$stmt2->execute();
			$stmt2->free_result();
			$stmt2->close();
			return;
		}
	}
	
	
	
	
	
?>