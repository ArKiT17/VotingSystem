<?php
$path = pathinfo(parse_url($_SERVER['REQUEST_URI'])['path'], PATHINFO_BASENAME);

$headers = array(
    'addVote.php' => 'Нове голосування',
    'availableVotes.php' => 'Активні голосування',
    'voted.php' => 'Проголосовані'
);
if ($path == 'vote.php') {
    $result = $mysqli->query("select `name` from `voting` where `id` = {$_GET['id']}"); //OK
    if ($result)
        $headers['vote.php'] = $result->fetch_assoc()['name'];
    else
        $headers['vote.php'] = 'SQL Error';
}
?>
<header>
    <h3 class="name"><?php
        session_start();
        if ($_SESSION['name'] !== null)
            echo($_SESSION['name']);
        ?></h3>
    <h1 class="title"><?php echo($headers[$path]); ?></h1>
    <div class="control-box">
        <?php
        if ($_SESSION['role'] === '1')
            echo('<a class="btn" href="' . ($path == 'addVote.php' ? './availableVotes.php' : './addVote.php')
                . '"><span>' . ($path == 'addVote.php' ? 'Активні голосування' : 'Додати голосування') . '</span></a>');
        if ($_SESSION['login'] === null)
            echo('<img class="btn" src="../src/login.png" alt="Вхід" onclick="login()">');
        else
            echo('<img class="btn" src="../src/logout.png" alt="Вихід" onclick="login()">');
        ?>
    </div>
</header>
<?php
if ($mysqli)
    $mysqli->close();
?>









