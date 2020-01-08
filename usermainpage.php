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

                $date = date('Y-m-d H:i:s');
                $userid = $_SESSION['userid'];

                if($result = $connection->query("SELECT * FROM appointments WHERE appointments.user_id = '$userid' AND appointments.end_time >= '$date' ORDER BY appointments.start_time ASC;")){
                    if($result->num_rows != 0){
                        $next_reservation = $result->fetch_assoc();
                        echo "<h1>Next appointment</h1> ".substr($next_reservation['end_time'],0,16);
                    }
                    else{
                        echo "<h1>Next appointment</h1> No appointments";
                    }
                }
            ?>
        </div>
        <div id="appointments_list">
                <h1>All Appointments</h1>
                <table>
                    <tr><th>ID</th><th>ROOM NAME</th><th>START TIME</th><th>END TIME</th></tr>
                        <?php
                            $date = date('Y-m-d H:i:s');
                            $userid = $_SESSION['userid'];

                            if($result = $connection->query("SELECT *, appointments.id AS appointments_id FROM appointments LEFT JOIN rooms ON appointments.room_id = rooms.id WHERE appointments.user_id = '$userid'")){
                                while($row = $result->fetch_assoc()){
                                    echo "<tr><td>".$row['appointments_id']."</td><td>".$row['name']."</td><td>".$row['start_time']."</td><td>".$row['end_time']."</td></tr>";
                                }
                            }
                        ?>
                </table>
        </div>
    </div>
    <script src="assets/loading.js"></script>
</body>
</html>
