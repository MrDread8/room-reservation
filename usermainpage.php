<?php
    session_start();

    if(!$_SESSION['loggedin']){
        header("Location: index.php");
        exit();
    }
    else
    {
        require_once('components/db_connection.php');
    }

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
    <?php
        require_once('components/loader.php')
    ?>
    <nav>
        <ul>
            <a href="index.php"><li>HOME</li><a>
            <a href="reservations.php"><li>RESERVATIONS</li><a>
            <a href="userpage.php"><li>USER</li><a>
        </ul>
        <a href="components/logout.php" id="logout-button">LOG OUT</a>
    </nav>
    <div id="content">
        <div id="next_appointment">
            <?php

                $date = date('Y-m-d');
                $time = date('H:i:s');

                if($result = $connection->query("SELECT * FROM appointments WHERE appointments.end_date >= '$date' AND appointments.end_time >= '$time' GROUP BY appointments.start_date, appointments.start_time ASC")){
                    if($result->num_rows != 0){
                        $next_appointment = $result->fetch_assoc();
                        echo "<h1>Next appointment</h1> ".$next_appointment['start_date']." ".substr($next_appointment['start_time'],0,5);
                    }
                    else{
                        echo "<h1>Next appointment</h1> No appointments";
                    }
                }
            ?>
        </div>
        <div id="appointments_list">

        </div>
    </div>
    <script src="assets/loading.js"></script>
</body>
</html>
