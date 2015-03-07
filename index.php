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
					if(authenticateuser($_POST['username'],$_POST['password']))

					{
						include("webtop.php");
					}
					else
					{
						include("login.php");
					}
					
					
					function authenticateuser($user,$password)
					{
						return ($user == "username") && ($password == "password");
					}
				?>
			</div>
		</div>
	</body>
</html>
