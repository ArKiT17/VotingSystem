<div class="candidates">
    <?php
    global $mysqli;
    include "../php/dbConnect.php";

    $result = $mysqli->query("select id, name, description, photo from candidate where voitingId = $voteId");
    if (!$result) {
        die("Error in SQL query: " . $mysqli->error);
    }
    while ($row = $result->fetch_assoc()) {
        echo "<div class='candidate' onclick='selectThis($voteId, {$row['id']})'>";
        $imageDataUri = 'data:image/jpeg;base64,' . base64_encode($row['photo']);
        echo "<img src='$imageDataUri' alt='{$row['name']}'/>";
        echo "<h3>{$row['name']}</h3>";
        echo "<h5>{$row['description']}</h5>";
        echo "</div>";
    }

    $mysqli->close();
    ?>
</div>