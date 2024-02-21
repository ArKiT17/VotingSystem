<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Головна</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<header>
    <h3 class="name"><?php
        session_start();
        if ($_SESSION['name'] !== null)
            echo($_SESSION['name']);
        ?></h3>
    <h1 class="title">Проголосовані</h1>
    <div class="control-box">
        <?php
        if ($_SESSION['role'] === '1')
            echo('<a class="btn" href="./admin.php"><span>Адмінпанель</span></a>');
        if ($_SESSION['login'] === null)
            echo('<img class="btn" src="../src/login.png" alt="Вхід" onclick="login()">');
        else
            echo('<img class="btn" src="../src/logout.png" alt="Вихід" onclick="login()">');
        ?>
    </div>
</header>
<div class="to-available" onclick="toAvailable()"></div>
<main class="voted-main">

</main>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../js/requests.js"></script>
</body>
</html>