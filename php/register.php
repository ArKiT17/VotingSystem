<?php
global $mysqli;
include "./dbConnect.php";

$login = $_POST['login'];
$password = $_POST['password'];
$name = $_POST['name'];

$queryExistUser = "select count(login) as 'count' from user where login like '$login'";
$resultExistUser = $mysqli->query($queryExistUser);
if (!$resultExistUser) {
    die("Error in SQL query: " . $mysqli->error);
}
if ($resultExistUser->fetch_assoc()['count'] > 0) {
    header("Location: ../pages/register.php?error=user_already_registered");
    exit();
}
$hashPass = password_hash($password, PASSWORD_BCRYPT);
$query = "insert into user (login, name, password, role) value ('$login', '$name', '$hashPass', 0)";
$result = $mysqli->query($query);
if (!$result) {
    die("Error in SQL query: " . $mysqli->error);
} else {
    header("Location: ../pages/login.php");
}

$mysqli->close();
?>