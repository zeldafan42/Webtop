<?php

	echo "<div id=\"".$_SESSION['popupWindow']."\" class=\"popup\" style=\"".getStyle($_SESSION['popupWindow'])."\";>";
	echo	"<div class=\"popupHeader\">";
	echo	"<h2> ".$_SESSION['popupWindow']."</h2>";
	echo	"<a href=\"index.php?closePopup=true\"><img src=\"res/x_for_closing.png\" alt=\"X for closing this window\"></a>";
	echo	"</div>";
	echo 	"<div id=\"popupContent\">";
			if($_SESSION['popupWindow'] == "Foto App")
			{
				include("fotoUploadApplication.php");
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
	echo	"</div>";
		
	echo "</div>"
	

?>