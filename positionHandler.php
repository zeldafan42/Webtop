<?php
	session_start();
	$_SESSION[$_POST['id']] = getStyle();
	
	$width = $_POST['width'];
	$height = $_POST['height'];
	$top = $_POST['top'];
	$right = $_POST['right'];
	$bottom = $_POST['bottom'];
	$left = $_POST['left'];
	
	$positions = array($width,$height,$top,$right,$bottom,$left);
	
	$positions = correctInput($positions);
	
	
?>