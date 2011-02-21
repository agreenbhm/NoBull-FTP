<?php
		session_start();
		
		if(isset($_SESSION['name']) && isset($_GET['ftp_get'])) //If logged in and trying to download
		{
			if($conn_id = ftp_connect($_SESSION['ftp_server'], $_SESSION['ftp_port'], 30)) //If able to connect to FTP server
			{
				//echo "Session Connected<br>";  //Diagnostic message
			
				if(@ftp_login($conn_id, $_SESSION['ftp_user'], $_SESSION['ftp_pw'])) //If login to FTP server using cached credentials is successful
				{	
					
					//echo "this is the current dir: " . $_GET['current_dir'] . "<br><br>";
					$full_filename = $_GET['current_dir'] . "/" . $_GET['ftp_get']; //original path & file name on FTP server
					
					//echo "this is the full filename: " . $full_filename . "<br><br>";
					
					$filename = basename($full_filename); //Name of file to be uploaded (without path).$_GET['ftp_get'];
					
					//echo "this is the basename: " . $filename . "<br><br>";
					@ftp_get($conn_id, './tmp/' . $filename, $full_filename, FTP_BINARY); //transfer file from FTP to temp folder
					
					$tmp_file = './tmp/' . $filename; //set full path & file name of temp file on server
					//echo $filename;
					
					
					function findexts ($filename)  //function to find extension of file
					{ 
						$filename = strtolower($filename) ; 
						$exts = split("[/\\.]", $filename) ; 
						$n = count($exts)-1; 
						$exts = $exts[$n]; 
						return $exts; 
					}  //end file extension finder
					
					$ext = findexts($filename); //set file type
					
					
					//echo " " . $ext . " ";		
					
					header('Cache-Control: public');
					header('Content-Description: File Transfer');
					header('Content-Disposition: attachment; filename="' . $filename . '"');
					header('Content-Type: application/' . $ext);
					header('Content-Length: ' . @filesize($tmp_file));
					header('Content-Transfer-Encoding: binary');
					@readfile($tmp_file); //Open temp file for download to browser
					@unlink($tmp_file); //Delete temp file from server
					
				}	
			}
		}
?>