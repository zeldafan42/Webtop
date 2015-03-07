<!DOCTYPE html>
<html>
	<head>	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>
			W3bt0p 1337
		</title>
	</head>

	<body id="background">
		<div id="wrapper">	
			<div id="content">
				<?php 
					if($_POST['login'])
					{
						include("webtop.php");
					}
					else
					{
						include("login.php");
					}
				?>
			</div>
		</div>
	</body>
</html>
?>