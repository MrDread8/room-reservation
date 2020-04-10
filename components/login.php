<?php
    session_start();

    require_once('db_connection.php');

    $login = $_POST['login'];
    $password = $_POST['password'];

    $login = htmlentities($login,ENT_QUOTES,"UTF-8");
    $password = htmlentities($password,ENT_QUOTES,"UTF-8");

    $password = hash("sha256", $password);

    if($connection->connect_errno != 0)
    {
        echo "Error: ".$connection->connect_errno."<br/>Contact with website administrator!";
    }
    else{
        if($result = $connection->query(sprintf("SELECT * FROM users WHERE login = '%s' AND password = '%s'",
                        $connection->real_escape_string($login),
                        $connection->real_escape_string($password)))){
                            if($result->num_rows != 1)
                            {
                                $_SESSION['logginerror'] = true;
                                header("Location: ../index.php");
                                $result->free();
                                exit();
                            }
                            else{
                                $row = $result->fetch_assoc();
                                $_SESSION['loggedin'] = true;
                                $_SESSION['logginerror'] = false;

                                $_SESSION['userid'] = $row['id'];

                                header("Location: ../usermainpage.php");
                                exit();
                            }
                        }
        else{
            $_SESSION['logginerror'] = true;
            header("Location: ../index.php");
            $result->free();
            exit();
        }
    }
?>
