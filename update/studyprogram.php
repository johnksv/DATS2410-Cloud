<?php
ini_set('error_reporting', E_ALL);
//require_once 'phpcode/connection.php';
?>
<?php
require '../Connection.php';
$coursetitle = null;
$semester = null;
$conn = Connection::connect();

if (!empty($_POST["update"])) {

    $sql = "UPDATE StudyProgram SET sPName='" . $_POST["name"] .
        "', startYear='" . $_POST['startYear'] .
		"', durationSemester='" . $_POST['duration'] .
        "' WHERE sPID='" . $_POST["foo"] .
        "'";

    $result = $conn->query($sql);
    Connection::disconnect();
    header("Location: ../show/studyprogram.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php readfile("../htmlTemplate/head.html");  ?>
</head>
<body>

<?php
//Insert header
readfile("../htmlTemplate/header.html");
?>

<?php
//If the request is from another webpage
if (empty($_POST["sPID"])) {
    echo "EMPTY";
} else {
    echo "<B>Updating course: " . $_POST["sPID"] . "</B><br>";

    $sql = 'SELECT * FROM StudyProgram WHERE sPID="' . $_POST["sPID"] . '"';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
			$name=$row['sPName'];
			$dur=$row['durationSemester'];
			$year=$row['startYear'];
            $coursetitle=$row['courseTitle'];
        }

    } else {
        echo "No such course!";
    }

    Connection::disconnect();
}
?>
<form action="studyprogram.php" method="post">
    Program name: <br>
	<input name="name" type="text" value="<?php echo $name; ?>"><br>
	Duration (number of semesters): <br>
	<input name="duration" type="text" value="<?php echo $dur; ?>"><br>
	Start Year<br>
	<input name="startYear" type="date" value="<?php echo $year; ?>"><br>		
	<br>
	
    <input type="hidden" name="foo" value="<?php echo $_POST["sPID"]; ?>"/>
    <input type="submit" name="update" Value="Update">
</form>

<?php include '../htmlTemplate/footer.php'; ?>
</body>
</html>