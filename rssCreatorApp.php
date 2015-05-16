<?php
require_once('RssDatabase.php');
require_once ('RssWriter.php');

$rssHandler = new RssDatabase();
$rssWriter = new RssWriter();

if(isset($_POST['rssHeaderAdd']))
{
	if(isset($_POST['rssHeaderTitle'],$_POST['rssHeaderLink'], $_POST['rssHeaderDescription'], $_POST['rssHeaderCategory']))
	{
		$rssHandler->addRssHeader($_POST['rssHeaderTitle'], $_POST['rssHeaderLink'], $_POST['rssHeaderDescription'], $_POST['rssHeaderCategory']);
	}
}

if(isset($_POST['rssContentAdd']))
{
	if(isset($_POST['rssContentReferenceId'], $_POST['rssContentTitle'], $_POST['rssContentLink'], $_POST['rssContentDescription'], $_POST['rssContentAuthor']))
	{
		$rssHandler->addRssContent($_POST['rssContentReferenceId'],$_POST['rssContentTitle'], $_POST['rssContentLink'], $_POST['rssContentDescription'], $_POST['rssContentAuthor']);
		$rssWriter->writeToRss($_POST['rssContentReferenceId']);
	}
}
if(isset($_POST['rssContentUpdate']))
{
	if(isset($_POST['rssContentUpdateId'], $_POST['rssContentTitle'], $_POST['rssContentLink'], $_POST['rssContentDescription'], $_POST['rssContentAuthor']))
	{
		$rssHandler->updateEntry($_POST['rssContentUpdateId'],$_POST['rssContentTitle'], $_POST['rssContentLink'], $_POST['rssContentDescription'], $_POST['rssContentAuthor']);
		$rssWriter->writeToRss($_POST['rssContentUpdateId']);
	}
}

if(isset($_POST['rssContentDelete']))
{
	if(isset($_POST['rssContentDeleteId']))
	{
		$rssHandler->deleteEntry($_POST['rssContentDeleteId']);
		$rssWriter->writeToRss($_POST['rssFeedUpdateId']);
	}
}

if(isset($_POST['rssHeaderDelete']))
{
	if(isset($_POST['rssHeaderDeleteId']))
	{
		$rssFile = $rssHandler->fetchFeed($_POST['rssHeaderDeleteId'])["title"].".rss";
		if(file_exists($rssFile))
		{
			unlink($rssFile);
		}
		$rssHandler->deleteFeed($_POST['rssHeaderDeleteId']);

	}
}





?>

<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Add Feed</a></li>
		<li><a href="#tabs-2">Add Content</a></li>
		<li><a href="#tabs-3">Edit Feed</a></li>
	</ul>
	<div id="tabs-1">
		<form action="index.php" method="POST">
			<input type="text" name="rssHeaderTitle" placeholder="Title"/>
			<input type="text" name="rssHeaderLink" placeholder="Link"/>
			<input type="text" name="rssHeaderDescription" placeholder="Description"/>
			<input type="text" name="rssHeaderCategory" placeholder="Category"/>
			<input type="submit" name="rssHeaderAdd" value="Add Feed"/>
		</form> 
		
		
	</div>
	<div id="tabs-2">
		<form action="index.php" method="POST">
			<select name="rssContentReferenceId">
				<?php
					$headers = $rssHandler->fetchFeeds();
					foreach ($headers as $arg)
					{
						echo '<option value="'.$arg['id'].'">'.$arg['title'].'</option>';
					}
				?>
			</select>
			<input type="text" name="rssContentTitle" placeholder="Title"/>
			<input type="text" name="rssContentLink" placeholder="Link"/>
			<input type="text" name="rssContentDescription" placeholder="Description"/>
			<input type="text" name="rssContentAuthor" placeholder="Author"/>
			<input type="submit" name="rssContentAdd" value="Add Entry to feed"/>
		</form> 
	
	
	</div>
	<div id="tabs-3">
		<select name="rssContentReferenceId" onChange="fetchFeed(this.value, 0)" required>
			<option disabled selected> --select Feed--</option>
			<?php
				$headers = $rssHandler->fetchFeeds();
				foreach ($headers as $arg)
				{
					echo '<option value="'.$arg['id'].'">'.$arg['title'].'</option>';
				}
			?>
		</select>
		<div id="rssFetchResult">
		
		
		</div>
		
		<a onClick="fetchFeeds(this.value, 2)"></a>
		
	</div>
</div>