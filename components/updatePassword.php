<?php
  session_start();
  error_reporting(1);
  include('../include/autoInclude.inc.php');

  // creatin class for update function
  $user = new user("","");

  // load data from form to var
  $userFirstName = $_POST['firstName'];
  $userLastName = $_POST['lastName'];
  $userEmail = $_POST['email'];
  $userId =  $_SESSION['userId'];

  // run update
  $user->setUserPassword();

  // redirect
  header("Location: ../userprofile.php");
?>
