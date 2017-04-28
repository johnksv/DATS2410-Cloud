<?php
ini_set('display_errors', '1');
ini_set('error_reporting', E_ALL);
?>
<?php
require_once '../Connection.php';
$fname = null;
$lname = null;
$email = null;
$year = null;
$conn = (new Connection())->connect();

if (!empty($_POST["update"])) {

    $sql = "UPDATE Student_has_StudyProgram SET completed='" . $_POST["completed"] .
        "', terminated='" . $_POST['terminated'] .
        "' WHERE studentId='" . $_POST["studentID"] .
        "' AND sPID='" . $_POST["sPID"] ."'";

    $result = $conn->query($sql);
    $conn->close();
    $id=$_POST["studentID"];
    header("Location: ../show/studentinfo.php?id=$id");
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php readfile("../html/head.html");  ?>
</head>
<body>

<?php
//Insert header
include_once '../html/header.php';
?>

<?php
//If the request is from another webpage
if (empty($_POST["studentID"]) || empty($_POST["sPID"])) {
    //If direct access, redirect
    header("Location: ../show/student.php");
} else { ?>
    <b>Updating <?php echo $_POST["sPID"] ?> student: <?php echo $_POST["studentID"] ?> </b><br>
    <?php
	$sPID=$_POST['sPID'];
	$studentID=$_POST['studentID'];
    $sql = "SELECT * FROM Student_has_StudyProgram WHERE studentID='$studentID' AND sPID='$sPID'";
    echo $sql;
    $result = $conn->query($sql);
    $conn->close();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $year = $row['completed'];
            $year = $row['terminated'];
        }
    } else {
        echo "No such user!";
    }
}
?>
    <form action="studentstudyprogram.php" method="post">
    Start Year: <input name="completed" type="date" value="<?php echo $completed; ?>"><br>
    Start Year: <input name="terminated" type="date" value="<?php echo $terminated; ?>"><br>
    <br>
    <input type="hidden" name="studentID" value="<?php echo $_POST["studentID"]; ?>"/>   
    <input type="hidden" name="sPID" value="<?php echo $_POST["sPID"]; ?>"/>
    <input type="submit" name="update" Value="Update">
</form>


</body>
</html>