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
     <meta charset="UTF-8"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
     <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
     <link rel="stylesheet" href="style/main.min.css"/>
     <link rel="stylesheet" href="style/loader.min.css"/>
     <link href="https://fonts.googleapis.com/css?family=Lato|Ubuntu&display=swap" rel="stylesheet"/>
     <title>Room Reservation</title>
</head>
<body>
<?php
  require_once("assets/menu.php");
?>
<div id="content">
       <form enctype="multipart/form-data" action="components/updateInfo.php" method="POST" id="userForm">
         <input type="text" name="firstName" value="" placeholder="First Name"/>
         <input type="text" name="lastName" value="" placeholder="Last Name"/>
         <input type="text" name="email" value="" placeholder="email"/>
         <input type="submit" value="CONFIRM" class="button_blue" id="buttonEditInfo"/>
       </form>
</div>
<script src="assets/loading.js"></script>
</body>
</html>
