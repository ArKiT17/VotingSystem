<?php
const headers = array(
    'addVote.php' => 'Нове голосування',
    'availableVotes.php' => 'Активні голосування',
    'voted.php' => 'Проголосовані'
);
const links = array(
    'addVote.php' => './availableVotes.php',
    'availableVotes.php' => './addVote.php',
    'voted.php' => './addVote.php'
);
const button = array(
    'addVote.php' => 'Активні голосування',
    'availableVotes.php' => 'Додати голосування',
    'voted.php' => 'Додати голосування'
);
$path = pathinfo(parse_url($_SERVER['REQUEST_URI'])['path'], PATHINFO_BASENAME);
?>
<header>
    <h3 class="name"><?php
        session_start();
        if ($_SESSION['name'] !== null)
            echo($_SESSION['name']);
        ?></h3>
    <h1 class="title"><?php echo(headers[$path]); ?></h1>
    <div class="control-box">
        <?php
        if ($_SESSION['role'] === '1')
            echo('<a class="btn" href="' . links[$path] . '"><span>' . button[$path] . '</span></a>');
        if ($_SESSION['login'] === null)
            echo('<img class="btn" src="../src/login.png" alt="Вхід" onclick="login()">');
        else
            echo('<img class="btn" src="../src/logout.png" alt="Вихід" onclick="login()">');
        ?>
    </div>
</header>