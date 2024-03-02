<?php
session_start();
if (!$_SESSION['login']) {
    header("Location: ../pages/login.php");
    exit();
}
?>
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
<?php include "./components/header.php" ?>
<main class="voted-main">
    <div class="to-available" onclick="toAvailable()"></div>
    <?php include "./components/voteCards.php" ?>
</main>
<?php include "./components/footer.php" ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../js/requests.js"></script>
</body>
</html>