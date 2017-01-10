<?php
// Made by astron-dev; Pls give credit if youre using my Code.
// Connection for MySQL
$dbhost   = "localhost";
$dbname   = "test";
$dbuser   = "root";
$dbpass   = "root";
//variables for MySQL
$user     = mysql_real_escape_string($_GET['username']);
$pass     = mysql_real_escape_string($_GET['password']);
$sendhwid = mysql_real_escape_string($_GET['hwid']);
$akt      = "true";

//MySQL Connection
mysql_connect($dbhost, $dbuser, $dbpass) or die("Could not connect: " . mysql_error());
$verb = mysql_select_db($dbname);
if ($verb) {
    $sql = "SELECT * FROM enteryourname WHERE username='" . $user . "'";
    $quer = mysql_query($sql) or die(mysql_error());
    $num = mysql_num_rows($quer);
    if ($num == 0) {
        die("User does not exist");
    } else {
        $row       = mysql_fetch_object($quer);
        $password  = $row->password;
        $activated = $row->activated;
        $hwid      = $row->hwid;
        if ($password == $pass) {
            if ($aktiv != "true") {
                die("User is not activated!");
            }
            if ($sendhwid != $hwid) {
                die("wronghwid");
            }
            die("success");
        }
    }
}
?>
