<?php
require_once '../Connection.php';
if (!empty($_GET)) {
    $conn = Connection::connect();
    $courseID = $_GET['id'];
    $sql = "select startDate, examDate from Course_Instance where courseCode='$courseID'";
    $studentInfo = $conn->query($sql);
    Connection::disconnect();
} else {
    header("location:course.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php readfile("../htmlTemplate/head.html"); ?>
</head>
<body>

<?php
//Insert header
include_once '../htmlTemplate/header.php';
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
                            <form action="../update/course.php" method="post">
                                <input type="hidden" name="courseCode" value="<?php echo $row['courseCode'] ?>">
                                <input type="submit" name="Change" value="Edit"><br>

                            </form>

                            <form action="delete.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                                <input type="hidden" name="course" value="<?php echo $row['courseCode'] ?>">
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


