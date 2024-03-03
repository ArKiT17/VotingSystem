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
    case 'deleteVote' :
        if ($_SESSION['role'] != 1)
            break;
        global $mysqli;
        include "./dbConnect.php";
        $mysqli->query("delete from voting where id = {$_POST['votingId']}");
        break;
}
if ($mysqli)
    $mysqli->close();
?>