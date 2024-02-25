<div class="cards">
    <?php
    global $mysqli;
    include "../php/dbConnect.php";

    $currentDateTime = new DateTime;
    $currentDateTime->setTimezone(new DateTimeZone('UTC'));
    $dateTime = $currentDateTime->format("Y-m-d H:i:s");

    $result = $mysqli->query("select id, name, description, endTime from voting where endTime > '$dateTime'");
    if (!$result) {
        die("Error in SQL query: " . $mysqli->error);
    }
    while ($row = $result->fetch_assoc()) {
        echo "<div class='card' onclick=\"toVote(" . $row['id'] . ")\">";
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
            echo "<h5>" . $time . "</h5>";
        } catch (Exception $e) {
            echo "<h5>Time error</h5>";
        }
        echo "</div>";
    }

    $mysqli->close();
    ?>
</div>