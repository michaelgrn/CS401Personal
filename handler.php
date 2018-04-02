<?php
  session_start();
  require_once 'Dao.php';
  $dao = new Dao();
  #echo "<pre>" . print_r($_FILES, 1) . "</pre>";
  #exit;
  $name = $_POST["name"];

  $_SESSION['presets'] = array($_POST);

  $valid = true;
  $messages = array();
  #$pattern = "/[A-Z]([a-z]{,20})\s[A-Z]([a-z]{,20})/";
  $pattern = "/[A-Z]([a-z]+)\s[A-Z]([a-z]+)/";
  $matches = preg_match($pattern, $name);

  if($matches != true && !empty(name)){
    $_SESSION['name'] = $name;
    $messages[] = "ENTER FIRST AND LAST NAME";
    $valid = false;
  }
  if (empty($name)) {
    $messages[] = "PLEASE ENTER A NAME";
    $valid = false;
  }

  $basePath = "";
  $imagePath = $_FILES["fileToUpload"]["name"];

  if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $basePath . $imagePath)) {
    $messages[] = "INVALID FILE";
    $valid = false;
  }

  if (!$valid) {
    $_SESSION['sentiment'] = "bad";
    $_SESSION['messages'] = $messages;
    header("Location: newrider.php");
    exit;
  }

  $_SESSION['sentiment'] = "good";
  $_SESSION['messages'] = array("Rider Added");
  // save image to database


  $comment = $_POST["comment"];
  $dao->saveRider($name, $imagePath);
  header("Location: newrider.php");
  exit;
?>
