<?php
$thisPage="product";
require_once("header.php");
?>
  <div id = "home">
  <?php
    session_start();

    require_once 'Dao.php';
    $dao = new Dao();
    $riders = $dao->getRiders();

        foreach ($riders as $riders) {
          print "<div id = 'team'><img src='" . $riders['image'] . "' title = '" . htmlspecialchars($riders['name']) . "'>" ;
          if ($_SESSION['validated']== true && $_SESSION['loggedin']== true){
            echo "<p id = 'delete'><a href='deleterider.php?id=". $riders['id'] . "'>[ Delete ]</a></p>";
          }
          print "</div>";
        }
    if ($_SESSION['validated']== true && $_SESSION['loggedin']== true) {
        echo "<div id = 'team'><h3><a class = 'deleteLink' href = newrider.php><p id = 'teamAdd'>+</a></h3></div>";
    }
  ?>
  </div>

<?php
  require_once("footer.php");
