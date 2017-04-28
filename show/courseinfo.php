<?php
require_once '../Connection.php';
if (!empty($_GET)) {
    $conn = (new Connection())->connect();
    $courseID = $_GET['id'];
    $sql = "select startDate, examDate from Course_Instance where courseCode='$courseID'";
    $studentInfo = $conn->query($sql);
    $conn->close();
} else {
    header("location:course.php");
}

$coursetitle = null;
$semester = null;
$conn = (new Connection())->connect();

if (!empty($_POST["update"])) {

    $sql = "UPDATE Course SET courseTitle='" . $_POST["courseTitle"] .
        "', semester='" . $_POST['semester'] .
        "' WHERE courseCode='" . $_POST["foo"] .
        "'";

    $result = $conn->query($sql);
    $conn->close();
    header("Location: ../show/course.php");
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
    <div>
        <h3>Info about <?php echo $courseID ?></h3>
    </div>

    <form action="../insert/course_instance.php" method="post">
        <input type="hidden" name="courseCode" value="<?php echo $_GET["id"] ?>">
        <input type="submit" value="Add new start date"><br>
    </form>

    <div>
        <table>
            <thead>
            <tr>
                <th>Start date</th>
                <th>Exam date</th>
                <th></th>
            </tr>
            </thead>

            <tbody>
            <?php if (!empty($studentInfo)) {
                while ($row = $studentInfo->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['startDate'] ?></td>
                        <td><?php echo $row['examDate'] ?></td>
                        <td>
                            <form action="../update/courseinstance.php" method="post">
                                <input type="hidden" name="courseCode" value="<?php echo $courseID?>">
                                <input type="hidden" name="startDate" value="<?php echo $row['startDate'] ?>">
                                <input type="submit" name="Change" value="Edit"><br>

                            </form>

                            <form action="delete.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['startDate'] ?>">
                                <input type="hidden" name="course" value="<?php echo $courseID?>">
                                <input type="hidden" name="type" value="elective">
                                <input type="submit" name="Delete" value="Delete"><br>

                            </form>

                        </td>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div>


</main>


</body>
</html>


