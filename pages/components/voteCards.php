<div class="cards">
    <?php
    global $mysqli;
    include "../php/dbConnect.php";

    $currentDateTime = new DateTime;
    $currentDateTime->setTimezone(new DateTimeZone('UTC'));
    $dateTime = $currentDateTime->format("Y-m-d H:i:s");
    $path = pathinfo(parse_url($_SERVER['REQUEST_URI'])['path'], PATHINFO_BASENAME);
    if ($path == 'voted.php') {
        $result = $mysqli->query("select voting.id, voting.name, voting.description, count(*) as people, voting.endTime from voting join userVotes on voting.id = userVotes.votingId join candidate on candidate.voitingId = voting.id where userLogin like '{$_SESSION['login']}' and isVoted = 1 group by voting.id, voting.name, voting.description, voting.endTime");
        $action = 'openVoted';
    } else {
        $result = $mysqli->query("select voting.id, voting.name, voting.description, count(*) as people, voting.endTime from voting join candidate on candidate.voitingId = voting.id where endTime > '$dateTime' and voting.id not in (select votingId from userVotes where userLogin like '{$_SESSION['login']}' and isVoted = 1) group by voting.id, voting.name, voting.description, voting.endTime");
        $action = 'openVote';
    }
    if (!$result) {
        die("Error in SQL query: " . $mysqli->error);
    }
    while ($row = $result->fetch_assoc()) {
        echo "<div class='card' onclick=\"$action({$row['id']})\">";
        echo "<h3 class='title'>" . $row['name'] . "</h3>";
        echo "<h5 class='description'>" . $row['description'] . "</h5>";
        echo "<h5 class='people'>Кандидатів: {$row['people']}</h5>";
        try {
            $time = new DateTime($row['endTime']);
            $zone = $_SESSION['t'];
            if ($zone < 0)
                $time->add(new DateInterval('PT' . -$zone . 'H'));
            else
                $time->sub(new DateInterval('PT' . $zone . 'H'));
            $time = $time->format("H:i d.m.Y");
            echo "<h5 class='end-time'>Активне до $time</h5>";
        } catch (Exception $e) {
            echo "<h5>Time error</h5>";
        }
        if ($_SESSION['role'] == 1)
            echo "<div class='control'><img src='../src/remove.svg' alt='Видалити' onclick='deleteVote(event, {$row['id']})'></div>";
        echo "</div>";
    }

    $mysqli->close();
    ?>
</div>