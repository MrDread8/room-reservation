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
?>
    <nav>
        <ul>
            <a href="index.php"><li>HOME</li><a>
            <a href="reservations.php"><li>RESERVATIONS</li><a>
            <a href="userprofile.php"><li>USER</li><a>
        </ul>
        <a href="components/logout.php" id="logout-button">LOG OUT</a>
    </nav>
    <div id="content">
           <div id="avatar"></div>
              <div id="personal-info">
    <?php
                    $user = new user("","");

$userData = $user->getUserData($_SESSION['userId']);
$userData = $userData->fetch();
echo "<div class='data' id='name'>".$userData['name']."</div>";
echo "<div class='data' id='surname'>".$userData['surname']."</div>";
echo "<div class='data' id='surname'>".$userData['email']."</div>";

?>
<a class="button_blue" href="editinfo.php">EDIT</a>
</div>
</div>
    <script src="assets/loading.js"></script>
</body>
</html>
