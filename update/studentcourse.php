<?php
require_once '../Connection.php';

$conn = (new Connection())->connect();

if (!empty($_POST["update"])) {

    $studentID = $_POST["studentID"];
    $startDate = $_POST["startDate"];
    $courseCode = $_POST["courseCode"];
    $grade = $_POST["grade"];
    $sql = "UPDATE StudentCourse 
            SET grade='$grade' 
            WHERE courseCode='$courseCode' and startDate='$startDate' and studentID='$studentID'";

    $result = $conn->query($sql);
    $conn->close();
    header("Location: ../show/studentinfo.php?id=$studentID");
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
        <div class="shadow">
    <?php
    //If the request is from another webpage
    if (empty($_POST["courseCode"])) {
        echo "<h1>Direct access not allowed, redirecting</h1>";
        header('Refresh: 2;URL=../show/student.php');
    } else {
        echo "<B>Updating grade for " . $_POST["studentID"] . " in the course ". $_POST["courseCode"]." starting at " . $_POST["startDate"] ."</B><br>";

        $courseCode = $_POST["courseCode"];
        $startDate = $_POST["startDate"];
        $studentID = $_POST["studentID"];
        $grade = $_POST["grade"];
        ?>

        <form action="studentcourse.php" method="post">
            <select name='grade'>
                <option value="">Choose grade</option>
                <option value="A" <?php  echo ((!empty($grade) && $grade == "A") ? 'selected' : ' '); ?>>A</option>
                <option value="B" <?php  echo ((!empty($grade) && $grade == "B") ? 'selected' : ' '); ?>>B</option>
                <option value="C" <?php  echo ((!empty($grade) && $grade == "C") ? 'selected' : ' '); ?>>C</option>
                <option value="D" <?php  echo ((!empty($grade) && $grade == "D") ? 'selected' : ' '); ?>>D</option>
                <option value="E" <?php  echo ((!empty($grade) && $grade == "E") ? 'selected' : ' '); ?>>E</option>
                <option value="F" <?php  echo ((!empty($grade) && $grade == "F") ? 'selected' : ' '); ?>>F</option>
            </select>

            <input type="hidden" name="studentID" value="<?php echo $studentID ?>">
            <input type="hidden" name="courseCode" value="<?php echo $courseCode ?>">
            <input type="hidden" name="startDate" value="<?php echo $startDate ?>"><br>
            <input type="submit" name="update" value="submit">
        </form>

    <?php } ?>
        </div>
</main>

</body>
</html>