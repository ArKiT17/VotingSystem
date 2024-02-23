<?php
$mysqli = new mysqli('localhost', 'root', '', 'voting');
if ($mysqli->connect_error) {
    die("Connection error: " . $mysqli->connect_error);
}



$mysqli->close();
?>