<?php

require '../phpcode/Connection.php';
if (!empty($_POST["studentID"])) {
    // keep track validation errors
    $IDError = null;
    $emailError = null;
    $yearError = null;
    $firstNameError = null;
    $lastNameError = null;
	
	$conn = Connection::connect();
		
	$sql = 'SELECT * FROM Student WHERE studentID="'.$_POST["studentID"] . '"';
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
			// output data of each row
		while ($row = $result->fetch_assoc()) {	
			$studentID = $row['studentID'];
			$email = $row['email'];
			$startYear = $row['startYear'];
			$firstName = $row['firstName'];
			$lastName = $row['lastName'];
			}
		
		} else {
			echo "<p> No such user</p>";
		}
		
		Connection::disconnect();


    // validate input
    $valid = true;
    if (empty($studentID)) {
        $studentID = 'Please go away.';
        $valid = false;
    }

    if (empty($email)) {
        $emailError = 'Please enter Email Address';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Please enter a valid Email Address';
        $valid = false;
    }

    function validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    if (empty($startYear)) {
        $yearError = 'Please enter date';
        $valid = false;
    }

    if (empty($firstName)) {
        $firstNameError = 'Please enter Name';
        $valid = false;
    }

    if (empty($lastName)) {
        $lastNameError = 'Please enter Mobile Number';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $conn = Connection::connect();
        $sql = "UPDATE Student SET email='$email', startYear='$startYear', firstName='$firstName', lastName='$lastName' WHERE studentId='$studentID'";
		echo "<p>".$sql."</p>";

        $result = $conn->query($sql);
        Connection::disconnect();
        header("Location: ../show/student.php");
    }
}
?>

<!DCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>

<div class="span10 offset1">

        <h3>Create a Student</h3>

    <form action="student.php" method="post">
        <label>Student ID</label>
        <div>
            <Label name="studentID" value=<?php echo studentID; ?> type="text" >
           
        </div>

<label>Email</label>
<div>
    <input name="email" type="text" placeholder="my.example@example.com" value="<?php echo !empty($email) ? $email : ''; ?>">
    <?php if (!empty($emailError)): ?>
        <span><?php echo $emailError; ?></span>
    <?php endif; ?>
</div>

<label>Start year</label>
<div>
    <input name="startYear" type="date" placeholder="yyyy-mm-dd" value="<?php echo !empty($startYear) ? $startYear : ''; ?>">
    <?php if (!empty($yearError)): ?>
        <span><?php echo $yearError; ?></span>
    <?php endif; ?>
</div>

<label>First Name</label>
<div>
    <input name="firstName" type="text" placeholder="First Name" value="<?php echo !empty($firstName) ? $firstName : ''; ?>">
    <?php if (!empty($firstNameError)): ?>
        <span><?php echo $firstNameError; ?></span>
    <?php endif; ?>
</div>

<label>Last Name</label>
<div>
    <input name="lastName" type="text" placeholder="Last Name" value="<?php echo !empty($lastName) ? $lastName : ''; ?>">
    <?php if (!empty($lastNameError)): ?>
        <span><?php echo $lastNameError; ?></span>
    <?php endif; ?>
</div>

<div>
    <button type="submit">Create</button>
    <a href="../show/student.php">Back</a>
</div>
</form>
</div>


</body>
</html>