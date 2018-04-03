<?php
  session_start();
  $_SESSION['loggedin'] = false;
  $_SESSION['sentiment'] = "good";
  $_SESSION['messages'] = array("You logged out succesfully!");
  header("Location: loginpage.php");
  exit;
?>
