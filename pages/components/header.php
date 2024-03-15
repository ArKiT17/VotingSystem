<?php
$path = pathinfo(parse_url($_SERVER['REQUEST_URI'])['path'], PATHINFO_BASENAME);

$headers = array(
    'addVote.php' => 'Нове голосування',
    'availableVotes.php' => 'Активні голосування',
    'voted.php' => 'Проголосовані',
    'archive.php' => 'Архів'
);
if ($path == 'vote.php' || $path == 'archiveVote.php') {
    $result = $mysqli->query("select `name` from `voting` where `id` = {$_GET['id']}"); //OK
    if ($result)
        $headers[$path] = $result->fetch_assoc()['name'];
    else
        $headers[$path] = 'SQL Error';
}
?>
<link href="https://fonts.googleapis.com/css2?family=Convergence&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
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
            if ($path == "addVote.php")
                echo('<img class="btn add-vote" src="../src/close.svg" alt="До голосувань" onclick="addVote(0)">');
            else
                echo('<img class="btn add-vote" src="../src/add.svg" alt="Додати голосування" onclick="addVote(1)">');
        if ($_SESSION['login'] === null)
            echo('<img class="btn exit" src="../src/login.svg" alt="Вхід" onclick="login()">');
        else {
            echo('<img class="btn add-vote clock" src="../src/clock.svg" alt="До архіву" onclick="toArchive()">');
            echo('<img class="btn exit" src="../src/logout.svg" alt="Вихід" onclick="login()">');
        }
        ?>
    </div>
</header>
<?php
if ($mysqli)
    $mysqli->close();
?>









