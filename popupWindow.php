<?php
	
	function createPopupWindow($appname)
	{
		echo "<div id=\"".$appname."\" class=\"popup\" style=\"".getStyle($appname)."\";>";
		echo	"<div class=\"popupHeader\">";
		echo		"<h2> ".$appname."</h2>";
		echo		"<a href=\"index.php?closePopup=".$appname."\"><img src=\"res/x_for_closing.png\" alt=\"X for closing this window\"></a>";
		echo	"</div>";
		
		echo 	"<div id=\"popupContent\">";
		
		if($appname == "Foto App")
		{
			include("fotoUploadApplication.php");
		}
		else if($appname == "Leaf App")
		{
			include("profileApp.php");
		}
		else
		{
			ob_start();
			phpinfo();
			$pinfo = ob_get_contents();
			ob_end_clean();
			
			$pinfo = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$pinfo);
			echo $pinfo;
		}
		
		echo 	"</div>";
			
		echo "</div>";
	}
	

?>