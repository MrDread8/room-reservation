<?php
    session_start();

if(!isset($_SESSION['userId'])){
        header("Location: index.php");
        exit();
    }
    else
    {
        include('include/autoInclude.inc.php');
    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/main.min.css">
    <link rel="stylesheet" href="style/loader.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Ubuntu&display=swap" rel="stylesheet">
    <title>Room Reservation</title>
</head>
<body>
    <?php
        require_once('components/loader.php');
        require_once('./components/menu.php');
    ?>

    <div id="content">
        <div id="next_appointment">
            <?php
               $user = new user("test","test");
$appointments = $user->getAppointments($_SESSION['userId']);
if($appointments->rowCount() != 0){
                        $next_reservation = $appointments->fetch();
                        echo "<h1>Next appointment</h1> ".substr($next_reservation['start_time'],0,16)." ".$next_reservation['name'];
                    }
                    else{
                        echo "<h1>Next appointment</h1> No appointments";
                    }
            ?>
        </div>
        <div id="appointments_list">
                <h1>All Appointments</h1>
                <table>
                        <?php
                                $id = 1;
if($appointments->rowCount() > 1){
                                  echo "<tr><th>ID</th><th>ROOM NAME</th><th>START TIME</th><th>END TIME</th></tr>";
                                  while($row = $appointments->fetch()){
                                    echo "<tr><td>".$id."</td><td>".$row['name']."</td><td>".$row['start_time']."</td><td>".$row['end_time']."</td></tr>";
                                    $id++;
                                  }
                                }
                        ?>
                </table>
        </div>
    </div>
    <script src="assets/loading.js"></script>
</body>
</html>
