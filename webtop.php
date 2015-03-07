		<div id="waterIcon">
			<a href="index.php?waterIcon=true&fireIcon=$fireIcon&leafIcon=$leafIcon&butterflyIcon=$butterflyIcon"> <img src="water-icon.png" alt="Wasser-Icon" > </a>
		</div>
		
		<div id="fireIcon">
			<a href="index.php?waterIcon=$waterIcon&fireIcon=true&leafIcon=$leafIcon&butterflyIcon=$butterflyIcon"> <img src="fire-icon.png" alt="Feuer-Icon" > </a>
		</div>
		
		<div id="leafIcon">
			<a href="index.php?waterIcon=$waterIcon&fireIcon=$fireIcon&leafIcon=true&butterflyIcon=$butterflyIcon"> <img src="leaf-icon.png" alt="Blatt-Icon" > </a>
		</div>
		
		<div id="buterflyIcon">
			<a href="index.php?waterIcon=$waterIcon&fireIcon=$fireIcon&leafIcon=$leafIcon&butterflyIcon=true"> <img src="butterfly-icon.png" alt="Schmetterling-Icon" > </a>
		</div>
		
		<?php
			if($_GET['waterIcon'])
			{
				include('popupWindow?head="Water".php');
			}
			if($_GET['fireIcon'])
			{
				include('popupWindow?head="Fire".php');
			}
			if($_GET['leafIcon'])
			{
				include('popupWindow?head="Leaf".php');
			}
			if($_GET['butterflyIcon'])
			{
				include('popupWindow?head="Butterfly".php');
			}
		
		
		?>
		