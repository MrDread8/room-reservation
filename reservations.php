<?php
    session_start();
    if(!$_SESSION['userId']){
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
        require_once("assets/menu.php");
    ?>

    <div id="content">

      <div id="search_bar">
          <form class="" action="" method="post" enctype="multipart/form-data">
              <input type="date" name="startDate" class="date" min="<?php echo date('d-m-Y');?>" required>
              <input type="time" name="startTime" class="date" required>
              <input type="date" name="endDate" class="date" min="<?php echo date('d-m-Y');?>" required>
              <input type="time" name="endTime" class="date" required>
              <input class="button_blue" type="submit" value="Search">
          </form>
      </div>

      <div id="rooms">
        <?php
        if(isset($_POST['startDate'])){

          $startDate = $_POST['startDate'];
          $startTime = $_POST['startTime'];
          $endDate = $_POST['endDate'];
          $endTime = $_POST['endTime'];

          $reservation = new reservation($startDate,$endDate,$_SESSION['userId']);

          $reservation->loadDate($startDate,$startTime,$endDate,$endTime);

          if($reservation->converDate() === true)
          {
              $row = $reservation->allRooms()->fetchAll();
              foreach($row as $room):
                $appointments = $reservation->checkStatus($room['id']);

                if($appointments->rowCount() == 0){
                    echo '
                      <div class="available tile">
                        <h1>'.$room['id'].'</h1>
                        <form class="" enctype="multipart/form-data" action="components/reservate.php" method="post">
                          <input type="hidden" name="roomId" value="'.$room['id'].'" />
                          <input type="submit" name="" value="Reservate">
                        </form>
                      </div>';
                }
                else {
                  echo '
                    <div class="reserved tile">
                      <h1>'.$room['id'].'</h1>
                        <form class="" method="post">
                          <input type="submit" name="" value="Reservate" disabled>
                        </form>
                      </div>';
                }
            endforeach;
            }

              $_SESSION['startDate'] = $reservation->startDate;
              $_SESSION['endDate'] = $reservation->endDate;
            }
        ?>
      </div>

    </div>
    <script src="assets/loading.js"></script>
</body>
</html>
