<?php

if($conn_id = ftp_connect($_SESSION['ftp_server'], $_SESSION['ftp_port'], 30)) //If able to connect to FTP server
{
	echo "Session Connected<br><br>";  //Diagnostic message

	if(@ftp_login($conn_id, $_SESSION['ftp_user'], $_SESSION['ftp_pw'])) //If login to FTP server using cached credentials is successful
	{	
		echo "Logged in to FTP, list contents<br><br>";
		$contents = ftp_nlist($conn_id, ".");
		sort($contents);
		
		foreach($contents as $i) //List remote folders
		{
			if(ftp_size($conn_id, $i) == -1)
			{
				//echo "[ " . $i . " ]<br>\n";
				echo $i . "<br>";
			}
			
		} //End list remote  folders

		foreach($contents as $i) //List remote files
		{
			if(ftp_size($conn_id, $i) !== -1)
			{
				//echo $i . "<br>\n";
				echo $i . "<br>";
			}
		} //End list remote files		
	} //End if able to login
	
	echo "<br><br>";
		
}// End if able to connect

elseif(!$conn_id)
{
	echo "Session Unable to Connect<br>"; //Diagnostic message
}
?>
