<?php
// Made by astron. Pls give Credit if you use my Code
// Connection Info for MySQL
$dbhost = "localhost";
$dbname = "test";
$dbuser = "root";
$dbpass = "root";
// Variables (secure)
$username = mysql_real_escape_string($_GET['user']);
$checktoken = mysql_real_escape_string($_GET['token']);
// Connection
mysql_connect($dbhost, $dbuser, $dbpass)or die("Could not connect: ".mysql_error());
$verb = mysql_select_db($dbname);
if ($verb)
{
	echo("Succesfully connected!");
		if ($username == "")
			echo("<br>Errorcode: <b>3</b>");
	else
		{
			if (!$checktoken == "YOURTOKEN")
				echo("<br>Errorcode: <b>8</b>");
			else
			{
				$entry = mysql_query("UPDATE test SET aktiv='false' WHERE username='$username'");
				if ($entry)
					{echo('<br>DONE');}
				else
					{die("<br>Errorcode: <b>5</b>");}
			}
		}
}
else
	{
		die('<br>Errorcode: <b>6</b>');
	}
	
mysql_close();
?>
