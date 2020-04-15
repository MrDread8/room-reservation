<?php
    session_start();
    if(!$_SESSION['loggedin']){
        header("Location: index.php");
        exit();
    }
    else
    {
        require_once('components/db_connection.php');
        include('includes/autoInclude.inc.php');
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
              <input type="date" name="startDate" class="date" min="<?php echo date('d-m-Y');?>" required>
              <input type="time" name="startTime" class="date" required>
              <input type="date" name="endDate" class="date" min="<?php echo date('d-m-Y');?>" required>
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

          $Date = new LoadDate($startDate,$startTime,$endDate,$endTime);

          if($Date->converStringToDate() === true)
          {
            if($rooms = $connection->query("SELECT id FROM rooms;")){
              while($rooms_obj = $rooms->fetch_object()){

                $appointments = $connection->query("SELECT id FROM appointments WHERE (room_id = '$rooms_obj->id') AND ((start_time BETWEEN '$startDate' AND '$endDate') OR (end_time BETWEEN '$startDate' AND '$endDate') OR ('$startTime' BETWEEN start_time AND end_time) OR ('$endDate' BETWEEN start_time AND end_time));");
                  if($appointments->num_rows == 0){
                    echo '
                      <div class="available tile">
                        <h1>'.$rooms_obj->id.'</h1>
                        <form class="" action="components/reservate.php" method="post">
                          <input type="hidden" name="room_reservating_id" value="'.$rooms_obj->id.'" />
                          <input type="button" name="" value="Reservate">
                        </form>
                      </div>';
                }
                else {
                  echo '
                    <div class="reserved tile">
                      <h1>'.$rooms_obj->id.'</h1>
                        <form class="" method="post">
                          <input type="button" name="" value="Reservate" disabled>
                        </form>
                      </div>';
                }
              }
              $_SESSION['startDate'] = $Date->getStartDate();
              $_SESSION['endDate'] = $Date->getEndDate();
              $appointments->free();
              $rooms->free();
            }
          }
          else {
            echo "Erro during query! Refresh page and try again";
          }

        }
        ?>
      </div>

    </div>
    <script src="assets/loading.js"></script>
</body>
</html>
