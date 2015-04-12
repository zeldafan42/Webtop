<?php

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
    }
    
    $fileHandle = opendir("./uploads/");
    
    while($myFile = readdir($fileHandle)){
    	if(!is_dir("./uploads/".$myFile)){
    		echo "<p>";
			echo "<a class=\"fancybox\" rel=\"group\" href=\"./uploads/".$myFile."\"><img src=\"./uploads/thumbs/".$myFile."\"></a><a href=\"index.php?delete=".$myFile."\">Delete</a>";
			echo "</p>";
    	}
    }
}
else
{
	echo '<p id="uploadStatus">Upload failed</p>';
}

function create_thumb($imgfile)
{
	$imgsize = getimagesize('uploads/'.$imgfile);
	$imgwidth = $imgsize[0];
	$imgheight = $imgsize[1];
	$imgtype = $imgsize[2];
	
	switch($imgtype)
	{
		case IMG_GIF:
			$img = imagecreatefromgif('uploads/'.$imgfile);
			break;
		case IMG_JPG:
			$img = imagecreatefromjpeg('uploads/'.$imgfile);
			break;
		case IMG_PNG: case 3:
			$img = imagecreatefrompng('uploads/'.$imgfile);
			break;
		default:
			die('Unsupported imageformat');
	}
	
	$maxthumbwidth = 150;
	$maxthumbheight = 100;

	$thumbwidth = $imgwidth;
	$thumbheight = $imgheight;

	if ($thumbwidth > $maxthumbwidth)
	{
		$factor = $maxthumbwidth / $thumbwidth;
		$thumbwidth *= $factor;
		$thumbheight *= $factor;
	}

	if ($thumbheight > $maxthumbheight)
	{
		$factor = $maxthumbheight / $thumbheight;
		$thumbwidth *= $factor;
		$thumbheight *= $factor;
	}

	$thumb = imagecreatetruecolor($thumbwidth, $thumbheight);
		
	imagecopyresampled($thumb, $img, 0, 0, 0, 0, $thumbwidth, $thumbheight, $imgwidth, $imgheight);
	
	imagepng($thumb,'uploads/thumbs/'.$imgfile);
	imagedestroy($img);
	imagedestroy($thumb);
}
?>