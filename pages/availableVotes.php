<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Головна</title>
</head>
<body>
<header>
    <h1 class="title">Активні голосування</h1>
    <?php
    session_start();
    if ($_SESSION['role'] === '1')
        echo ('<a href="./admin.php">Адмінпанель</a>');
    if ($_SESSION['login'] === null)
        echo ('<img src="../src/login.png" alt="Вхід" onclick="login()">');
    else
        echo ('<img src="../src/logout.png" alt="Вихід" onclick="login()">');
    ?>
</header>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../js/requests.js"></script>
</body>
</html>