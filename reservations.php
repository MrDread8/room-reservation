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
        $date = date('Y-m-d')."T".date('H:i');
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
          <form class="" action="" method="post">
              <input type="datetime-local" name="startTime" min="<?php echo $date;?>" required>
              <input type="datetime-local" name="endTime" value="" min="<?php echo $date;?>" required>
              <input type="submit" value="Search">
          </form>
      </div>

      <div id="rooms">
        <div class="available">
          <h1>1</h1>
        </div>
        <div class="available">
          <h1>2</h1>
          <form class="" action="index.html" method="post">
            <input type="button" name="" value="">
          </form>
        </div>
        <div class="available">

        </div>
        <div class="reserved">

        </div>
        <div class="reserved">

        </div>
      </div>

    </div>
    <script src="assets/loading.js"></script>
</body>
</html>
