<?php

function str_makerand ($minlength, $maxlength, $useupper, $usespecial, $usenumbers)
{

	$charset = "abcdefghijklmnopqrstuvwxyz";
	if ($useupper) $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	if ($usenumbers) $charset .= "0123456789";
	if ($usespecial) $charset .= "~@#%^*()_+-={}|]["; // Note: using all special characters this reads: "~!@#$%^&*()_+`-={}|\\]?[\":;'><,./";
	if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
	else $length = mt_rand ($minlength, $maxlength);
	$key = "";
	for ($i=0; $i<$length; $i++) $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
	return $key;
} //End key  generator function

/*
$key = str_makerand(32,32,true,true,true); //generate random encryption key	
	
//echo $key . "<br><br>";
//$text = "P@$\$w0rd";

$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CFB), MCRYPT_RAND);
$encrypted = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_CFB, $iv);

//echo $encrypted;

//echo "<br><br>";

$decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $encrypted, MCRYPT_MODE_CFB, $iv);
//echo $decrypted; 
*/	
?>