<div id="hateYouJS" class="popup"  <?php if(isset($_SESSION['hateYouJS'])){echo "style=\"".$_SESSION['hateYouJS']."\"";}?>>
	<div class="popupHeader">
		<h2>
			<?php 
				echo $_SESSION['popupWindow'];
			?>
		</h2>
		<a href="index.php?closePopup=true"><img src="res/x_for_closing.png" alt="X for closing this window"></a>
	</div>
	<div id="popupContent">
		<?php 
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
		?>
	</div>
	
</div>
	
