<?php
session_start(); // start session
?>
<link rel="stylesheet" type="text/css" href="style.css">



<?php
	include("top.inc");
?>

<br>
<br>

<?php 
	if(isset($_SESSION['name']))
	{
		include("upload_form.inc");
	}
	
	else
	{
		echo "<center>You must be logged in to use the FTP.</center>";
	}
?>

<center>

<?php

if(isset($_SESSION['name'])) //if logged in then list contents
{
	include "list_contents.php";
} //end if logged in then list contents

include("bot.inc"); ?> 