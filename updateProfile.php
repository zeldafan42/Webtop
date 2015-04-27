<?php
session_start();
require_once("loginFunctions.php");

if(isset($_POST['password'])) //checks whether the user wanted to change password,email or picture
{
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	$wasChanged = FALSE;
	$connect = new mysqli("localhost","root","password","brunnhilde");
	
	if($connect->errno == 0)
	{
		echo "Verbindung wurde aufgebaut";
			
		$sqlcommand = "UPDATE user SET password = ? WHERE username = ?";
		$entry = $connect->prepare($sqlcommand);
		$entry->bind_param('ss', $password, $_SESSION['username']);
			
		$wasChanged = $entry->execute();
		$connect->close();
	}	
	
	header("Location: index.php?passwordChange=".$wasChanged);
	
}
else if(isset($_POST['email'])) //checks whether the user wanted to change email
{
	$email = correctInput($_POST['email']);
	
	$wasChanged = FALSE;
	$connect = new mysqli("localhost","root","password","brunnhilde");
	
	if($connect->errno == 0)
	{
		echo "Verbindung wurde aufgebaut";
			
		$sqlcommand = "UPDATE user SET email=? WHERE username = ?";
		$entry = $connect->prepare($sqlcommand);
		$entry->bind_param('ss', $email, $_SESSION['username']);
			
		$wasChanged = $entry->execute();
		$connect->close();
	}
	
	header("Location: index.php?emailChange=".$wasChanged);
	
	
}
else if(isset($_POST['picture']))  //checks whether the user wanted to change picture
{
	
	
	
	
}
else
{
	
}

?>