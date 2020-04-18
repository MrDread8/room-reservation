<?php
  session_start();

  include('includes/autoInclude.inc.php');
  $reservation = new reservation($_SESSION['startDate'],$_SESSION['endDate'],$_SESSION['userid']);

  $reservation->reservate($_POST['roomId']);

  header("Location: usermainpage.php");

  exit();
?>
