<?php
  session_start();

  include('../include/autoInclude.inc.php');

$reservation = new reservation($_SESSION['startDate'],$_SESSION['endDate'],$_SESSION['userId']);

$reservation->reservate($_POST['roomId']);

header("Location: ../usermainpage.php");
?>
