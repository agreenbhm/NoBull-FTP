<?php

$loginerror = false;
$userlogin = false;
$connect_error = false;

	
if(!isset($_POST['login'])) //if user has NOT submitted login form
{
      echo "Login not posted";
} //end if user has not submitted login form
	
if(isset($_POST['login'])) //if user is logging in
{

	//start ftp
	
	$username = $_POST['username'];
	$pw = $_POST['passw'];
	
	echo $_SESSION['ftp_server'] = $server = gethostbyname("localhost");
	echo $_SESSION['ftp_port'] = $port = "21";
	//echo $_SESSION['timeout_time'] = "30";
	echo $_SESSION['ftp_user'] = $ftp_user_name = trim($username);
	echo $_SESSION['ftp_pw'] = $ftp_user_pass = trim($pw);
	echo $_SESSION['ftp_mode'] = $mode = FTP_BINARY;
	
	if ($conn_id = ftp_connect($_SESSION['ftp_server'], $_SESSION['ftp_port'], 10)) // If able to connect to FTP server
	{
	
		if ($login = @ftp_login($conn_id, $_SESSION['ftp_user'], $_SESSION['ftp_pw'])) //Then attempt to login using entered creds
		{
			echo('Successfully connected & logged in to ' . $server . ' as ' . $ftp_user_name . ' <br><br>');
			$userlogin = true; //Set logged in status to true
			//ftp_close($conn_id);

		} // End if succesfully logged in
		
		elseif (!$login) //If unable to login
		{
			echo('Login unsuccessful.  Please check your login credentials.');
			$userlogin = false; //Set logged in status to false
			//ftp_close($conn_id);
		}
		
	} //End if successful connection
	
	else //If unable to establish connection to FTP
	{
		$userlogin = false; //Set logged in status to false
		$connect_error = true;
		session_unset(); //Remove entereed creds from session
		session_destroy(); //Kill session
		echo ('FTP server unreachable.  Please try again later.');
	}
	
	//End FTP code

	if ($userlogin) //If user is logged in
	{
		echo 'userlogin=true.-----------------------------';
		$_SESSION['name'] = $ftp_user_name;
	}
	
	elseif (!$userlogin) //If user is not logged in
	{
		echo 'userlogin=false.-----------------------------';
		$loginerror = true;
	}




} //End if user has submitted login form


if(isset($_POST['logout'])) //If user has submitted logout form
{
	session_unset();
	session_destroy();
}

?>

<link rel="stylesheet" type="text/css" href="style.css">
<font face="News Topic MT" size="3" color="black">

<center>

<?php

if(isset($_SESSION['name'])) 
{
	$dispname = $_SESSION['name'];
	echo "You are logged in as $dispname.  <a href=account.php>Click here to view your account.</a>";
	include("./logout.inc");

}

elseif($loginerror && !$connect_error)
{
	echo "Incorrect username and/or password.  Please try again.";
	include("./login.inc");
}


elseif($connect_error)
{
	echo "Unable to contact the FTP server.  Please try again.";
	include("./login.inc");
}


else
{
	echo "You are not logged in.";
	include("./login.inc");
}

?>

<?php

if(!isset($_SESSION['name']))
{
$projects = "register.php";
}

?>



