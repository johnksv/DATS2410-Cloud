<!DOCTYPE html>
<html>
<body>

<?php
$servername = "10.1.0.252";
$username = "maxscaleuser";
$password = "placeSundayjudge";
$dbname = "testdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT studentID FROM Student";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<br> id: ". $row["studentID"]. "<br>";
     }
} else {
     echo "0 results";
}

$conn->close();
?>  

</body>
</html>
