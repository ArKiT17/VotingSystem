<?php
session_start();
switch ($_POST['action']) {
    case 'login' :
        session_destroy();
        break;
    case 'vote' :
        global $mysqli;
        include "./dbConnect.php";
        $mysqli->query("insert into userVotes value ('{$_SESSION['login']}', {$_GET['votingId']}, true, {$_GET['candidateId']})");
        break;
}
?>