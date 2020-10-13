<?php
  session_start();
  error_reporting(1);
  include('../include/autoInclude.inc.php');

  // Just for access to user data function
  $user = new user("","");

  // run update data
  $user->setUserData($_POST['firstName'], $_POST['lastName'], $_POST['email'], $_SESSION['userId']); 
?>
