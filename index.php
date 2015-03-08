<?php 
	session_start();
	if(isset($_GET['logout']))
	{
		if($_GET['logout'])
		{
			session_unset();
			session_destroy();
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link type="text/css" rel="stylesheet" href="style.css">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>
			W3bt0p 1337
		</title>
	</head>

	<body id="background">
		<div id="wrapper">	
			<div id="content">
				<?php 
					if(!isset($_SESSION['username']) && isset($_POST['username']) && $_POST['password'])
					{
						authenticateuser($_POST['username'],$_POST['password']);
					}
					if(isset($_SESSION['username']))
					{
						include("webtop.php");
					}
					else
					{
						if(isset($_POST['login']))
						{
							echo "<p>Wrong username or password</p>";
						}
						include("login.php");
					}
					
					function authenticateuser($user,$password)
					{
						if(($user == "username") && ($password == "password"))
						{
							$_SESSION['username'] = $user;
						}
					}
				?>
			</div>
		</div>
	</body>
</html>
