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

    $sql = "UPDATE Course SET courseTitle='" . $_POST["courseTitle"] .
        "', semester='" . $_POST['semester'] .
        "' WHERE courseCode='" . $_POST["foo"] .
        "'";

    $result = $conn->query($sql);
    Connection::disconnect();
    header("Location: ../show/course.php");
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
if (empty($_POST["courseCode"])) {
    echo "EMPTY";
} else {
    echo "<B>Updating course: " . $_POST["courseCode"] . "</B><br>";

    $sql = 'SELECT * FROM Course WHERE courseCode="' . $_POST["courseCode"] . '"';
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $coursetitle = $row['courseTitle'];
            $semester = $row['semester'];
        }

    } else {
        echo "No such course!";
    }

    Connection::disconnect();
}
?>
<form action="course.php" method="post">
    Title: <input type="text" name="courseTitle" value="<?php echo $coursetitle; ?>"><br>
    Semester:
        <div>
            <input type="radio" name="semester"
                   value="S" <?php echo (!empty($semester) && $semester == "S") ? "checked" : ''; ?>>
            Spring <br>
            <input type="radio" name="semester"
                   value="F" <?php echo (!empty($semester) && $semester == "F") ? "checked" : ''; ?>> Fall
            <p hidden><input type="radio" name="semester" value="" <?php echo (empty($semester)) ? "checked" : ''; ?>>
            </p>
        </div>
		
	
	<br>
	
    <input type="hidden" name="foo" value="<?php echo $_POST["courseCode"]; ?>"/>
    <input type="submit" name="update" Value="Update">
</form>

</body>
</html>