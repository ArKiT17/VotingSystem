<div class="candidates">
    <?php
    global $mysqli;
    include "../php/dbConnect.php";

    if ($isVoted)
        $result = $mysqli->query("select candidate.id, candidate.name, candidate.description, candidate.photo, userVotes.chosenCandidateId from candidate join voting on voting.id = candidate.voitingId join userVotes on voting.id = userVotes.votingId where voting.id = $voteId and userLogin like '{$_SESSION['login']}';");
    else
        $result = $mysqli->query("select id, name, description, photo from candidate where voitingId = $voteId");
    if (!$result) {
        die("Error in SQL query: " . $mysqli->error);
    }
    while ($row = $result->fetch_assoc()) {
        if ($isVoted)
            if ($row['id'] == $row['chosenCandidateId'])
                echo "<div class='candidate chosen'>";
            else
                echo "<div class='candidate'>";
        else
            echo "<div class='candidate vote-anim'>";
        $imageDataUri = 'data:image/jpeg;base64,' . base64_encode($row['photo']);
        echo "<img src='$imageDataUri' alt='{$row['name']}'/>";
        echo "<h3>{$row['name']}</h3>";
        echo "<h5>{$row['description']}</h5>";
        echo "<div class='btn-area'>";
        if (!$isVoted)
            echo "<div class='btn' onclick='selectThis($voteId, {$row['id']})'>Обрати</div>";
        else
            echo "<img class='image-btn' src='../src/tick.svg' alt='{$row['name']}'/>";
        echo "</div>";
        echo "</div>";
    }

    $mysqli->close();
    ?>
</div>