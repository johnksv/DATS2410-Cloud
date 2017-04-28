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

    $terminated = $_POST['terminated'];
    $completed = $_POST["completed"];
    $sPID = $_POST["sPID"];
    $id = $_POST["studentID"];

    $sql = "update Student_has_StudyProgram 
            set completed = '$completed', Student_has_StudyProgram.terminated = '$terminated' 
            where studentID = '$id' and sPID = '$sPID'";

    $result = $conn->query($sql);
    $conn->close();

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
<main>
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
    $result = $conn->query($sql);
    $conn->close();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $comyear = $row['completed'];
            $teryear = $row['terminated'];
        }
    } else {
        echo "No such user!";
    }
}
?>
	<br>
    <form action="studentstudyprogram.php" method="post">
    Completed Date: <input name="completed" type="date" placeholder="yyyy-mm-dd" value="<?php echo $comyear; ?>"><br>
    Terminated Date: <input name="terminated" type="date" placeholder="yyyy-mm-dd" value="<?php echo $teryear; ?>"><br>
    <br>
    <input type="hidden" name="studentID" value="<?php echo $_POST["studentID"]; ?>"/>
    <input type="hidden" name="sPID" value="<?php echo $_POST["sPID"]; ?>"/>
    <input type="submit" name="update" Value="Update">
</form>
</main>

</body>
</html>