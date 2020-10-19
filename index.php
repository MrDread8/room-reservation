<?php
    session_start();
    error_reporting(0);
    if($_SESSION['userId']){
        header("Location: usermainpage.php");
        exit();
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/loader.min.css">
    <link rel="stylesheet" href="style/index.min.css">
    <title>Room Reservation</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Ubuntu&display=swap" rel="stylesheet">
</head>
<body>
    <div id="content">
        <form action="components/login.php" method="POST" enctype="multipart/form-data">
        <h1>LOGIN</h1>
            <input type="text" name="login" placeholder="login" class="input_text" required>
            <input type="password" name="password" placeholder="password" class="input_text" required>
            <input type="submit" value="LOG IN">
        <?php
            session_start();

            if($_SESSION['logginerror']){
                echo "<div id='logginerror'>Incorrect login or password!</div>";
            }
            elseif($_SESSION['notverif']){
                echo "<div id='notverified'>Your account is not verified. Contact administrator!</div>";
            }
            session_destroy();
            $_SESSION = array();
        ?>
        </form>
    </div>
<a href="#">Admin</a>
</body>
</html>
