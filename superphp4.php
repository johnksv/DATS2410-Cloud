<?php
ini_set('error_reporting', E_ALL);
?>
<p>test</p>
<?php
$servername = "10.1.0.252";
$username = "maxscaleuser";
$password = "placeSundayjudge";
// Create connection
$conn = new mysqli($servername, $username, $password, "testdb");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully. ";
//$conn->select_db("testdb");

$sql = "SELECT * FROM Student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["studentID"] .", email: ". $row["email"] ."<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
