<?php
$mysqli = new mysqli('localhost', 'root', '', 'votingDB');
if ($mysqli->connect_error) {
    die("Connection error: " . $mysqli->connect_error);
}
?>