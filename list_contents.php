<?php
echo "<center>";

if($conn_id = ftp_connect($_SESSION['ftp_server'], $_SESSION['ftp_port'], 30)) //If able to connect to FTP server
{
	echo "Session Connected<br><br>";  //Diagnostic message

	if(@ftp_login($conn_id, $_SESSION['ftp_user'], $_SESSION['ftp_pw'])) //If login to FTP server using cached credentials is successful
	{	
		
		if(isset($_GET['ftp_parent']) && $_GET['ftp_parent'] == "true")  //If parameter passed to change directory
		{
			@ftp_chdir($conn_id, $_GET['ftp_currentdir']); //Set dir to current dir from previous page
			@ftp_chdir($conn_id, '../'); //Change dir to passed parameter
		} //End change directory
		
		if(isset($_GET['ftp_chdir']))  //If parameter passed to change directory
		{
			$chdir = $_GET['ftp_chdir']; //Set $chdir to passed parameter
			@ftp_chdir($conn_id, $chdir); //Execute change
		} //End change directory
		
		if(isset($_GET['ftp_get']))
		{
			include "downloader.php";
		}

		echo "Logged in to FTP, list contents<br><br>"; //Diagnostic message
		$current_dir = ftp_pwd($conn_id); //Set variable of current working directory
		echo 'Current directory:  "' . $current_dir . '"<br><br>'; //Output current directory
		
		echo '<a href="./uploader.php?ftp_currentdir=' . $current_dir . '&ftp_parent=true">(Up One Level)</a><br>';
		
		$contents = ftp_nlist($conn_id, "."); //Get contents of FTP folder
		sort($contents); //Sort FTP contents alphabetically
		
		foreach($contents as $i) //List remote folders
		{
			if(ftp_size($conn_id, $i) == -1)
			{
				$i = ltrim($i, "./"); //Remove leading ./ from name
				echo '<a href="./uploader.php?ftp_chdir=' . $current_dir . '/' . $i . '">[ ' . $i . ' ]</a></font><br>'; //Output folders & link to chdir
			}
			
		} //End list remote  folders

		foreach($contents as $i) //List remote files
		{
			if(ftp_size($conn_id, $i) !== -1)
			{
				$i = ltrim($i, "./"); //Remove  leading ./ from name
				echo '<a href="./uploader.php?ftp_get=' . $i . '">' . $i . '</a><br>'; //Output files & link to fget
			}
		} //End list remote files		
	} //End if able to login
	
	echo "<br><br>";
		
}// End if able to connect

elseif(!$conn_id)
{
	echo "Session Unable to Connect<br>"; //Diagnostic message
}

echo "</center>";
?>
