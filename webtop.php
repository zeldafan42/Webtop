<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	</head>
	
	<body>
		<div id="waterIcon">
			<a href="webtop.php?waterIcon=true&fireIcon=$fireIcon&leafIcon=$leafIcon&butterflyIcon=$butterflyIcon"> <img src="water-icon.png" alt="Wasser-Icon" > </a>
		</div>
		
		<div id="fireIcon">
			<a href="webtop.php?waterIcon=$waterIcon&fireIcon=true&leafIcon=$leafIcon&butterflyIcon=$butterflyIcon"> <img src="fire-icon.png" alt="Feuer-Icon" > </a>
		</div>
		
		<div id="leafIcon">
			<a href="webtop.php?waterIcon=$waterIcon&fireIcon=$fireIcon&leafIcon=true&butterflyIcon=$butterflyIcon"> <img src="leaf-icon.png" alt="Blatt-Icon" > </a>
		</div>
		
		<div id="buterflyIcon">
			<a href="webtop.php?waterIcon=$waterIcon&fireIcon=$fireIcon&leafIcon=$leafIcon&butterflyIcon=true"> <img src="butterfly-icon.png" alt="Schmetterling-Icon" > </a>
		</div>
		
		<?php
			if($_GET['waterIcon'])
			{
				include('popupWindowWater.php');
			}
			if($_GET['fireIcon'])
			{
				include('popupWindowFire.php');
			}
			if($_GET['leafIcon'])
			{
				include('popupWindowLeaf.php');
			}
			if($_GET['butterflyIcon'])
			{
				include('popupWindowButterfly.php');
			}
		
		
		?>
		
		
	</body>
</html>