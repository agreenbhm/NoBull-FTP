<?php session_start(); ?>

<link rel="stylesheet" type="text/css" href="style.css">

<?php include("top.inc"); ?>
<font face="News Topic MT" size="+1" color="white">
<center>
<b>
<form method="post" action="sendmail.php">
  Your Email Address:
<br>
 <input name="email" type="text" /><br />
<br>
  Message:<br />
<textarea name="message" rows="15" cols="40"></textarea><br />
<br>
  <input type="submit" value="Send" />
</b>
</form>
</center>


<?php include("bot.inc"); ?>