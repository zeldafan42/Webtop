<?php
 
require_once("loginFunctions.php");

if(isset($_POST['username']))
{
	$connect = new mysqli("localhost", "root", "password","brunnhilde");
	
	$username = correctInput($_POST['username']);
	
	if($connect->errno == 0)
	{
		echo "<p>Verbindung wurde aufgebaut</p>";
			
		$stmt = $connect->prepare("SELECT email FROM user WHERE username = ?");
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$stmt->bind_result($mailTo);
		$stmt->fetch();
		$stmt->close();
	
		$newPassword = generateRandomString(20);
		$password = password_hash($newPassword, PASSWORD_BCRYPT);
		
		$sqlcommand = "UPDATE user SET password=? WHERE username=?";
		$entry = $connect->prepare($sqlcommand);
		$entry->bind_param('ss', $password, $username);
		
		$wasChanged = $entry->execute();
	
		$connect->close();
	}
	
	if($wasChanged)
	{
		$mailFrom = '"Webtop" <webtop@webtop.webtop>';
		$mailSubject = 'Password retrieval';
		$returnPage = 'index.php?forgotPassword=true&sendMail=true';
		$returnErrorPage = 'index.php?forgotPassword=true&sendMail=false';
		
		$mailText = "Hallo ".$username.",\n dein neues Passwort lautet: ".$newPassword."\nSei dir bewusst, dass wir es dir gerade im <u>KLARTEXT</u>
					zugeschickt haben, das heiﬂt, <b>‰ndere es sobald du dich das n‰chste Mal einloggst</b>.\nViele Gr¸ﬂe, dein Webtop-Team";
		
		
		// ======= Mailversand
		
		// Mail versenden und Versanderfolg merken
		$mailSent = @mail($mailTo, $mailSubject, $mailText, "From: ".$mailFrom);
		
		// ======= Return-Seite an den Browser senden
		
		// Wenn der Mailversand erfolgreich war:
		if($mailSent == TRUE)
		{
			header("Location: " . $returnPage);
		}
		// Wenn die Mail nicht versendet werden konnte:
		else
		{
			header("Location: " . $returnErrorPage);
		}
	}
	else
	{
		header("Location: index.php?forgotPassword=true&passwordChanged=false");
	}
	
	 
	
	 
	exit();
}
 
?>