<?php
// Made by astron-dev; Pls give credit if youre using my Code.
// Connection for MySQL
$dbhost   = "localhost";
$dbname   = "test";
$dbuser   = "root";
$dbpass   = "root";
//variables for MySQL
$email    = mysql_real_escape_string($_GET['email']);
$username = mysql_real_escape_string($_GET['user']);
$password = mysql_real_escape_string($_GET['pw5']);
$hwid     = mysql_real_escape_string($_GET['hwid']);

//MySQL Connection; Database info
mysql_connect($dbhost, $dbuser, $dbpass) or die("Could not connect: " . mysql_error());
$verb = mysql_select_db($dbname);
if ($verb) {
    if ($email == "" or $username == "" or $password == "") {
        if ($email == "")
            die("<br>Errorcode: <b>2</b>");

        if ($username == "")
            die("<br>Errorcode: <b>3</b>");

        if ($password == "")
            die("<br>Errorcode: <b>4</b>");
    } else {
        $request_email = "SELECT email FROM enteryourname WHERE email='$email'";
        $request_user  = "SELECT username FROM enteryourname WHERE username='$username'";
        $result_email  = mysql_query($request_email);
        $result_user   = mysql_query($request_user);
        if (mysql_num_rows($result_email) > 0 or mysql_num_rows($result_user) > 0) {
            die("<br>Errorcode: <b>1</b><br>Username or email already exists");
        } else {
            $sql = "INSERT INTO " . "enteryourname (username, password, email, hwid) " . "VALUES ('" . $username . "', '" . $password . "', '" . $email . "',
				'" . $hwid . "')";

            $entry = mysql_query($sql);
            if ($entry) {
                die('<br>FINISHED');
            } else {
                die("<br>Errorcode: <b>5</b>");
            }
        }
    }
} else {
    die('<br>Errorcode: <b>6</b>');
}

mysql_close();
?>
