<?php

// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif');

if(!is_dir("./uploads"))
{
	mkdir("./uploads");
}

if(isset($_FILES['upl']) &&
		!$_FILES['upl']['error'] && 
		$_FILES['upl']['size']> 0 && 
		$_FILES['upl']['tmp_name'] && 
		is_uploaded_file($_FILES['upl']['tmp_name']))
{

    $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

    if(!in_array(strtolower($extension), $allowed) || !($_FILES['upl']['type'] == "image/png" || $_FILES['upl']['type'] == "image/gif" || $_FILES['upl']['type'] == "image/jpeg"))
    {
        echo '<p id="uploadStatus">Filetype rejected</p>';
    }
    elseif(move_uploaded_file($_FILES['upl']['tmp_name'], 'uploads/'.$_FILES['upl']['name']))
    {
        echo '<p id="uploadStatus">Upload completed</p>';
    }
    
    $fileHandle = opendir("./uploads/");
    
    while($myFile = readdir($fileHandle)){
    	if($myFile != "." && $myFile != ".."){
    		echo "<p>";
			echo "<img src='./uploads/".$myFile."'><a href='index.php?delete=./uploads/".$myFile."'>Delete</a>";
			echo "</p>";
    	}
    }
}
else
{
	echo '<p id="uploadStatus">Upload completed</p>';
}
?>