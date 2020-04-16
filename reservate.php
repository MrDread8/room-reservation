<?php
  session_start();

  include('includes/autoInclude.inc.php');
  $reserv = new reservation($_SESSION['startDate'],$_SESSION['endDate'],$_POST['roomId'],$_SESSION['userid']);

  $reserv->reservate();

?>
