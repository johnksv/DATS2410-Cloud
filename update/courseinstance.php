<?php
require_once '../Connection.php';

$conn = (new Connection())->connect();

if (!empty($_POST["update"])) {

    $courseCode = $_POST["courseCode"];
    $startDate = $_POST["startDate"];
    $examDate = $_POST["examDate"];
    $sql = "UPDATE Course_Instance SET examDate='$examDate' WHERE courseCode='$courseCode' and startDate='$startDate'";

    $result = $conn->query($sql);
    $conn->close();
    header("Location: ../show/courseinfo.php?id=".$_POST["courseCode"]);
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
    if (empty($_POST["courseCode"])) {
        echo "<h1>Direct access not allowed, redirecting</h1>";
        header('Refresh: 2;URL=../show/course.php');
    } else {
        echo "<B>Updating exam date for " . $_POST["courseCode"] . " starting at ". $_POST["startDate"]."</B><br>";

        $courseCode = $_POST["courseCode"];
        $startDate = $_POST["startDate"];

        $sql = "SELECT * FROM Course_Instance WHERE courseCode='$courseCode' and startDate='$startDate'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $courseCode = $row['courseCode'];
                $startDate = $row['startDate'];
                $examDate = $row['examDate'];
            }

        } else {
            echo "No such course!";
        }

        $conn->close(); ?>

        <form action="courseinstance.php" method="post">
            Exam date: <input type="date" name="examDate" value="<?php echo $examDate; ?>"><br>



            <br>

            <input type="hidden" name="startDate" value="<?php echo $startDate; ?>"/>
            <input type="hidden" name="courseCode" value="<?php echo $courseCode; ?>"/>
            <input type="submit" name="update" Value="Update">
        </form>

    <?php } ?>

</main>

</body>
</html>