<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Нове голосування</title>
    <link rel="stylesheet" href="../css/addVote.css">
    <?php
    session_start();
    if ($_SESSION['role'] !== '1')
        header("Location: ../pages/availableVotes.php");
    ?>
</head>
<body>
<header>
    <h3 class="name"><?php
        echo($_SESSION['name']);
        ?></h3>
    <h1 class="title">Нове голосування</h1>
    <div class="control-box">
        <a class="btn" href="./availableVotes.php"><span>Активні голосування</span></a>
        <img class="btn" src="../src/logout.png" alt="Вихід" onclick="login()">
    </div>
</header>
<main>
    <form action="../php/addVote.php" method="post" enctype="multipart/form-data">
        <label for="voteName">
            Заголовок
            <input type="text" id="voteName" name="voteName" required maxlength="40">
        </label>
        <label for="voteDesc">
            Опис (максимум 100 символів)
            <input type="text" id="voteDesc" name="voteDesc" required maxlength="100">
        </label>
        <label for="voteEndTime">
            Кінець голосування
            <input type="datetime-local" id="voteEndTime" name="voteEndTime" required>
            <input type="hidden" id="t" name="t">
        </label>
        <hr>
        <div id="candidates"></div>
        <button type="button" onclick="addCandidate()">Ще один кандидат</button>
        <hr>
        <button type="submit">Створити голосування</button>
    </form>
</main>
<?php include "./components/footer.php" ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../js/requests.js"></script>
<script src="../js/addVote.js"></script>
</body>
</html>