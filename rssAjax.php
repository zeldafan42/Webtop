<?php
	require_once('RssDatabase.php');
	if(isset($_POST['fetchId'], $_POST['fetchIndex']))
	{
		$rssHandler = new RssDatabase();
		if(is_numeric($_POST['fetchId']) || is_numeric($_POST['fetchIndex']))
		{
			$entry = $rssHandler->getEntry($_POST['fetchId'], $_POST['fetchIndex']);
			if($entry)
			{
				echo
				'<form action="index.php" method="POST">
					<input type="text" name="rssContentTitle" value="'.$entry["title"].'"/>
					<input type="text" name="rssContentLink" value="'.$entry["link"].'"/>
					<input type="text" name="rssContentDescription" value="'.$entry["description"].'"/>
					<input type="text" name="rssContentAuthor" value="'.$entry["author"].'"/>
					<input type="hidden" name="rssContentUpdateId" value="'.$entry["id"].'"/>
					<input type="submit" name="rssContentUpdate" value="Update Entry"/>
				</form>
				<form action="index.php" method="POST">
					<input type="hidden" name="rssContentDeleteId" value="'.$entry["id"].'"/>
					<input type="hidden" name="rssFeedUpdateId" value="'.$_POST['fetchId'].'"/>
					<input type="submit" name="rssContentDelete" value="Delete Entry"/>	
				</form>
				<form action="index.php" method="POST">
					<input type="hidden" name="rssHeaderDeleteId" value="'.$_POST['fetchId'].'"/>
					<input type="submit" name="rssHeaderDelete" value="Delete Feed"/>	
				</form>
				</br>';
				$maxEntries = $rssHandler->getEntryCount($_POST['fetchId']);
				if($_POST['fetchIndex']>0)
				{
					$previousIndex = $_POST['fetchIndex']-1;
					echo '<a style ="float:left;" onClick="fetchFeed('.$_POST['fetchId'].','.$previousIndex.')">Previous</a>';
				}
				if($_POST['fetchIndex']<$maxEntries-1)
				{
					$nextIndex = $_POST['fetchIndex']+1;
					echo '<a style="float:right;" onClick="fetchFeed('.$_POST['fetchId'].','.$nextIndex.')">Next</a>';
				}
			}
			else
			{
				echo '<p id="rssFetchError">Nothing found!</p>';
				echo 
				'<form action="index.php" method="POST">
					<input type="hidden" name="rssHeaderDeleteId" value="'.$_POST['fetchId'].'"/>
					<input type="submit" name="rssHeaderDelete" value="Delete Feed"/>
				</form>';
			}
		}
	}
	
	if(isset($_POST['fetchFileId']))
	{
		$feed = new DOMDocument();
		$feed->load($_POST['fetchFileId']);
		
		$transform = new DOMDocument();
		$transform->load("rssTransform.xslt");
		
		$xslt = new XSLTProcessor();
		$xslt->importStylesheet($transform);
		
		print $xslt->transformToXml($feed);
	}