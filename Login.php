<?php
// Made by astron-dev; Pls give credit if youre using my Code.
// Connection for MySQL
$dbhost = "localhost";
$dbname = "test";
$dbuser = "root";
$dbpass = "root";
//variables for MySQL
$user = $_GET['username'];
$pass = $_GET['password'];
$sendhwid = $_GET['hwid'];
$akt = "true";

//MySQL Connection
mysql_connect($dbhost, $dbuser, $dbpass)or die("Could not connect: ".mysql_error());
$verb = mysql_select_db($dbname);
if ($verb)
{
	$sql = "SELECT * FROM enteryourname WHERE username='".$user."'";
	$quer = mysql_query($sql) or die(mysql_error());
	$num = mysql_num_rows($quer);
	if ($num == 0)
	{
			echo("User does not exist");
			exit();
	}
	
	else 
	{
			$row = mysql_fetch_object($quer);
			$password = $row->password;
			$activated = $row->activated;
			$hwid = $row->hwid;
			if ($password == $pass)
			{
			if ($aktiv != "true")
			{
				echo("User is not activated!");
				exit();
			}
			if ($sendhwid != $hwid)
			{
				echo("HWID Invalid");
				exit();
			}
				  echo("success");
			}
	}
}
?>