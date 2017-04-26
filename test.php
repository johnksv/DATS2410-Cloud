<?php
ini_set('error_reporting', E_ALL);
//require_once 'phpcode/connection.php';
?>
<p>test</p>
<?php


  $host = "10.1.0.252";
  $username = "webserver";
  $password = "placeSundayjudge";
  $database = "studentinfosys";


$conn = new mysqli($host, $username, $password);

if ($conn->connect_error) {
    die("connection failed: " . $conn->connect_error);
}
$conn->select_db($database);


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
$conn->close();
?>
