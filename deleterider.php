<?php
session_start();
if (!($_SESSION['validated']== true && $_SESSION['loggedin']== true)) {
  header("Location: team.php");
  exit;
}

// TODO.... does the current user have permission to delete this id?
require_once 'Dao.php';
$dao = new Dao();
$id = $_GET['id'];
$dao->deleterider($id);
header("Location: team.php");
exit;

?>
