<?php
global $mysqli;
include "../php/dbConnect.php";

$result = $mysqli->query("select candidate.photo, candidate.name, tmp.voteCount from candidate join (select userVotes.chosenCandidateId, count(*) as voteCount from userVotes join voting on voting.id = userVotes.votingId where voting.id = $voteId and userVotes.chosenCandidateId = voting.vinnerId group by userVotes.chosenCandidateId) as tmp on candidate.id = tmp.chosenCandidateId");
if (!$result) {
    die("Error in SQL query: " . $mysqli->error);
}
echo "<div class='winner-space'>";
if ($row = $result->fetch_assoc()) {
    echo "<div class='winner-box'>";
    $imageDataUri = 'data:image/jpeg;base64,' . base64_encode($row['photo']);
    echo "<img class='winner-img' src='$imageDataUri' alt='{$row['name']}'/>";
    echo "<h5 class='title-winner'>Переможець</h5>";
    echo "<h5 class='winner-name'>" . $row['name'] . "</h5>";
    echo "<h5 class='vote-count'>Голосів: {$row['voteCount']}</h5>";
    echo "</div>";
} else {
    echo "<h1>Помилка визначення переможця</h1>";
}
echo "</div>";

$result = $mysqli->query("select candidate.photo, candidate.name, tmp.voteCount from candidate join (select userVotes.chosenCandidateId, count(*) as voteCount from userVotes join voting on voting.id = userVotes.votingId where voting.id = $voteId and userVotes.chosenCandidateId != voting.vinnerId group by userVotes.chosenCandidateId) as tmp on candidate.id = tmp.chosenCandidateId order by tmp.voteCount desc");
if (!$result) {
    die("Error in SQL query: " . $mysqli->error);
}
echo "<div class='lose-space'>";
while ($row = $result->fetch_assoc()) {
    echo "<div class='candidate'>";
    $imageDataUri = 'data:image/jpeg;base64,' . base64_encode($row['photo']);
    echo "<img src='$imageDataUri' alt='{$row['name']}'/>";
    echo "<h5 class='candidate-name'>" . $row['name'] . "</h5>";
    echo "<h5 class='vote-count'>Голосів: {$row['voteCount']}</h5>";
    echo "</div>";
}
echo "</div>";

$mysqli->close();
?>
