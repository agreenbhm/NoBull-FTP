<?php

session_start(); // Start session

include 'top.inc'; //Include header file

if(!isset($_POST['login'])) //If NOT re-loading this page as a result of a login
{
	if(isset($_SESSION['name']) && isset($_FILES['uploadedfile'])) //If logged in and trying to upload
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
			
			$conn_id = ftp_connect($_SESSION['ftp_server'], $_SESSION['ftp_port'], 30); //Open FTP connection using cached login credentials
			
			// -------------Diagnostic info regarding ftp_connect----------------
			if($conn_id) //If able to connect to FTP server
			{
				echo "Session Connected";
			}
			elseif(!$conn_id)
			{
				echo "Session Unable to Connect<br>";
			}
			// ----------------End diagnostic info------------------
			
			if(ftp_login($conn_id, $_SESSION['ftp_user'], $_SESSION['ftp_pw'])) //If login to FTP server using cached credentials is successful
			{
				$upload = ftp_put($conn_id, $dest, $source, $_SESSION['ftp_mode']); //Transfer file to FTP using temp file as source

				if ($upload) //If successfully uploaded via FTP
				{
				    echo 'FTP upload of ' . $dest . ' was successfull!';
					ftp_close($conn_id);
				    unlink($source); //Delete file from temp directory on webserver
				}

				elseif (!$upload) //If FTP upload is unsuccessful
				{ 
					echo 'FTP upload of ' . $dest . ' failed!'; 
					ftp_close($conn_id); //Close FTP session
				}
			}

			//End FTP code block

	}


	else //If not logged in
	{
		echo "You must be logged in to upload";
	}

} //End if NOT submitting login form

include 'upload_form.inc'; //Include form to upload files

include 'bot.inc'; //Include footer file

?>