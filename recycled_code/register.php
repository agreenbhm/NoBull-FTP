<?php

session_start(); // start session
include("top.inc");


echo "<center>";


if (isset($_POST['register'])) {

$username = $_POST['username'];
$pw = $_POST['pw'];
$pw2 = $_POST['pw2'];
$email = $_POST['email'];


if($pw == $pw2)
{
	$pw = crypt($pw, CRYPT_MD5);

	$con = mysql_connect("localhost","root","password");
	if (!$con)
 	 {
  	die('Could not connect: ' . mysql_error());
  	}

	mysql_select_db("support", $con);

	$query  = "SELECT name FROM users";
	$result = mysql_query($query);
	$userduplicate = "false";

	while($row = mysql_fetch_array($result, MYSQL_ASSOC))
	{
    		if($row['name'] == $username)
		{
		$userduplicate = "true";
		}

	}

	if($userduplicate == "false")
	{
		mysql_query("INSERT INTO users (name, pass, email) VALUES ('$username', '$pw', '$email')");
		echo "Registration successful.  You should receive an email containing your username and password shortly.";
		
  		$message = "Thank you for registering at agreenbhm.com.  Your username is: $username and your password is: $pw2.";
		mail( $email, "Registration confirmation from agreenbhm.com", $message, "From: agreenbhm@nc.rr.com" );
	}

	else
	{
	echo "Username " . $username . " is already taken.  Please choose another name.";
	include("register.inc");
	}

	mysql_close($con);
	//end mySQL


	}

else
{
echo "Passwords do not match.  Please try again.";
include("register.inc");
}

}


elseif(!isset($_POST['register']))
{
	include("register.inc");
}

include("bot.inc");
?>