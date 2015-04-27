<?php

if(isset($_POST['password'])) //checks whether the user wanted to change password,email or picture
{
	$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
	
	
	
	
	
	
}
else if(isset($_POST['email'])) //checks whether the user wanted to change email
{
	$email = correctInput($_POST['email']);
	
	
}
else if(isset($_POST['picture']))  //checks whether the user wanted to change picture
{
	
	
	
	
}
else
{
	
}

?>