<?php
class RssWriter
{
	private $rssHandler;
	
	function __construct()
	{
		$this->rssHandler = new RssDatabase();
	}
	
	function writeToRss($headid)
	{
		$data = $this->rssHandler->fetchEntries($headid, 10);
		$feed =$this->rssHandler->fetchFeed($headid);
		$rssObject = new SimpleXMLElement('<rss version="2.0"></rss>');
		$rssObject->addChild("channel");
		$rssObject->channel->addChild("title",$feed['title']);
		$rssObject->channel->addChild("description",$feed['description']);
		$rssObject->channel->addChild("link",$feed['link']);
		$rssObject->channel->addChild("category",$feed['category']);
		$i = 0;
		
		if($data)
		{
			foreach ($data as $item)
			{
				$rssObject->channel->addChild("item");
				$rssObject->channel->item[$i]->addChild("title",$item['title']);
				$rssObject->channel->item[$i]->addChild("description",$item['description']);
				$rssObject->channel->item[$i]->addChild("link",$item['link']);
				$rssObject->channel->item[$i]->addChild("author",$item['author']);
				$i++;
			}
		}
		$rssObject->asXML($feed['title'].".rss");
		
	}
	
	function __destruct()
	{
		unset($this->rssHandler);
	}
}