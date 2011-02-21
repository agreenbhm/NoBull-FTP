<?php

session_start(); // Start session

include 'top.inc'; //Include header file

if(!isset($_POST['login'])) //If NOT re-loading this page as a result of a login
{
	if(isset($_SESSION['name']) && isset($_FILES['uploadedfile']) && !empty($_FILES['uploadedfile']['tmp_name'])) //If logged in and trying to upload
	{
			$target_path = "tmp/"; // Where the file is going to be stored on the server temporarily before upload via FTP

			$filename = basename( $_FILES['uploadedfile']['name']); //Name of file to be uploaded (without path).
			
			$target_fullname = $target_path . basename( $_FILES['uploadedfile']['name']); //Full path on the server that file will be held (including file name)
			
			//Upload 2 Begin
			
			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_fullname)) //Transfer file to temp location on web server 
			{ 
				
			} 
			
			else //If unable to transfer file to web server temp location
			{
				echo "There was an error uploading the file to the server for FTP transfer, please try again!"; //Error message
			}

			//Start FTP code block
			
			$source = $target_fullname; //File to be FTP'd, including path, in temp location on web server
			$dest = $filename; //Destination filename (and eventually, in later code, path) on FTP server
			
			if($conn_id = ftp_connect($_SESSION['ftp_server'], $_SESSION['ftp_port'], 30)) //If able to connect to FTP server
			{
				echo "Session Connected<br>";  //Diagnostic message
			
				if(@ftp_login($conn_id, $_SESSION['ftp_user'], $_SESSION['ftp_pw'])) //If login to FTP server using cached credentials is successful
				{					
					$upload = ftp_put($conn_id, $dest, $source, $_SESSION['ftp_mode']); //Transfer file to FTP using temp file as source
					
					if ($upload) //If successfully uploaded via FTP
					{
						echo 'FTP upload of ' . $dest . ' was successfull!';
						ftp_close($conn_id);
					}

					elseif (!$upload) //If FTP upload is unsuccessful
					{ 
						echo 'FTP upload of ' . $dest . ' failed!'; 
						ftp_close($conn_id); //Close FTP session
					}
					
				}// End if logged in successfully
			}// End if able to connect
			
			elseif(!$conn_id)
			{
				echo "Session Unable to Connect<br>"; //Diagnostic message
			}
			//End FTP code block
			
			include 'upload_form.inc'; //Include form to upload files

			unlink($source); //Delete file from temp directory on webserver
			
	} //end if logged in and uploading


	elseif (!isset($_SESSION['name']) && !isset($_POST['logout'])) //If not logged in
	{
		echo "You must be logged in to upload";
	} //end if not logged in
	
	elseif (isset($_SESSION['name']) && isset($_FILES['uploadedfile']) && empty($_FILES['uploadedfile']['tmp_name'])) //If no file selected to upload but button pressed
	{
		echo "No file selected to upload";
		
		include 'upload_form.inc'; //Include form to upload files

	} //End error handling	
	
} //End if NOT submitting login form

if (isset($_SESSION['name']) && !isset($_FILES['uploadedfile'])) //If page loaded and user logged in but has not submitted file to upload
{
	include 'upload_form.inc'; //Include form to upload files
} //end if page loaded but file upload form not submitted

elseif (!isset($_SESSION['name']) && isset($_POST['logout'])) //If user submitted logout form
{
	echo "You must be logged in to upload";
} //end if user not logged in but page loaded directly

if(isset($_SESSION['name'])) //if logged in then list contents
{
	include ("list_contents.php");
} //end if logged in then list contents

include 'bot.inc'; //Include footer file

?>