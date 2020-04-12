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

        if(isset($_POST['startDate'])){

          $startDate = $_POST['startDate'];
          $startTime = $_POST['startTime'];
          $endDate = $_POST['endDate'];
          $endTime = $_POST['endTime'];


          $startDate = $startDate." ".$startTime;
          $endDate = $endDate." ".$endTime;

          $startDate = strtotime($startDate);
          $endDate = strtotime($endDate);
          
          if(($endDate = date("Y-m-d H:i:s", $endDate)) != false AND ($startDate = date("Y-m-d H:i:s", $startDate)) != false)
          {
            if($rooms = $connection->query("SELECT id FROM rooms;")){
              while($rooms_row = $rooms->fetch_assoc()){
                $room_id = $rooms_row['id'];

                $appointments = $connection->query("SELECT id FROM appointments WHERE (room_id = '$room_id') AND ((start_time BETWEEN '$startDate' AND '$endDate') OR (end_time BETWEEN '$startDate' AND '$endDate') OR ('$startTime' BETWEEN start_time AND end_time) OR ('$endDate' BETWEEN start_time AND end_time));");
                  if($appointments->num_rows == 0){
                    echo '
                      <div class="available tile">
                        <h1>'.$room_id.'</h1>
                        <form class="" action="index.html" method="post">
                          <input type="button" name="" value="Reservate">
                        </form>
                      </div>';
                }
                else {
                  echo '
                    <div class="reserved tile">
                      <h1>'.$room_id.'</h1>
                        <form class="" action="index.html" method="post">
                          <input type="button" name="" value="Reservate" disabled>
                        </form>
                      </div>';
                }
              }
            }
          }
          else {
            echo "Erro during query! Refresh page and try again";
          }
          $appointments->free();
          $rooms->free();
        }
        ?>
      </div>

    </div>
    <script src="assets/loading.js"></script>
</body>
</html>
