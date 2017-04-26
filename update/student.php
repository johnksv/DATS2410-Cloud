<!DOCTYPE HTML>
<html>  
	<body>
	<?php
	ini_set('error_reporting', E_ALL);
	//require_once 'phpcode/connection.php';
	?>
	<?php
	require '../connection.php';
	$fname = null;
	$lname = null;
	$email = null;
	$year  = null;
	$conn = connection::connect();
	if(!empty($_POST["update"])){
		$sql = "UPDATE Student SET email='" . $_POST["email"]. "', startYear='" . $_POST['startYear'] . "', firstName='". $_POST['firstName']."', lastName='" . $_POST['lastName'] . "' WHERE studentId='" . $_POST["foo"] . "'";
		echo $sql ."<br>";
        $result = $conn->query($sql);
        header("Location: ../show/student.php");
	}			
	if (empty($_POST["studentID"])) {
		echo "EMPTY";
	}else{
		echo "<B>Updating student: ". $_POST["studentID"] ."</B><br>";
		
		
		$sql = 'SELECT * FROM Student WHERE studentID="'.$_POST["studentID"] . '"';
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			// output data of each row
			while ($row = $result->fetch_assoc()) {
			
				$fname = $row['firstName'];
				$lname = $row['lastName'];
				$email = $row['email'];
				$year = $row['startYear'];
			}
			
		} else {
			echo "No such user!";
		}
		
		connection::disconnect();
	
	}
	?>
	<form action="student.php" method="post">
		First Name: <input type="text" name="firstName" value="<?php echo $fname; ?>"><br>
		Last Name: <input type="text" name="lastName" value="<?php echo $lname; ?>"><br>
		email: <input type="text" name="email" value="<?php echo $email; ?>"><br>
		
		Start Year: <input name="startYear" type="date" value="<?php echo $year; ?>"><br>
		<br>
		<input type="hidden" name="foo" value="<?php echo $_POST["studentID"];?>" />
		<input type="submit" name="update" Value="Update">
	</form>
	
	</body>
</html>