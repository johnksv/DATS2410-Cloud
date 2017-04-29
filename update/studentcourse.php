<?php
require_once '../Connection.php';

if (!empty($_POST["update"])) {

    $studentID = filter_input(INPUT_POST, "studentID");
    $startDate = filter_input(INPUT_POST, "startDate");
    $courseCode = filter_input(INPUT_POST, "courseCode");
    $grade = filter_input(INPUT_POST, "grade");

    $conn = (new Connection())->connect();
    $stat = $conn->prepare("UPDATE StudentCourse  SET grade=? WHERE courseCode=? and startDate=? and studentID=?");
    $stat->bind_param("ssss", $grade, $courseCode, $startDate, $studentID);
    $stat->execute();
    $result = $stat->get_result();
    $conn->close();
    header("Location: ../show/studentinfo.php?id=$studentID");
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php readfile("../html/head.html"); ?>
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
            $studentID = filter_input(INPUT_POST, "studentID");
            $startDate = filter_input(INPUT_POST, "startDate");
            $courseCode = filter_input(INPUT_POST, "courseCode");
            $grade = filter_input(INPUT_POST, "grade");
            ?>
            <b>Updating grade for <?php echo "$studentID";?></b><br>
            <b>Course: <?php echo "$courseCode";?> with start date <?php echo "$startDate";?></b>


            <form action="studentcourse.php" method="post">
                <select name='grade'>
                    <option value="">Choose grade</option>
                    <option value="A" <?php echo((!empty($grade) && $grade == "A") ? 'selected' : ' '); ?>>A</option>
                    <option value="B" <?php echo((!empty($grade) && $grade == "B") ? 'selected' : ' '); ?>>B</option>
                    <option value="C" <?php echo((!empty($grade) && $grade == "C") ? 'selected' : ' '); ?>>C</option>
                    <option value="D" <?php echo((!empty($grade) && $grade == "D") ? 'selected' : ' '); ?>>D</option>
                    <option value="E" <?php echo((!empty($grade) && $grade == "E") ? 'selected' : ' '); ?>>E</option>
                    <option value="F" <?php echo((!empty($grade) && $grade == "F") ? 'selected' : ' '); ?>>F</option>
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