<?php 
	session_start();
	if(isset($_GET['logout']))
	{
		if($_GET['logout'])
		{
			session_unset();
			session_destroy();
			setcookie("username","",time()-1337);
			header("Location: ".$_SERVER['PHP_SELF']);
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
		<link href="jquery-ui.min.css" rel="stylesheet">
		<link href="jquery-ui.structure.min.css" rel="stylesheet">
		<link href="jquery-ui.theme.min.css" rel="stylesheet">
		<script src="jquery-2.1.3.min.js"></script>
		<script src="jquery-ui.min.js"></script>
		<script src="helper.js"></script>
		<script src="jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
		<script src="jQuery-File-Upload/js/jquery.fileupload.js"></script>
		<script src="dragAndDrop.js"></script>
		<script>
			
		 	$(function() {
			 $( ".webtopIcon" ).draggable({scroll: false, stop: function(event, ui){savePosition(this)}});
			 $( ".popup" ).draggable({scroll: false, handle: ".popupHeader", stop: function(event, ui){savePosition(this)}});
			 $( ".popup" ).resizable({handles: "all", stop: function(event, ui){savePosition(this)}});
			 });
				
		</script>
	</head>

	<body id="background">
		<div id="wrapper">	
			<div id="content">
				<?php 
					if(!isset($_SESSION['username']) && isset($_POST['username']) && $_POST['password'])
					{
						authenticateuser($_POST['username'],$_POST['password']);
					}
					if(isset($_COOKIE['username']) || isset($_SESSION['username']))
					{
						include("webtop.php");
						if(isset($_COOKIE['username']) && !isset($_SESSION['username']))
						{
							$_SESSION['username'] = $_COOKIE['username'];
						}
					}
					else
					{
						if(isset($_POST['login']))
						{
							echo "<p id=\"loginError\">Wrong username or password</p>";
						}
						include("login.php");
					}
					
					function authenticateuser($user,$password)
					{
						if(($user == "username") && ($password == "password"))
						{
							if(isset($_POST['stillAlive']))
							{
								setcookie("username","".$user,time()+13371337);
							}
							$_SESSION['username'] = $user;
						}
					}
				?>
			</div>
		</div>
	</body>
</html>
