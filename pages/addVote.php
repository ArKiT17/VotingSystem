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
<?php include "./components/header.php" ?>
<main>
    <form action="../php/addVote.php" method="post" enctype="multipart/form-data">
        <div class="left">
            <label for="voteName">Назва голосування</label>
            <input type="text" id="voteName" name="voteName" required maxlength="40">
            <label for="voteDesc">Опис голосування</label>
            <textarea id="voteDesc" name="voteDesc" placeholder="*Максимум 100 символів" maxlength="100"></textarea>
            <label for="voteEndTime">Час закінчення</label>
            <input type="datetime-local" id="voteEndTime" name="voteEndTime" required>
        </div>
        <hr>
        <div class="right">
            <div class="candidate-control">
                <h3>Кандидати</h3>
                <img class="btn add-vote" src="../src/add.svg" alt="Ще один кандидат" onclick="addCandidate()">
            </div>
            <div id="candidates"></div>
        </div>
        <button type="submit">Створити</button>
    </form>
</main>
<?php include "./components/footer.php" ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../js/requests.js"></script>
<script src="../js/addVote.js"></script>
</body>
</html>