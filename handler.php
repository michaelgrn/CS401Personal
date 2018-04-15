<?php
  session_start();
  require_once 'Dao.php';
  $dao = new Dao();
  #echo "<pre>" . print_r($_FILES, 1) . "</pre>";
  #exit;
  $name = $_POST["riderName"];
  $_SESSION['riderName'] = $_POST["riderName"];
  $_SESSION['presets'] = array($_POST);

  $valid = true;
  $messages = array();
  $pattern = "/[A-Z]([a-z]+)\s[A-Z]([a-z]+)/";
  $matches = preg_match($pattern, $name);

  if($matches != true && !empty(name)){
    $_SESSION['name'] = $name;
    $messages[] = "PLEASE ENTER FIRST AND LAST NAME AND";
    $messages[] = "CAPITALIZE THE FIRST LETTER OF EACH";
    $valid = false;
  }
  if (empty($name)) {
    $messages[] = "PLEASE ENTER A NAME";
    $valid = false;
  }

  $basePath = "";
  $imagePath = $_FILES["fileToUpload"]["name"];
  if(!empty($_FILES["fileToUpload"]["tmp_name"])){
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if(!($check !== false)){
      $messages[] = "FILE IS NOT AN IMAGE";
      $valid = false;
    }
  }else{
    $valid = false;
    $messages[] = "PLEASE SELECT AN IMAGE TO UPLOAD";

  }


  if((filesize($valid != false && $_FILES["fileToUpload"]["tmp_name"]) > (1024*150)) ){
    $messages[] = "FILE TOO BIG";
    $messages[] = "MUST BE SMALLER THAN 150KB";
    $valid = false;
  }

  if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $basePath . $imagePath) && $valid != false) {
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
