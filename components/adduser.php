<?php
  include('db_connection.php');

  $login = "test";
  $password = hash("sha256", "test");

  $connection->query("INSERT INTO users VALUES(0,'$login','$password')");
?>
