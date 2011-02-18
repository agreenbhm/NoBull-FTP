<?php
		$full_filename = $_GET['ftp_get'];
		$filename = basename($full_filename); //Name of file to be uploaded (without path).$_GET['ftp_get'];
		@ftp_get($conn_id, './tmp/' . $filename, $full_filename, FTP_BINARY);
		
		$tmp_path = './tmp' . $filename;
		echo $filename;
		
		/* Begin broken download code
		// Send file headers
		header("Content-type: application/pdf");
		header("Content-Disposition: attachment;filename=" . $filename);
		header("Content-Transfer-Encoding: binary");
		header('Pragma: no-cache');		
		header('Expires: 0');
		//header('Content-Length: ' . filesize($full_filename));
		
		//End file headers
		
		// Send the file contents.
		set_time_limit(0);
		
		$fp = @fopen($tmp_path);
		fpassthru($fp);
		fclose($fp);
		//read($full_filename);
		// End send file
		*/ //End broken download code
?>