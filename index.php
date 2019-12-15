<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/index.css">
    <title>Room Reservation</title>
    <script src="assets/loading.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato|Ubuntu&display=swap" rel="stylesheet">
</head>
<body onload="load()">
    <div id="content">
        <form action="components/login.php" method="POST" enctype="multipart/form-data">
        <h1>LOGIN</h1>
            <input type="text" name="login" placeholder="login" class="input_text">
            <input type="password" name="password" placeholder="password" class="input_text">
            <input type="submit" value="LOG IN">
        </form>
    </div>
</body>
</html>