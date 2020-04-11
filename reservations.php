<?php
    session_start();
    error_reporting(0);
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
    <link rel="stylesheet" href="style/usermainpage.min.css">
    <link rel="stylesheet" href="style/reservations.min.css">
    <link rel="stylesheet" href="style/loader.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato|Ubuntu&display=swap" rel="stylesheet">
    <title>Room Reservation</title>
</head>
<body>
    <?php
        require_once('components/loader.php');
        $date = date('d-m-Y');
        $time = date('H:i');
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

      <div id="search_bar">
          <form class="" action="" method="post" enctype="multipart/form-data">
              <input type="date" name="startDate" class="date" min="<?php echo $date?>" required>
              <input type="time" name="startTime" class="date" required>
              <input type="date" name="endDate" class="date" min="<?php echo $date?>" required>
              <input type="time" name="endTime" class="date" required>
              <input type="submit" value="Search">
          </form>
      </div>

      <div id="rooms">
        <?php
        $startDate = $_POST['startDate'];
        $startTime = $_POST['startTime'];
        $endDate = $_POST['endDate'];
        $endTime = $_POST['endTime'];

        $startDate = htmlentities($startDate,ENT_QUOTES,'UTF-8');
        $startTime = htmlentities($startTime,ENT_QUOTES,'UTF-8');
        $endDate = htmlentities($endDate,ENT_QUOTES,'UTF-8');
        $endTime = htmlentities($endTime,ENT_QUOTES,'UTF-8');

        $startDate = $startDate." ".$startTime;
        $endDate = $endDate." ".$endTime;

          if($rooms = $connection->query("SELECT rooms.id FROM rooms;")){

            while ($row = $rooms->fetch_assoc()) {
              $room_id = $row['id'];
                $appointments = $connection->query("SELECT appointments.id FROM appointments WHERE (appointments.room_id == '$room_id' AND ('$startDate' BETWEEN appointments.start_time AND appointments.end_time) OR ('$endDate' BETWEEN appointments.start_time AND appointments.end_time)))");

                 if($appointments->num_rows != 0){
                  echo '<div class="reserved tile">
                    <h1>'.$room_id.'</h1>
                    <form class="" action="index.html" method="post">
                      <input type="button" name="" value="Reservate">
                    </form>
                  </div>';
                }
                else {

                  echo '<div class="available tile">
                    <h1>'.$room_id.'</h1>
                    <form class="" action="index.html" method="post">
                      <input type="button" name="" value="Reservate">
                    </form>
                  </div>';
                }
            }
          }
        ?>
        <!-- <div class="available tile">
          <h1>1</h1>
        </div>
        <div class="available tile">
          <h1>2</h1>
          <form class="" action="index.html" method="post">
            <input type="button" name="" value="Reservate">
          </form>
        </div>
        <div class="reserved tile">
          <h1>3</h1>
          <form class="" action="index.html" method="post">
            <input type="button" name="" value="Reservate" disabled>
          </form>
        </div> -->
      </div>

    </div>
    <script src="assets/loading.js"></script>
</body>
</html>
