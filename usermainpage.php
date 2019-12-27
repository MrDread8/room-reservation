<?php
    session_start();
    if(!$_SESSION['loggedin']){
        header("Location: index.php");
        exit();
    }
    session_destroy();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/usermainpage.css">
    <link rel="stylesheet" href="style/loader.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Ubuntu&display=swap" rel="stylesheet">
    <title>Room Reservation</title>
</head>
<body>
    <div id="loader">
        LOADING
    </div>
    <nav>
        <ul>
            <li>HOME</li>
            <li>RESERVATIONS</li>
            <li>SETTINGS</li>
        </ul>
        <a href="components/logout.php" id="logout-button">LOG OUT</a>
    </nav>
    <div id="content">
    </div>

    <script src="assets/loading.js"></script>

</body>
</html>