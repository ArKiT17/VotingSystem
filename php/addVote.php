<?php
if (!$_POST['name1']) {
    header("Location: ../pages/addVote.php");
    exit();
}
global $mysqli;
include "./dbConnect.php";

$name = $_POST['voteName'];
$description = $_POST['voteDesc'];
try {
    $endDateTime = new DateTime(str_replace("T", " ", $_POST['voteEndTime']) . ":00");
    $zone = (int)$_POST['t'];
    if ($zone < 0)
        $endDateTime->sub(new DateInterval('PT' . -$zone . 'H'));
    else
        $endDateTime->add(new DateInterval('PT' . $zone . 'H'));
    $endDateTime = $endDateTime->format("Y-m-d H:i:s");
} catch (Exception $e) {
    die("DateTime error: " . $e);
}
$query = "insert into voting (name, description, endtime) value ('$name', '$description', '$endDateTime')";
if (!$mysqli->query($query))
    die("Error in SQL query: " . $mysqli->error);
$query = "select MAX(id) as maxId from voting";
$result = $mysqli->query($query);
if (!$result)
    die("Error in SQL query: " . $mysqli->error);
$lastVoteId = $result->fetch_assoc()['maxId'];
$cName = $_POST['name1'];
$cDesc = $_POST['desc1'];
$cPhoto = file_get_contents($_FILES['photo1']['tmp_name']);
$cPhoto = $mysqli->real_escape_string($cPhoto);
$query = "insert into candidate (voitingId, name, description, photo) values ($lastVoteId, '$cName', '$cDesc', '$cPhoto')";
$cNumber = 2;
while ($_POST["name$cNumber"]) {
    $cName = $_POST["name$cNumber"];
    $cDesc = $_POST["desc$cNumber"];
    $cPhoto = file_get_contents($_FILES["photo$cNumber"]['tmp_name']);
    $cPhoto = $mysqli->real_escape_string($cPhoto);
    $query .= ", ($lastVoteId, '$cName', '$cDesc', '$cPhoto')";
    $cNumber++;
}
if (!$mysqli->query($query))
    die("Error in SQL query: " . $mysqli->error);

$mysqli->close();
?>