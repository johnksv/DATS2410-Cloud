<?php
ini_set('error_reporting', E_ALL);
//require_once 'phpcode/Connection.php';
?>
<?php
	require '../phpcode/Connection.php';
	if (empty($_POST["studentID"])) {
		echo "EMPTY";
	}else{
		echo "<B>Updating student: ". $_POST["studentID"] ."</B><br>";
		
		$conn = Connection::connect();
		
		$sql = 'SELECT * FROM Student WHERE studentID="'.$_POST["studentID"] . '"';
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
		while ($row = $result->fetch_assoc()) {
			echo "Name: ".$row['firstName'] . $row['lastName'] .", E-Mail: " . $row["email"] . ", Start Year:" . $row['startYear'] .  	"<br>";
			}
		
		} else {
			echo "0 results";
		}
		
		Connection::disconnect();
	
	}
	 

?>