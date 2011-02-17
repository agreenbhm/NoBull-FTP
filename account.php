<?php session_start();
include("top.inc");
?>

<?php
$con = mysql_connect("localhost","root","password");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("support", $con);

$query  = "SELECT id, name, email FROM users";
$result = mysql_query($query);

//echo $_SESSION['name'];

while($row = mysql_fetch_array($result, MYSQL_ASSOC))
{
    if($row['name'] == $_SESSION['name'])
	{
		$id = $row['id'];
		echo "Username: " . $row['name'];
		echo "<br>";
		$email = $row['email'];
		echo "Email: $email"; // . $row['email'];
		echo "<br>";
	}
	
}


if(isset($_POST['changepw'])) //if change password button is pressed (to open changepw page)
{
	include("pwchange.inc");
}

if(isset($_POST['pwchange'])) 
{
	$pwmatch = "";
	$pw = $_POST['pw'];
	$pw2 = $_POST['pw2'];
	
	if($pw != $pw2)
	{
		echo "<br>Passwords do not match.  Please try again.";
		echo "<br><br>";
		$pwmatch = "false";
		include("pwchange.inc");
	}

	if($pw == $pw2)
	{
			$pw = crypt($pw, CRYPT_MD5);

			if (!$con)
  			{
  				die('Could not connect: ' . mysql_error());
  			}

			mysql_select_db("support", $con);
				
			if (mysql_query("UPDATE users SET pass = '$pw' WHERE id = '$id' LIMIT 1"))
			{
				echo "<br>Password change successful.<br><br>";
				echo "You should receive an email confirming this change shortly.<br>";
				$message = "You have successfully changed your password at agreenbhm.com.  Your new password is: $pw2.";
				mail( $email, "Password change confirmation from agreenbhm.com", $message, "From: agreenbhm@nc.rr.com" );
			}
 
			else
			{
				echo "<br>Password change unsuccessful.<br>";
			} 
					
	}//end if

} //end if isset

if($_SESSION['name'] && !isset($_POST['changepw']) && $pwmatch != "false")
{
	echo "<br><form action=\"account.php\" method=\"POST\"><input type=\"hidden\" name=\"changepw\"><table border=\"0\" cellpadding=\"5\"><input type=\"submit\" value=\"Change Password\"></table></form>";
}



include("bot.inc"); 

?>
