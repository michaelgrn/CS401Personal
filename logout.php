<?php
  session_start();
  $_SESSION['loggedin'] = false;
  header("Location: loginpage.php");
  exit;
?>
