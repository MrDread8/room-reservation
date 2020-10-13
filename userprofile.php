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
        // require_once('components/loader.php');
        require_once('components/menu.php');
?>
    <div id="content">
           <div id="avatar"></div>
              <div id="personal-info">
    <?php
    $user = new user("","");
    $userData = $user->getUserData($_SESSION['userId']);
    $userData = $userData->fetch();

    echo "<div class='data' id='name'>Name: ".$userData['name']."</div>";
    echo "<div class='data' id='surname'>Surname: ".$userData['surname']."</div>";
    echo "<div class='data' id='surname'>E-mail: ".$userData['email']."</div>";

    ?>
              </div>
  <div class="buttons-holder">
    <a class="button_blue" href="editinfo.php">EDIT</a>
    <a class="button_blue" href="editinfo.php">CHANGE PASSWORD</a>
  </div>

  </div>
    <script src="assets/loading.js"></script>
</body>
</html>
