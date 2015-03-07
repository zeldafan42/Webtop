		<div id="waterIcon">
			<a href="index.php?waterIcon=true"> <img src="res/water-icon.png" alt="Wasser-Icon" > </a>
		</div>
		
		<div id="fireIcon">
			<a href="index.php?fireIcon=true"> <img src="res/fire-icon.png" alt="Feuer-Icon" > </a>
		</div>
		
		<div id="leafIcon">
			<a href="index.php?leafIcon=true"> <img src="res/leaf-icon.png" alt="Blatt-Icon" > </a>
		</div>
		
		<div id="buterflyIcon">
			<a href="index.php?butterflyIcon=true"> <img src="res/butterfly-icon.png" alt="Schmetterling-Icon" > </a>
		</div>
		
		<?php
			if(!isset($_SESSION['popupWindow']))
			{
				$_SESSION['popupWindow'] = "undefined";
			}
			
			if(isset($_GET['waterIcon']))
			{
				$_SESSION['popupWindow'] = "water";
			}
			
			if(isset($_GET['fireIcon']))
			{
				$_SESSION['popupWindow'] = "fire";
			}
			if(isset($_GET['leafIcon']))
			{
				$_SESSION['popupWindow'] = "leaf";
			}
			if(isset($_GET['butterflyIcon']))
			{
				$_SESSION['popupWindow'] = "butterfly";
			}
			
			switch($_SESSION['popupWindow'])
			{
				case "water":
					include("popupWindow.php");
					break;
					
				case "fire":
					include("popupWindow.php");
					break;
					
				case "leaf":
					include("popupWindow.php");
					break;
					
				case "butterfly":
					include("popupWindow.php");
					break;
					
				default:
					break;
			}
		
		?>
		