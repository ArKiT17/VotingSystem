<?php
session_start();
if (!$_SESSION['login']) {
    header("Location: ./login.php");
    exit();
}
global $mysqli;
include "../php/dbConnect.php";
$voteId = (int)$_GET['id'];
$result = $mysqli->query("select count(*) as c from voting where id = $voteId and vinnerId is not null");
if (!$result)
    die("Error in SQL query: {$mysqli->error}");

if ((int)$result->fetch_assoc()['c'] == 0) {
    header("Location: ../pages/archive.php");
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
    <link rel='stylesheet' href='../css/archiveVote.css'>
    <link rel="icon" type="image/x-icon" href="../src/logo.png" />
    <title>Голосування</title>
</head>
<body>
<?php include "./components/header.php" ?>
<main>
    <?php include "./components/archivePeople.php" ?>
</main>
<?php include "./components/footer.php" ?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="../js/requests.js"></script>
</body>
</html>