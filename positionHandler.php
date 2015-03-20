<?php
	session_start();
	$_SESSION[$_GET['id']] = getStyle();
	
	
	function getStyle()
	{
		$styleTemp = "width: ".$_GET['width']."; height: ".$_GET['height']."; top: ".$_GET['top']."; right: ".$_GET['right']."; bottom: ".$_GET['bottom']."; left: ".$_GET['left'];
		return $styleTemp;	
	}
?>