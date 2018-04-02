<?php
session_start();
if (!($_SESSION['validated']== true && $_SESSION['loggedin']== true)) {
  header("Location: team.php");
  exit;
}
require_once("header.php");
?>
<div id = "container">
  <div id = "home">
    <div id = "login">
    <form action="handler.php" method="POST" enctype="multipart/form-data">
     Name: <input value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>" placeholder="Enter rider name here" type="text" id="name" name="name"></p>
    <input type="file" name="fileToUpload" id="fileToUpload"></p>
    <input type="submit" value="Add Rider"></p>
    <?php
    if (isset($_SESSION['messages'])) {
      $sentiment = $_SESSION['sentiment'];
      foreach($_SESSION['messages'] as $message) {
        echo "<p> <span class = '$sentiment'>$message</span></p>";
      }
    }
    unset($_SESSION['messages']);
    unset($_SESSION['name']);
    ?>
</form>
  </div>
</div>
</div>
<?php
  require_once("footer.php");
