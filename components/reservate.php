<?php
  session_start();
error_reporting(E_ALL);
  include('../classes/dbh.class.php');
  include('../classes/reservation.class.php');
 
  $conn = new dbh();


$qry = $conn->dbConnect()->prepare("Insert INTO appointments (`room_id`,`user_id`,`start_time`,`end_time`) VALUES (?, ? , ? , ?)");
$qry->execute([$_POST['roomId'],$_SESSION['userid'],$_SESSION['startDate'],$_SESSION['endDate']]);
exit();
?>
