<?php
	$conn = new mysqli("localhost", "root", "password");
	
	if($conn->errno != 0)
	{
		die("Connection failed: " . $conn->connect_error);
	}
	
	if($conn->query("DROP DATABASE IF EXISTS brunnhilde") === FALSE)
	{
		die("Error dropping database");
	}
	
	if($conn->query("CREATE DATABASE IF NOT EXISTS brunnhilde") === FALSE)
	{
		die("Error creating database");		
	}
	
	$conn->select_db("brunnhilde");
	
	$tableCreate = "CREATE TABLE IF NOT EXISTS user
					(
					id INT(11) AUTO_INCREMENT PRIMARY KEY,
					forename VARCHAR(64) NOT NULL,
					surname VARCHAR(64) NOT NULL,
					username VARCHAR(64) NOT NULL UNIQUE,
					password VARCHAR(256) NOT NULL,
					picture VARCHAR(128) NOT NULL,
					email VARCHAR(64) NOT NULL
					)";
	
	if($conn->query($tableCreate) === FALSE)
	{
		die("Error creating table user");
	}
	
	$tableCreate = "CREATE TABLE IF NOT EXISTS position
					(
					id INT(11),
					appname VARCHAR(64) NOT NULL,
					width VARCHAR(16) NOT NULL,
					height VARCHAR(16) NOT NULL,
					topoffset  VARCHAR(16) NOT NULL,
					rightoffset VARCHAR(16) NOT NULL,
					bottomoffset  VARCHAR(16) NOT NULL,
					leftoffset VARCHAR(16) NOT NULL,
					closed BOOLEAN NOT NULL,
					FOREIGN KEY(id) REFERENCES user(id),
					PRIMARY KEY (id,appname)
					)";
	
	if($conn->query($tableCreate) === FALSE)
	{
		die("Error creating table position");
	}
	
	$tableCreate = "CREATE TABLE IF NOT EXISTS rssHeader
					(
					id INT(11) PRIMARY KEY AUTO_INCREMENT,
					title VARCHAR(256) NOT NULL,
					link VARCHAR(256) NOT NULL,
					description VARCHAR(512) NOT NULL,
					category  VARCHAR(256) NULL
					)";
	
	if($conn->query($tableCreate) === FALSE)
	{
		die("Error creating table rssHeader");
	}
	
	$tableCreate = "CREATE TABLE IF NOT EXISTS rssContent
					(
					id INT(11) PRIMARY KEY AUTO_INCREMENT,
					fk_header_id INT(11),
					title VARCHAR(256) NOT NULL,
					link VARCHAR(256) NOT NULL,
					description VARCHAR(512) NOT NULL,
					author VARCHAR(64) NOT NULL,
					timestamp TIMESTAMP NOT NULL,
					FOREIGN KEY(fk_header_id) REFERENCES rssHeader(id) ON DELETE CASCADE
					)";
	
	if($conn->query($tableCreate) === FALSE)
	{
		die("Error creating table rssContent");
	}
	
	$conn->close();
	
	echo "Init successful";
?>
