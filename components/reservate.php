<?php
  session_start();
error_reporting(E_ALL);
  include('../classes/dbh.class.php');
  include('../classes/reservation.class.php');

$reservation = new reservation($_SESSION['startDate'],$_SESSION['endDate'],$_SESSION['userid']);

$reservation->reservate($_POST['roomId']);

header("Location: ../usermainpage.php");
?>
