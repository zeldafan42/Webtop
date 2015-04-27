<h3>You can update your profile info here</h3>
<?php 
	if(isset($_GET['passwordChange']))
	{
		if($_GET['passwordChange'])
		{
			echo "<p>Password successfully changed</p>";
		}
		else
		{
			echo "<p>Error: Password remains unchanged</p>";
		}
	}

?>

<form action="updateProfile.php" method="POST">
	<input type="password" name="password" placeholder="Password"/>
	<input type="submit" name="changePassword" value="Change Password"/>
</form> 

<?php 
	if(isset($_GET['emailChange']))
	{
		if($_GET['emailChange'])
		{
			echo "<p>E-mail adress successfully changed</p>";
		}
		else
		{
			echo "<p>Error: E-mail adress remains unchanged</p>";
		}
	}

?>

<form action="updateProfile.php" method="POST">
	<input type="text" name="email" placeholder="E-mail adress"/>
	<input type="submit" name="changeEmail" value="Change E-mail adress"/>
</form> 

<?php 
	if(isset($_GET['pictureChange']))
	{
		if($_GET['pictureChange'])
		{
			echo "<p>Picture successfully changed</p>";
		}
		else
		{
			echo "<p>Error: Picture remains unchanged</p>";
		}
	}

?>

<form action="updateProfile.php" method="POST">
	<input type="file" name="picture"/>
	<input type="submit" name="changePicture" value="Change Picture"/>
</form>