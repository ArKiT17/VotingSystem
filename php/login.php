<?php
global $mysqli;
include "./dbConnect.php";

$login = $_POST['login'];
$password = $_POST['password'];

$query = "select login, password, name, role from user where login like '$login'";
$result = $mysqli->query($query);
if (!$result) {
    die("Error in SQL query: " . $mysqli->error);
}
if ($result->num_rows == 0) {
    header("Location: ../pages/login.php?error=invalid_user");
    $mysqli->close();
    exit();
}

$row = $result->fetch_assoc();
if (password_verify($password, $row['password'])) {
    session_start();
    $_SESSION['login'] = $row['login'];
    $_SESSION['name'] = $row['name'];
    $_SESSION['role'] = $row['role'];
    header("Location: ../pages/availableVotes.php");
} else {
    header("Location: ../pages/login.php?error=incorrect_password");
    $mysqli->close();
    exit();
}

$mysqli->close();
?>