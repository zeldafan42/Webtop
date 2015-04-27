<?php 
	if(isset($_GET['sendMail']))
	{
		if($_GET['sendMail'])
		{
			echo "<p id=mailSuccess>Mail successfully sent</p>";
		}
		else
		{
			echo "<p id=mailError>Error: Mail could not be sent</p>";
		}
	}

?>

<form action="forgotPasswordHandler.php" method="POST" id="forgotPasswordForm" enctype="multipart/form-data">
	<fieldset>
		<p><input type="text" name="username" placeholder="Nickname"/></p>
		<p><a href="index.php">Zur&uuml;ck zum Login</a></p>
		<input type="submit" name="login" value="Send new Password" id="forgotPasswordButton"/>
	</fieldset>
</form>
