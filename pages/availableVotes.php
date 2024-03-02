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
<div class="to-inactive" onclick="toVoted()"></div>
<main>
    <?php include "./components/voteCards.php" ?>
</main>
<?php include "./components/footer.php" ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../js/requests.js"></script>
<script>
    const date = new Date;
    $.ajax({
        url: "../php/actions.php",
        type: "POST",
        data: {action: 'setZone', zone: (date.getTimezoneOffset() / 60)},
        success: () => {
            <?php
            if (!$_SESSION['t'])
                echo("window.location.href = '../pages/availableVotes.php'");
            ?>
        },
        error: (xhr, status, error) => {
            console.error("AJAX Error: " + status + " - " + error);
        }
    });
</script>
</body>
</html>