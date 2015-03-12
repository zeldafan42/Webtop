		<?php
			if(!isset($_SESSION['startMenu']))
			{
				$_SESSION['startMenu'] = false;
			}
			
			if(!isset($_SESSION['popupWindow']) || isset($_GET['closePopup']))
			{
				$_SESSION['popupWindow'] = "undefined";
				header('Location: '.$_SERVER['PHP_SELF']);
			}
			
			if(isset($_GET['waterIcon']))
			{
				$_SESSION['popupWindow'] = "Water";
				header('Location: '.$_SERVER['PHP_SELF']);
			}
			
			if(isset($_GET['fireIcon']))
			{
				$_SESSION['popupWindow'] = "Fire";
				header('Location: '.$_SERVER['PHP_SELF']);
			}
			if(isset($_GET['leafIcon']))
			{
				$_SESSION['popupWindow'] = "Leaf";
				header('Location: '.$_SERVER['PHP_SELF']);
			}
			if(isset($_GET['butterflyIcon']))
			{
				$_SESSION['popupWindow'] = "Butterfly";
				header('Location: '.$_SERVER['PHP_SELF']);
			}
			if(isset($_GET['openMenu']))
			{
				toggleStartMenu();
				header('Location: '.$_SERVER['PHP_SELF']);
			}
			
			function toggleStartMenu()
			{
					$_SESSION['startMenu']=!$_SESSION['startMenu'];
			}
			
			echo "<h1> Welcome ".$_SESSION['username']."</h1>";
		?>
		
		
		<div id="waterIcon" class="webtopIcon">
			<a href="index.php?waterIcon=true"> <img src="res/water-icon.png" alt="Wasser-Icon" > </a>
		</div>
		
		<div id="fireIcon" class="webtopIcon">
			<a href="index.php?fireIcon=true"> <img src="res/fire-icon.png" alt="Feuer-Icon" > </a>
		</div>
		
		<div id="leafIcon" class="webtopIcon">
			<a href="index.php?leafIcon=true"> <img src="res/leaf-icon.png" alt="Blatt-Icon" > </a>
		</div>
		
		<div id="buterflyIcon" class="webtopIcon">
			<a href="index.php?butterflyIcon=true"> <img src="res/butterfly-icon.png" alt="Schmetterling-Icon" > </a>
		</div>
		
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
		
		