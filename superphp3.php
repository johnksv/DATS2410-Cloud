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
echo "Connected successfully";
$sql = "show databases";
$result = $conn->query($sql);
echo "$result";
    
$conn->close();
?>
