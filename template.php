<?php
session_start(); // start session
?>

<link rel="stylesheet" type="text/css" href="../style.css">

<?php
include("top.inc"); ?>
<center>
<h2>
Welcome to Groundzero Coding!
</h2>
<br>
<?php
include("usernamehere.inc");
?>

<br>
<br>
<br>
<br>
<br>
<br>
Comments from friends:
<br>
<?php if(!isset($_POST['comment'])) { include("usernamehere-comments.inc"); } ?>
<br>
<br>




<?php

//CMS Post

if (isset($_SESSION['name']))
{

if(isset($_POST['comment'])) 
{


$author = $_SESSION['name'];


//Get vars
$body = $_POST['body'];
$body = str_replace("<?php", "", $body);
$body = str_replace("?>", "", $body);
$file = "usernamehere-comments.inc";



//Author
$author = "-" . $author;


//Get body
$body = str_replace("\n", "<br />", $body);
$body = trim($body,"34");
$body = stripslashes($body);
$body = "<h5>" . date('F d Y') . "</h5>" . $body . "<br>" . $author . "<br>";


//Open file and replace info
$fh = fopen($file, 'r');
$data = fread($fh, filesize($file));
fclose($fh);

$data = str_replace("<!-- INSERT -->", "<!-- INSERT -->" . $body . "<br>" , $data);


$fh = fopen($file, 'w');

$data = fwrite($fh, $data . " ");
fclose($fh);

//echo "<table cellpadding=\"10\" bgcolor=\"white\"><tr><td>";
//echo "Your comment will appear the next time you view this page.";
//echo "</td></tr></table><br />";


include("usernamehere-comments.inc");


}


echo "<center><form action=\"usernamehere.php\" method=\"POST\"><input type=\"hidden\" name=\"comment\"><table border=\"0\" cellpadding=\"5\">Enter comment below:<br><textarea rows=\"10\" cols=\"30\" wrap=\"physical\" name=\"body\"></textarea><br><input type=\"submit\" value=\"Post Comment\"></table></form></center>";

}
?>


<?php include("../bot.inc"); ?>