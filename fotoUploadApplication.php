<form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
	<input type="file" name="upl" multiple />
	<div id="drop">
		<p id=dropText>
			Drop Here
		</p>
		<input type="file" name="upl" multiple />
		<input type="hidden" name="MAX_FILE_SIZE" value="2024000" />
	</div>
	<div id="response">
		<?php
			if(isset($_GET['delete'])){
				unlink("uploads/".$_GET['delete']);
				unlink("uploads/thumbs/".$_GET['delete']);
				unlink("uploads/backup/".$_GET['delete']);
			}
			
			if(isset($_GET['undo']))
			{
				restore_image($_GET['undo']);
			}
			
			if(isset($_GET['grayscale']))
			{
				gray_scale($_GET['grayscale']);
			}
			
			if(isset($_GET['rotateLeft']))
			{
				rotate($_GET['rotateLeft'],90);
			}
			
			if(isset($_GET['rotateRight']))
			{
				rotate($_GET['rotateRight'],-90);
			}
			
			if(isset($_GET['mirror']))
			{
				mirror($_GET['mirror']);
			}
			
			if(isset($_GET['crop']))
			{
				echo '<script> crop("'.$_GET['crop'].'");</script>';
			}
			
			if(isset($_GET['cropImg']) && isset($_GET['cropLeft']) && isset($_GET['cropTop']) && isset($_GET['cropWidth']) && isset($_GET['cropHeight']))
			{
				cropImg($_GET['cropImg'],$_GET['cropLeft'],$_GET['cropTop'],$_GET['cropWidth'],$_GET['cropHeight']);
			}
			
			if(!is_dir("./uploads"))
			{
				mkdir("./uploads");
			}
			
			show_pics();
		?>
	
	</div>
</form>