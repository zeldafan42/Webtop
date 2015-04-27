<?php
		
	require_once("positionFunctions.php");
	require_once("popupWindow.php");

	if(isset($_GET['closePopup']))
	{
		closeApp($_GET['closePopup']);
	}
	
	$apps = getOpenWindws();
	
	foreach ($apps as $appname)
	{
		createPopupWindow($appname);
	}
	
	if(!isset($_SESSION['startMenu']))
	{
		$_SESSION['startMenu'] = false;
	}
	
	if(isset($_GET['fotoApp']))
	{
		if(!in_array("Foto App", $apps))
		{
			createPopupWindow("Foto App");
		}
	}
	
	if(isset($_GET['fireIcon']))
	{
		if(!in_array("fireApp", $apps))
		{
			createPopupWindow("fireApp");
		}
	}
	if(isset($_GET['leafIcon']))
	{
		if(!in_array("leafApp", $apps))
		{
			createPopupWindow("leafApp");
		}
	}
	if(isset($_GET['butterflyIcon']))
	{
		if(!in_array("butterflyApp", $apps))
		{
			createPopupWindow("butterflyApp");
		}
	}
	if(isset($_GET['openMenu']))
	{
		$_SESSION['startMenu'] = $_GET['openMenu'];
	}
	
	echo "<h1> Welcome ".$_SESSION['username']."</h1>";
			
	echo "<div id=\"waterIcon\" class=\"webtopIcon\" style=\"".getStyle("waterIcon")."\">";
	echo "<a href=\"index.php?fotoApp=true\"> <img src=\"res/water-icon.png\" alt=\"Wasser-Icon\" > </a>";
	echo "</div>";
	
	echo "<div id=\"fireIcon\" class=\"webtopIcon\" style=\"".getStyle("fireIcon")."\">";
	echo "<a href=\"index.php?fireIcon=true\"> <img src=\"res/fire-icon.png\" alt=\"Feuer-Icon\" > </a>";
	echo "</div>";
	
	echo "<div id=\"leafIcon\" class=\"webtopIcon\" style=\"".getStyle("leafIcon")."\">";
	echo "<a href=\"index.php?leafIcon=true\"> <img src=\"res/leaf-icon.png\" alt=\"Blatt-Icon\" > </a>";
	echo "</div>";
	
	
	echo "<div id=\"butterflyIcon\" class=\"webtopIcon\" style=\"".getStyle("butterflyIcon")."\">";
	echo "<a href=\"index.php?butterflyIcon=true\"> <img src=\"res/butterfly-icon.png\" alt=\"Schmetterling-Icon\" > </a>";
	echo "</div>";
		
?>
		
		<div id="taskbar">
			<?php 
			if(isset($_SESSION['startMenu']))
			{
				if($_SESSION['startMenu'])
				{
					include("startMenu.php");
				}
			}
				include("taskbar.php")
			?>
			
		</div>
		
		