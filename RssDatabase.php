<?php
class RssDatabase
{
	private $connection;
	
	
	function __construct()
	{
		$this->connection = new mysqli("localhost", "root", "password", "brunnhilde");
		if($this->connection->errno != 0)
		{
			die("Connection failed: " . $conn->connect_error);
		}
	}
	
	function addRssHeader($title,$link,$description,$category)
	{
		$title = correctInput($title);
		$link = correctInput($link);
		$description = correctInput($description);
		$category = correctInput($category);
		
		$stmt = $this->connection->prepare("INSERT INTO rssHeader (title,link,description,category) VALUES (?,?,?,?)");
		$stmt->bind_param("ssss", $title,$link,$description,$category);
		$stmt->execute();
		$id = $stmt->insert_id;
		$stmt->free_result();
		$stmt->close();
		
		return $id;
	}
	
	function addRssContent($headid,$title,$link,$description,$author)
	{
		if(!is_numeric($headid))
		{
			return false;
		}
		
		$title = correctInput($title);
		$link = correctInput($link);
		$description = correctInput($description);
		$author = correctInput($author);
	
		$stmt = $this->connection->prepare("INSERT INTO rssContent (fk_header_id,title,link,description,author) VALUES (?,?,?,?,?)");
		$stmt->bind_param("issss", $headid, $title,$link,$description,$author);
		$stmt->execute();
		$stmt->free_result();
		$stmt->close();
	}
	
	function updateEntry($id,$title,$link,$description,$author)
	{
		if(!is_numeric($id))
		{
			return false;
		}
	
		$title = correctInput($title);
		$link = correctInput($link);
		$description = correctInput($description);
		$author = correctInput($author);
	
		$stmt = $this->connection->prepare("UPDATE rssContent SET title= ?, link = ?, description = ?, author = ?, timestamp = DEFAULT WHERE id = ?");
		$stmt->bind_param("ssssi", $title,$link,$description,$author, $id);
		$stmt->execute();
		$stmt->free_result();
		$stmt->close();
	}
	
	function deleteEntry($id)
	{
		if(!is_numeric($id))
		{
			return false;
		}
		$stmt = $this->connection->prepare("DELETE FROM rssContent WHERE id = ?");
		$stmt->bind_param("i", $id);
				
		$stmt->execute();
		$stmt->free_result();
		$stmt->close();
	}
	
	function deleteFeed($headid)
	{
		if(!is_numeric($headid))
		{
			return false;
		}
		$stmt = $this->connection->prepare("DELETE FROM rssHeader WHERE id = ?");
		$stmt->bind_param("i", $headid);
				
		$stmt->execute();
		$stmt->free_result();
		$stmt->close();
	}
	
	function fetchFeeds()
	{
		$stmt = $this->connection->prepare("SELECT id, title FROM rssHeader");
		$stmt->execute();
		
		$stmt->bind_result($id,$title);
		$i = 0;
		
		while($stmt->fetch())
		{
			$response[$i]["id"] = $id;
			$response[$i]["title"] = $title;
			$i++;
		}
		
		$stmt->free_result();
		$stmt->close();
		return $response;
	}
	
	function getEntryCount($headid)
	{
		if(!is_numeric($headid))
		{
			return false;
		}
		
		$stmt = $this->connection->prepare("SELECT COUNT(*) FROM rssContent WHERE fk_header_id = ?");
		$stmt->bind_param("i", $headid);
		$stmt->execute();
		
		$stmt->bind_result($count);
		$stmt->fetch();
		$stmt->free_result();
		$stmt->close();
		return $count;
		
		
	}
	
	function getEntry($headid, $index)
	{
		if(!is_numeric($headid) || !is_numeric($index))
		{
			return false;
		}
		
		
		$stmt = $this->connection->prepare("SELECT id, title, link, description, author, timestamp FROM rssContent WHERE fk_header_id = ? ORDER BY timestamp DESC LIMIT ?,1");
		$stmt->bind_param("ii", $headid, $index);
		$stmt->execute();
		
		$stmt->bind_result($id,$title,$link,$description,$author,$timestamp);
		$stmt->fetch();
		
		if(!empty($id))
		{
			$response["id"] = $id;
			$response["title"] = $title;
			$response["link"] = $link;
			$response["description"] = $description;
			$response["author"] = $author;
			$response["timestamp"] = $timestamp;
		}
		else
		{
			return false;
		}
		
		$stmt->free_result();
		$stmt->close();
		return $response;
	}
	
	function fetchFeed($headid)
	{
		$stmt = $this->connection->prepare("SELECT title, description, link, category FROM rssHeader WHERE id = ?");
		$stmt->bind_param("i", $headid);
		$stmt->execute();
		
		$stmt->bind_result($title, $description, $link, $category);
		$stmt->fetch();
		
		$response["title"] = $title;
		$response["description"] = $description;
		$response["link"] = $link;
		$response["category"] = $category;
		
		$stmt->free_result();
		$stmt->close();

		
		return $response;
	}
	
	function fetchEntries($headid,$entryCount)
	{
		if(!is_numeric($headid) || !is_numeric($entryCount))
		{
			return false;
		}
		
		
		$stmt = $this->connection->prepare("SELECT title, link, description, author, timestamp FROM rssContent WHERE fk_header_id = ? ORDER BY timestamp DESC LIMIT ?");
		$stmt->bind_param("ii", $headid, $entryCount);
		$stmt->execute();
		
		$stmt->bind_result($title,$link,$description,$author,$timestamp);
		$i = 0;
		
		while($stmt->fetch())
		{
			$response[$i]["title"] = $title;
			$response[$i]["link"] = $link;
			$response[$i]["description"] = $description;
			$response[$i]["author"] = $author;
			$response[$i]["timestamp"] = $timestamp;
			$i++;
		}
		
		$stmt->free_result();
		$stmt->close();
		if(!empty($response))
		{
			return $response;
		}
		else 
		{
			return false;
		}
	}
	
	
	function __destruct()
	{
		$this->connection->close();
	}
	
	
}