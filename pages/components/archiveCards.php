<div class="cards">
    <?php
    global $mysqli;
    include "../php/dbConnect.php";

    $result = $mysqli->query("select voting.id as votingId, voting.name as votingName, candidate.photo, candidate.name as candidateName, tmp.voteCount from voting join (select votingId, count(*) as voteCount from userVotes join voting on voting.id = userVotes.votingId where userVotes.chosenCandidateId = voting.vinnerId group by votingId) as tmp on tmp.votingId = voting.id join candidate on candidate.id = voting.vinnerId join userVotes on userVotes.votingId = voting.id where userVotes.userLogin like '{$_SESSION['login']}' group by voting.id, voting.name, candidate.photo, candidate.name;");
    if (!$result) {
        die("Error in SQL query: " . $mysqli->error);
    }
    while ($row = $result->fetch_assoc()) {
        echo "<div class='card' onclick=\"openArchiveVote({$row['votingId']})\">";
        echo "<h3 class='title'>{$row['votingName']}</h3>";
        $imageDataUri = 'data:image/jpeg;base64,' . base64_encode($row['photo']);
        echo "<img src='$imageDataUri' alt='{$row['candidateName']}'>";
        echo "<h5 class='title-winner'>Переможець</h5>";
        echo "<h5 class='winner-name'>" . $row['candidateName'] . "</h5>";
        echo "<h5 class='vote-count'>Голосів: {$row['voteCount']}</h5>";
        echo "</div>";
    }

    $mysqli->close();
    ?>
</div>