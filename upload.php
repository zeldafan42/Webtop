<?php

require_once("fotoFunctions.php");

// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif');

if(!is_dir("./uploads"))
{
	mkdir("./uploads");
}

if(!is_dir("./uploads/thumbs"))
{
	mkdir("./uploads/thumbs");
}

if(!is_dir("./uploads/backup"))
{
	mkdir("./uploads/backup");
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
        create_thumb($_FILES['upl']['name']);
        backup_image($_FILES['upl']['name']);
    }
    
   show_pics();
}
else
{
	echo '<p id="uploadStatus">Upload failed</p>';
}
?>