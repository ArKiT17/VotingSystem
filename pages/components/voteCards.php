<div class="cards">
    <?php
    global $mysqli;
    include "../php/dbConnect.php";

    $currentDateTime = new DateTime;
    $currentDateTime->setTimezone(new DateTimeZone('UTC'));
    $dateTime = $currentDateTime->format("Y-m-d H:i:s");
    $path = pathinfo(parse_url($_SERVER['REQUEST_URI'])['path'], PATHINFO_BASENAME);
    if ($path == 'voted.php') {
        $result = $mysqli->query("select voting.id, voting.name, voting.description, voting.endTime from voting join userVotes on voting.id = userVotes.votingId where userLogin like '{$_SESSION['login']}' and isVoted = 1");
        $action = 'openVoted';
    } else {
        $result = $mysqli->query("select voting.id, voting.name, voting.description, voting.endTime from voting where endTime > '$dateTime' and voting.id not in (select votingId from userVotes where userLogin like '{$_SESSION['login']}' and isVoted = 1)");
        $action = 'openVote';
    }
    if (!$result) {
        die("Error in SQL query: " . $mysqli->error);
    }
    while ($row = $result->fetch_assoc()) {
        echo "<div class='card' onclick=\"$action({$row['id']})\">";
        echo "<h3>" . $row['name'] . "</h3>";
        echo "<h5>" . $row['description'] . "</h5>";
        try {
            $time = new DateTime($row['endTime']);
            $zone = $_SESSION['t'];
            if ($zone < 0)
                $time->add(new DateInterval('PT' . -$zone . 'H'));
            else
                $time->sub(new DateInterval('PT' . $zone . 'H'));
            $time = $time->format("Y-m-d H:i");
            echo "<h5>$time</h5>";
        } catch (Exception $e) {
            echo "<h5>Time error</h5>";
        }
        if ($_SESSION['role'] == 1)
            echo "<img src='../src/remove.svg' alt='Видалити' onclick='deleteVote(event, {$row['id']})'>";
        echo "</div>";
    }

    $mysqli->close();
    ?>
</div>