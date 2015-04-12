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
			}
			
			if(!is_dir("./uploads"))
			{
				mkdir("./uploads");
			}
			
			$fileHandle = opendir("./uploads/");
			
			while($myFile = readdir($fileHandle)){
				if(!is_dir("./uploads/".$myFile)){
					echo "<p>";
					echo "<a class=\"fancybox\" rel=\"group\" href=\"./uploads/".$myFile."\"><img src=\"./uploads/thumbs/".$myFile."\"></a><a href=\"index.php?delete=".$myFile."\">Delete</a>";
					echo "</p>";
				}
			}
		?>
	
	</div>
</form>