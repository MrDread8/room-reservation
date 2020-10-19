<?php
    session_start();
    include('../include/autoInclude.inc.php');

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
          if($row['verif']){
            header("Location: ../index.php");
            $result->free();
            exit();
          }
          $_SESSION['logginerror'] = false;
          $_SESSION['userId'] = $row['id'];
          header("Location: ../usermainpage.php");
          exit();
      }
?>
