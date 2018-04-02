<?php
  session_start();
  $data = file("users.dat");
  $userName = $_POST["username"];
  $passWord = $_POST["password"];
  $validU = false;
  $validP = false;
  $valid = true;

  if (empty($userName)) {
    $messages[] = "PLEASE ENTER A USERNAME";
    $valid = false;
  }

  if (empty($passWord)) {
    $messages[] = "PLEASE ENTER A PASSWORD";
    $valid = false;
  }

  foreach ($data as $user) {
    $userData = explode("|", $user);
    $validU = false;
    $validP = false;
    if((strcmp($userData[0],$userName) == 0)){
      //echo "You did bro";
      $validU = true;
    }
    if((strcmp(trim($userData[1]),$passWord) == 0)){
      $validP = true;
    }

    if($validU == true){
      break;
    }

  }

  if($validU == true && $validP == true){
    $valid = true;
  }else if($validU == true && $validP == false && (!empty($passWord))){
    $valid = false;
    $_SESSION['name'] = $userName;
    $messages[] = "INVALID PASSWORD";
  }else if(!empty($userName) && $validU != true){
    $valid = false;
    $messages[] = "USERNAME NOT FOUND";
  }

  $_SESSION['validated'] = true;

  if($valid){
    $_SESSION['sentiment'] = "good";
    $_SESSION['messages'] = array("You logged in!");
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $userName;
    header("Location: loginpage.php");
    exit;
  }

  $_SESSION['sentiment'] = "bad";
  $_SESSION['messages'] = $messages;
  $_SESSION['loggedin'] = false;
  header("Location: loginpage.php");
  exit;






?>
