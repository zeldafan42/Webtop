		<?php
			if(!isset($_SESSION['startMenu']))
			{
				$_SESSION['startMenu'] = false;
			}
			
			if(!isset($_SESSION['popupWindow']) || isset($_GET['closePopup']))
			{
				$_SESSION['popupWindow'] = "undefined";
			}
			
			if(isset($_GET['waterIcon']))
			{
				$_SESSION['popupWindow'] = "Water";
			}
			
			if(isset($_GET['fireIcon']))
			{
				$_SESSION['popupWindow'] = "Fire";
			}
			if(isset($_GET['leafIcon']))
			{
				$_SESSION['popupWindow'] = "Leaf";
			}
			if(isset($_GET['butterflyIcon']))
			{
				$_SESSION['popupWindow'] = "Butterfly";
			}
			if(isset($_GET['openMenu']))
			{
				toggleStartMenu();
			}
			
			function toggleStartMenu()
			{
					$_SESSION['startMenu']=!$_SESSION['startMenu'];
			}
			
			echo "<h1> Welcome ".$_SESSION['username']."</h1>";
		?>
		
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
		
		<div id="popupHandler">
			<?php 
				switch($_SESSION['popupWindow'])
				{
					case "Water":
						include("popupWindow.php");
						break;
						
					case "Fire":
						include("popupWindow.php");
						break;
						
					case "Leaf":
						include("popupWindow.php");
						break;
						
					case "Butterfly":
						include("popupWindow.php");
						break;
						
					default:
						break;
				}
			?>
		</div>
		
		<div id="taskbar">
			<?php 
			if(isset($_SESSION['startMenu']))
			{
				if($_SESSION['startMenu'])
				{
					include("startMenu.php");
				}
			}
			?>
			<?php
				include("taskbar.php")
			?>
			
		</div>
		
		