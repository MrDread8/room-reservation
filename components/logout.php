<?php
    session_start();
    if($_SESSION['loggedin']){
        $_SESSION = array();
        $_SESSION['loggedin'] = false;
        header("Location: ../index.php");
        exit();
    }
    else{
        header("Location: ../index.php");
        exit();
    }
    session_destroy();
?>