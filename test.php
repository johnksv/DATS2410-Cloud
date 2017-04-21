<?php
ini_set('error_reporting', E_ALL);
require_once 'phpcode/Connection.php';
?>
<p>test</p>
<?php

$conn = Connection::connect();

$sql = "SELECT * FROM student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "id: " . $row["studentID"] . ", email: " . $row["email"] . "<br>";
    }
} else {
    echo "0 results";
}
Connection::disconnet();
?>
