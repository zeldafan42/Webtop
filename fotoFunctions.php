<?php

function uploadUserPicture($userpic)
{
	$allowed = array('png', 'jpg', 'gif');
	
	if(!is_dir("./uploads"))
	{
		mkdir("./uploads");
	}
	
	if(!is_dir("./uploads/userpics"))
	{
		mkdir("./uploads/userpics");
	}
	
	if(!is_dir("./uploads/thumbs"))
	{
		mkdir("./uploads/thumbs");
	}
	
	if(isset($userpic) &&
			!$userpic['error'] &&
			$userpic['size']> 0 &&
			$userpic['tmp_name'] &&
			is_uploaded_file($userpic['tmp_name']))
	{
	
		$extension = pathinfo($userpic['name'], PATHINFO_EXTENSION);
		$newFileName = uniqid("usrimg_",TRUE).".".$extension;
	
		if(!in_array(strtolower($extension), $allowed) || !($userpic['type'] == "image/png" || $userpic['type'] == "image/gif" || $userpic['type'] == "image/jpeg"))
		{
			echo '<p id="uploadStatus">Filetype rejected</p>';
			return false;
		}
		elseif(move_uploaded_file($userpic['tmp_name'], 'uploads/'.$newFileName))
		{
			echo '<p id="uploadStatus">Upload completed</p>';
			create_thumb($newFileName, 64,64);
			unlink('uploads/'.$newFileName);
			copy('uploads/thumbs/'.$newFileName, 'uploads/userpics/'.$newFileName);
			unlink('uploads/thumbs/'.$newFileName);
		}
	}
	else
	{
		echo '<p id="uploadStatus">Upload failed</p>';
		return false;
	}
	
	
	return 'uploads/userpics/'.$newFileName;
}

function show_pics()
{
	$fileHandle = opendir("./uploads/");
	
	while($myFile = readdir($fileHandle)){
		if(!is_dir("./uploads/".$myFile)){
			echo "<div class=\"thumb\" onMouseEnter=\"showCmds($(this))\"  onMouseLeave=\"hideCmds($(this))\">";
			echo "<a class=\"fancybox\" rel=\"group\" href=\"./uploads/".$myFile."\"><img src=\"./uploads/thumbs/".$myFile."\"></a>";
			echo "<div class=\"fotoCmds\">";
			echo "<a href=\"index.php?delete=".$myFile."\">Delete</a></br>";
			echo "<a href=\"index.php?grayscale=".$myFile."\">Grayscale</a></br>";
			echo "<a href=\"index.php?rotateLeft=".$myFile."\">Rotate left</a></br>";
			echo "<a href=\"index.php?rotateRight=".$myFile."\">Rotate right</a></br>";
			echo "<a href=\"index.php?mirror=".$myFile."\">Mirror</a></br>";
			echo "<a href=\"index.php?crop=".$myFile."\">Crop</a></br>";
			echo "<a href=\"index.php?undo=".$myFile."\">Undo</a></br>";
			echo "<a href=\"./uploads/".$myFile."\" download=\"$myFile\">Download</a>";
			echo "</div>";
			echo "</div>";
		}
	}
}

function create_thumb($imgfile,$targetWidth,$targetHeight)
{
	$imgsize = getimagesize('uploads/'.$imgfile);
	$imgwidth = $imgsize[0];
	$imgheight = $imgsize[1];

	$img = create_image_from_file($imgfile);
	
	if($img)
	{
		$maxthumbwidth = $targetWidth;
		$maxthumbheight = $targetHeight;
	
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
	else
	{
		return false;
	}
}

function backup_image($imgfile)
{
	copy("./uploads/".$imgfile, "./uploads/backup/".$imgfile);
}

function restore_image($imgfile)
{
	copy("./uploads/backup/".$imgfile, "./uploads/".$imgfile);
	create_thumb($imgfile,150,150);
}

function create_image_from_file($imgfile)
{
	$imgsize = getimagesize('uploads/'.$imgfile);

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
			echo "Unsupported format";
			return false;
	}
	
	return $img;
}

function gray_scale($imgfile)
{
	$img = create_image_from_file($imgfile);
	
	if($img)
	{
		backup_image($imgfile);
		imagefilter($img, IMG_FILTER_GRAYSCALE);
		imagepng($img, "./uploads/".$imgfile);
		create_thumb($imgfile,150,150);
		imagedestroy($img);
	}
	else
	{
		return false;
	}
}

function rotate($imgfile, $degrees)
{
	$img = create_image_from_file($imgfile);

	if($img)
	{
		backup_image($imgfile);
		$img = imagerotate($img, $degrees, 0);
		imagepng($img, "./uploads/".$imgfile);
		create_thumb($imgfile,150,150);
		imagedestroy($img);
	}
	else
	{
		return false;
	}
}

function mirror($imgfile)
{
	$img = create_image_from_file($imgfile);

	if($img)
	{
		backup_image($imgfile);
		imageflip($img, IMG_FLIP_HORIZONTAL);
		echo "<p>Was mirrored</p>";
		imagepng($img, "./uploads/".$imgfile);
		create_thumb($imgfile,150,150);
		imagedestroy($img);
	}
	else
	{
		echo "<p>Was somehow incorrect</p>";
		return false;
	}
}


function cropImg($imgfile, $left, $top, $width, $height)
{
	$img = create_image_from_file($imgfile);
	
	if($img && is_numeric($left) && is_numeric($top) && is_numeric($width) && is_numeric($height))
	{
		
		backup_image($imgfile);
		$arr = array("x"=>$left, "y"=>$top, "width"=>$width, "height"=>$height);
		$img = imagecrop($img, $arr);
		imagepng($img, "./uploads/".$imgfile);
		create_thumb($imgfile,150,150);
		imagedestroy($img);
	}
	else
	{
		return false;
	}
}

?>