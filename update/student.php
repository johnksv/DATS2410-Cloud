<?php
ini_set('error_reporting', E_ALL);
//require_once 'phpcode/Connection.php';
?>
<?php
	require '../phpcode/Connection.php';
	if (empty($_POST["studentID"])) {
		echo "EMPTY";
	}else{
		echo "Updating student: ". $_POST["studentId"] ."<br>";
		
		$conn = Connection::connect();
		
		$sql = 'SELECT * FROM student WHERE studentID="'.$_POST["studentId"] . '"';
		//echo $sql;
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
		while ($row = $result->fetch_assoc()) {
			echo "Id: " . $row["studentID"] . ", email: " . $row["email"] . "<br>";
		}
		} else {
			echo "0 results";
		}
		
		Connection::disconnect();
	
	}
	 

?>