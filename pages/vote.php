<?php
session_start();
if (!$_SESSION['login']) {
    header("Location: ./login.php");
    exit();
}
global $mysqli;
include "../php/dbConnect.php";
$voteId = $_GET['id'];
$isVoted = (int)$_GET['v'];
if ($isVoted)
    $result = $mysqli->query("select count(*) as c from userVotes where userLogin like '{$_SESSION['login']}' and votingId = $voteId and isVoted = 1");
else
    $result = $mysqli->query("select count(id) as c from voting where id = $voteId");
if (!$result)
    die("Error in SQL query: {$mysqli->error}");

if ((int)$result->fetch_assoc()['c'] == 0) {
    if ($isVoted)
        header("Location: ../pages/voted.php");
    else
        header("Location: ../pages/availableVotes.php");
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
    <title>Голосування</title>
    <?php
    if ($isVoted)
        echo "<link rel='stylesheet' href='../css/openVote.css'>";
    else
        echo "<link rel='stylesheet' href='../css/openVoted.css'>";
    ?>
</head>
<body>
<?php include "./components/header.php" ?>
<main>
    <?php include "./components/candidates.php" ?>
</main>
<?php include "./components/footer.php" ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../js/requests.js"></script>
</body>
</html>