<?php
    session_start();
    if($_SESSION['loggedin']){
        header("Location: usermainpage.php");
        exit();
    }
    session_destroy();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/loader.css">
    <link rel="stylesheet" href="style/index.css">
    <title>Room Reservation</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Ubuntu&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        require_once('components/loader.php');
    ?>
    <div id="content">
        <form action="components/login.php" method="POST" enctype="multipart/form-data">
        <h1>LOGIN</h1>
            <input type="text" name="login" placeholder="login" class="input_text" required>
            <input type="password" name="password" placeholder="password" class="input_text" required>
            <input type="submit" value="LOG IN">
        <?php
            session_start();
            error_reporting(0);

            if($_SESSION['logginerror']){
                echo "<div id='logginerror'>Incorrect login or password!</div>";
            }
            $_SESSION = array();
            session_destroy();
        ?>
        </form>
    </div>

    <script src="assets/loading.js"></script>

</body>
</html>