<?php
ini_set('error_reporting', E_ALL);
?>
<p>test</p>
<?php
$servername = "10.1.0.252";
$username = "maxscaleuser";
$password = "placeSundayjudge";
// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully. ";

$sql = "SELECT studentID FROM testdb.Student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["studentID"] ."<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>