<?php
	
if(!isset($_POST['login']))
{
      $loginerror = false;

      echo "Login not posted";
}
	
if(isset($_POST['login'])) 
{

	$username = $_POST['username'];
	$pw = $_POST['passw'];
	
	//start ftp

	echo $_SESSION['ftp_server'] = $server = gethostbyname("localhost");
	echo $_SESSION['ftp_port'] = $port = "21";
	echo $_SESSION['timeout_time'] = "30";
	echo $_SESSION['ftp_user'] = $ftp_user_name = trim($username);
	echo $_SESSION['ftp_pw'] = $ftp_user_pass = trim($pw);
	echo $_SESSION['ftp_mode'] = $mode = FTP_BINARY;
	
	
	//echo $dest = basename($target_path);
	//echo $source = $target_path;
	

	//$_SESSION['conn_id'] = 
	
	if ($conn_id = ftp_connect($_SESSION['ftp_server'], $_SESSION['ftp_port'], 30)) //Attempt to connect to FTP server
	{

	//$_SESSION['ftp_login'] = 
	
	//if ($conn_id) //If abble to establish connection
	//{
		if ($login = ftp_login($conn_id, $_SESSION['ftp_user'], $_SESSION['ftp_pw'])) //Then attempt to login using entered creds
		{
		/*
		if (!$login)
		{
			session_unset();
			session_destroy();
			echo $username;
			echo $pw;
			$userlogin = false;
			$cred_error = true;
			include 'session_test.inc';
			//die('Incorrect login.  Please try again.');
			echo ('Incorrect login.  Please try again.');
			}
			*/
		
			//if ($login) //If able to login successfully
			//{ 
			echo('Successfully connected & logged in to ' . $server . ' as ' . $ftp_user_name . ' <br><br>');
			
			//$_SESSION['name'] = $ftp_user_name;
			$userlogin = true;
		//}
		} // End if succesfully logged in
		
		else //if unable to login
		{
			echo('Login unsuccessful.  Please check your login credentials.');
			$userlogin = false;
		}
		/*
		elseif (!$conn_id || !$login) 
		{ 
			session_unset();
			session_destroy();
			$userlogin = false;
			//$loginerror = true;
			die('FTP connection attempt failed!');
		}
		*/
		//end ftp
		
	} //End if successful connection
	
	else //If unable to establish connection to FTP
	{
		$userlogin = false;
		session_unset();
		session_destroy();
		//die('FTP server unreachable.');
		echo ('FTP server unreachable.');
	}

					if ($userlogin = true)
					{
						echo 'userlogin=true.-----------------------------';
					}

					else
					{
						echo 'userlogin=false.-----------------------------';
					}



					if($userlogin)     
					{
						$_SESSION['name'] = $username;
						//$_SESSION['conn_id'] = $conn_id);
					}

					elseif(!$userlogin)
					{
						$loginerror = true;
					}


				}


				if(isset($_POST['logout']))
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

elseif($loginerror && $cred_error)
{
	echo "Incorrect username and/or password.  Please try again.";
	include("./login.inc");
}

elseif($loginerror && !$cred_error)
{
	echo "Unable to contact the FTP server.  Please try again.";
	include("./login.inc");
}

else //(!isset($_SESSION['name']))
{
	echo "You are not logged in.";
	include("./login.inc");
}

?>

<?php

//if(isset($_SESSION['name']))
//{
//$projects = $username . ".php";
//}

if(!isset($_SESSION['name']))
{
$projects = "register.php";
}

?>



