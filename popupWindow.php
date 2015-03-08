<div class=popup>
	<div class=popupHeader>
		<h2>
			<?php 
				echo $_SESSION['popupWindow'];
			?>
		</h2>
		<a href="index.php?closePopup=true"><img src="res/x_for_closing.png" alt="X for closing this window"></a>
	</div>
	<div id="popupContent">
		<?php 
			echo phpinfo();
		?>
	</div>
	

	
</div>
	
