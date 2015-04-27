<?php

function ldap_login($loginname,$password)
{
	$ldapserver = "ldap.technikum-wien.at";
	$searchbase = "dc=technikum-wien,dc=at";
	
	$loginname = strtolower($loginname);
	$ds=ldap_connect($ldapserver);
	
	
	if (! $ds)
	{
		return false;
	}
	else
	{
		if (!ldap_bind($ds))
		{
			return false;
		}
		else
		{
			$filter="(&(uid=".$loginname.")(objectClass=posixAccount))";
			$sr = ldap_search($ds, $searchbase, $filter);
			if(!$sr) echo "search failed";
			$info=ldap_get_entries($ds,$sr);
			if(!$info) echo "No returns";
			
			if ($info["count"]==0)
			{
				return false;
			}
			else
			{
				$dn=$info[0]["dn"];
				// bind
				//$dn = "uid=".$loginname.", ou=People, dc=technikum-wien, dc=at";
				if(! @ldap_bind($ds, $dn, $password) || !$password) {
					return false;
				} else {
					unset($loginpw);
					return true;
				}
			}
			ldap_close($ds);
		}
	}
}

function database_login($loginname,$password)
{
	$connect = new mysqli("localhost", "root", "password", "brunnhilde");
	
	
	if(mysqli_connect_errno() == 0)
	{
		$stmt = $connect->prepare("SELECT password FROM user WHERE username = ?");
		$stmt->bind_param('s', $loginname);
		
		$stmt->execute();
		$stmt->bind_result($database_password);
		$stmt->free_result();
		$stmt->fetch();
		$stmt->close();
		

		$connect->close();
	}

	
	if(isset($database_password))
	{
		if(password_verify($password, $database_password))
		{
			return true;
		}
		else
		{
			echo "<p id=\"loginError\">Wrong username or password</p>";
			return false;
		}
	}
	else
	{
		echo "<p id=\"loginError\">Wrong username or password</p>";
		return false;
	}
}

function correctInput(&$array)
{
	$array = str_replace('\\', '', $array);
	$array = str_replace('\"', '', $array);
	$array = str_replace('\'', '', $array);
	$array = str_replace(';', '', $array);
	$array = str_replace('$', '', $array);
	$array = str_replace('(', '', $array);
	$array = str_replace(')', '', $array);
	$array = str_replace('[', '', $array);
	$array = str_replace(']', '', $array);
	$array = str_replace('{', '', $array);
	$array = str_replace('}', '', $array);
	$array = str_replace('=', '', $array);
	
	return $array;
	
}
?>
