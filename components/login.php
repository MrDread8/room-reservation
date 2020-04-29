<?php
    session_start();
    include('../classes/dbh.class.php');
    include('../classes/login.class.php');

    $login = $_POST['login'];
    $password = $_POST['password'];



    $login = htmlentities($login,ENT_QUOTES,"UTF-8");
    $password = htmlentities($password,ENT_QUOTES,"UTF-8");

    $user = new user($login,$password);

    if($user->selectUser()->rowCount() != 1)
      {
        $_SESSION['logginerror'] = true;
        header("Location: ../index.php");
        $result->free();
        exit();
      }
      else{
          $row = $user->selectUser()->fetch();
          $_SESSION['loggedin'] = true;
          $_SESSION['logginerror'] = false;
          $_SESSION['userid'] = $row['id'];
          header("Location: ../usermainpage.php");
          exit();
      }
?>
