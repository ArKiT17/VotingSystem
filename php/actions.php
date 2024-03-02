<?php
session_start();
switch ($_POST['action']) {
    case 'login' :
        session_destroy();
        break;
    case 'vote' :
        global $mysqli;
        include "./dbConnect.php";
        $mysqli->query("insert into userVotes value ('{$_SESSION['login']}', {$_POST['votingId']}, true, {$_POST['candidateId']})");
        break;
    case 'setZone' :
        $_SESSION['t'] = $_POST['zone'];
        break;
}
?>