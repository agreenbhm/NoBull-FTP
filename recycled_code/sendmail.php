<?php
  $email = $_REQUEST['email'] ;
  $message = $_REQUEST['message'] ;

  mail( "agreenbhm@nc.rr.com", "Message from agreenbhm.com",
    $message, "From: $email" );
  header( "Location: formsubmitted.php" );
?>
