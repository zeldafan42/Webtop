<?php 
	session_start();
	
	require_once("loginFunctions.php");
	require_once("fotoFunctions.php");
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
		<link rel="stylesheet" href="fancybox/jquery.fancybox.css" type="text/css" media="screen" />
		<script src="jquery-2.1.3.min.js"></script>
		<script src="jquery-ui.min.js"></script>
		<script src="jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
		<script src="jQuery-File-Upload/js/jquery.fileupload.js"></script>
		<script src="dragAndDrop.js"></script>
		<script src="helper.js"></script>
		<script type="text/javascript" src="fancybox/jquery.fancybox.pack.js"></script>
		<script>
			
		 	$(function() {
			 $( ".webtopIcon" ).draggable({scroll: false, containment: "parent", stop: function(event, ui){savePosition(this)}});
			 $( ".popup" ).draggable({scroll: false, handle: ".popupHeader", containment: "parent", stop: function(event, ui){savePosition(this)}});
			 $( ".popup" ).resizable({handles: "all", stop: function(event, ui){savePosition(this)}});
			 $('.fancybox').fancybox();
			 });
				
		</script>
	</head>

	<body id="background">
		<div id="wrapper">	
			<div id="content">
				<?php 
					if(!isset($_SESSION['username']) && isset($_POST['username']) && $_POST['password'])
					{
						authenticate_user($_POST['username'],$_POST['password']);
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
						if(isset($_GET['registration']))
						{
							include("registration.php");
						}	
						else 
						{
							include("login.php");
						}
					}
					
					function authenticate_user($user,$password)
					{
						if(ldap_login($user,$password))
						{
							login_user($user);
						}
						elseif (database_login($user,$password))
						{
							login_user($user);
						}
					}
					
					function login_user($username)
					{
						if(isset($_POST['stillAlive']))
						{
							setcookie("username","".$username,time()+13371337);
						}
						$_SESSION['username'] = $username;
					}
				?>
			</div>
		</div>
	</body>
</html>
