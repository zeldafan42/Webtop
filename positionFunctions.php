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
			$stmt->close();
				
			$stmt2 = $connect->prepare("SELECT closed, width, height, topoffset, rightoffset, bottomoffset, leftoffset FROM position WHERE id = ? AND appname = ?");
			$stmt2->bind_param('ss', $id, $appname);
			$stmt2->execute();
			$stmt2->bind_result($closed, $width, $height, $top, $right, $bottom, $left);
			$stmt2->fetch();
			$stmt2->close();
				
			$outputString = "";
				
			if($closed == 0)
			{
				$outputString .= "position: absolute !important; ";
	
				$outputString .= "width: ".$width."px; ";
				$outputString .= "height: ".$height."px; ";
				$outputString .= "top: ".$top."px; ";
				$outputString .= "right: ".$width."px; ";
				$outputString .= "bottom: ".$bottom."px; ";
				$outputString .= "left: ".$left."px;";
			}
				
			return $outputString;
		}
			
	}
?>