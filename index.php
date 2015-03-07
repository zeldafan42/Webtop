<?php 
	session_start();
	if($_GET['logout'])
	{
		session_unset();
		session_destroy();
	}
?>

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
					if(!$_SESSION['loggedIn'])
					{
						authenticateuser($_POST['username'],$_POST['password']);
					}
					if($_SESSION['loggedIn'])
					{
						include("webtop.php");
					}
					else
					{
						if($_POST['login'])
						{
							echo "<p>Wrong username or password</p>";
						}
						include("login.php");
					}
					
					echo "<a href=\"".$_SERVER['PHP_SELF']."?logout=true\">Logout</a>";
					
					function authenticateuser($user,$password)
					{
						if(($user == "username") && ($password == "password"))
						{
							$_SESSION['username'] = $user;
							$_SESSION['loggedIn'] = true;
						}
					}
				?>
			</div>
		</div>
	</body>
</html>
