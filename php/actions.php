<?php
session_start();
switch ($_GET['action']) {
    case 'login' :
        session_destroy();
        break;
}
?>