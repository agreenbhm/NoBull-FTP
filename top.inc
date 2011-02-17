

<html>
<head>
<title>NoBull FTP - the no-nonsense PHP FTP client</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body bgcolor="white">

<table align="center" width="80%"><tr><td>

<div id="top_bot_text"><center><font size="2"><font face=Tahoma>
NoBull FTP, <i>the no-nonsense PHP FTP client</i></font></font size></div>

<table class="center" width="100%" cellpadding="0" cellspacing="0"><tr><td>
<left>
<img src="./images/banner.jpg">
</left>

<p align="right">
<?php
include("loginout.php");
?>

<?php 
if(isset($_SESSION['name']))
{
$projects = $_SESSION['name'];
}
?>
</p>

<a href="about.php"><img src="./images/menu-about.jpg" border="0"></a>
<a href="index.php"><img src="./images/menu-main.jpg" border="0"></a>
<a href="services.php"><img src="./images/menu-services.jpg" border="0"></a>
<a href="<?php if(isset($_SESSION['name'])) {echo "open"; } else { echo "register"; } ?>.php"><img src="images/<?php if(isset($_SESSION['name'])) {echo "menu-opentickets"; } else { echo "menu-projects"; } ?>.jpg" border="0"></a>
<a href="new.php"><img src="./images/menu-products.jpg" border="0"></a>
<a href="contact.php"><img src="./images/menu-contact.jpg" border="0"></a>
<!--<img src="./images/menu-right.jpg" border="0">-->

</tr></td><br></table>


<center>

<table class="body" width="100%" height="90%" cellpadding="10" cellspacing="0"><tr valign="top"><td>





