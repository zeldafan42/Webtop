<select name="rssContentReferenceId" onChange="fetchFeedFile(this.value)" required>
<option disabled selected> --select Feed--</option>
<?php
require_once('RssDatabase.php');
	$rssHandler = new RssDatabase();
	$headers = $rssHandler->fetchFeeds();
	foreach ($headers as $arg)
	{
		echo '<option value="'.$arg['title'].'.rss">'.$arg['title'].'</option>';
	}
?>
		</select>
		<div id="rssFetchFileResult">
		
		
		</div>