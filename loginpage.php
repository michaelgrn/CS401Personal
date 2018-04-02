<?php
$thisPage="product";
require_once("header.php");
?>
  <div id = "container">
  <div id = "home">
    <div id = "login">
  <?php

    if ($_SESSION['validated']== true && $_SESSION['loggedin']== true) {
      echo '<p> You are logged in as ';
      echo $_SESSION['username'];
      echo '<form action="logout.php" method="POST" enctype="multipart/form-data">';
      echo '<input type = "submit" value ="LogOut"/>';
    } else {
      echo '<form action="login.php" method="POST" enctype="multipart/form-data">';
      echo '<label>Username: <input type = "text"';
      echo ' input value= "' . isset($_SESSION['name']) ? $_SESSION['name'] : '';
      echo '" name = "username" /></label> </br>';
      echo '<label>Password: <input type = "password" name = "password" /></label> </br>';
      echo '<input type = "submit" value ="Login"/>';
    }
    if (isset($_SESSION['messages'])) {
      $sentiment = $_SESSION['sentiment'];
      foreach($_SESSION['messages'] as $message) {
        echo "<p> <span class = '$sentiment'>$message</span></p>";
      }
    }
    unset($_SESSION['messages']);
    ?>

  </div>
  </div>
  </form>
</div>
</hr>
<?php
  require_once("footer.php");
