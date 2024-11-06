<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        Display games here...
        <?php
        // put your code here
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "softball";

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

// Fetch games data
        $sql = "SELECT opponent, site, result FROM games";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            echo "<table border='1'>
            <tr>
                <th>Opponent</th>
                <th>Site</th>
                <th>Result</th>
            </tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                <td>" . htmlspecialchars($row['opponent']) . "</td>
                <td>" . htmlspecialchars($row['site']) . "</td>
                <td>" . htmlspecialchars($row['result']) . "</td>
              </tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No games available.</p>";
        }

        $conn->close();
        ?>


    </body>
</html>
