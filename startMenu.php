<div id=startMenu>
	<?php 
		echo "<a href=\"".$_SERVER['PHP_SELF']."?logout=true\">Logout</a>";
		
		$connect = new mysqli("localhost","root","password","brunnhilde");
		
		if($connect->errno == 0)
		{
			$sqlcommand = "SELECT picture FROM user WHERE username = ?";
			$entry = $connect->prepare($sqlcommand);
			$entry->bind_param('s', $_SESSION['username']);
			$entry->execute();
				
			$entry->bind_result($imgstring);
			$entry->fetch();
			$entry->free_result();
				
			echo "<img src=\"".$imgstring."\"></img>";
				
			$connect->close();
		}
	?>
</div>