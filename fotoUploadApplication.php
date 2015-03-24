<form id="upload" method="post" action="upload.php" enctype="multipart/form-data">
	<input type="file" name="upl" multiple />
	<div id="drop">
		<p id=dropText>
			Drop Here
		</p>
		<input type="file" name="upl" multiple />
		<input type="hidden" name="MAX_FILE_SIZE" value="1024000" />
	</div>
	<div id="response">
		<?php
			if(isset($_GET['delete'])){
				unlink($_GET['delete']);
			}
			
			if(!is_dir("./uploads"))
			{
				mkdir("./uploads");
			}
			
			$fileHandle = opendir("./uploads/");
			
			while($myFile = readdir($fileHandle)){
				if($myFile != "." && $myFile != ".."){
					echo "<p>";
					echo "<img src='./uploads/".$myFile."'><a href='index.php?delete=./uploads/".$myFile."'>Delete</a>";
					echo "</p>";
				}
			}
		?>
	
	</div>
</form>