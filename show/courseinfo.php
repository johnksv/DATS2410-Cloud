<?php
require_once '../Connection.php';
if (!empty($_GET) && isset($_GET["id"])) {
    $conn = (new Connection())->connect();
    $courseID = filter_input(INPUT_GET, 'id');
    $stat = $conn->prepare("select startDate, examDate from Course_Instance where courseCode=?");
    $stat->bind_param("s", $courseID);
    $stat->execute();
    $studentInfo = $stat->get_result();

    $stat = $conn->prepare("SELECT * FROM Course WHERE courseCode=?");
    $stat->bind_param("s", $courseID);
    $stat->execute();
    $result = $stat->get_result();

    $conn->close();

    $noSuchCourse = false;
    $coursetitle = "";
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $coursetitle = $row['courseTitle'];
        $semester = $row['semester'];
    } else {
        $noSuchCourse = true;
    }
} else {
    //If no valid ID is given
    header("location:course.php");
}

if (!empty($_POST["update"])) {
    $conn = (new Connection())->connect();

    $newcoursetitle = filter_input(INPUT_POST, "courseTitle");
    $semester = filter_input(INPUT_POST, "semester");

    $stat = $conn->prepare("UPDATE Course SET courseTitle=?, semester=? WHERE courseCode=?");
    $stat->bind_param("sss", $newcoursetitle, $semester, $courseID);
    $stat->execute();
    $conn->close();
    header("Location: ../show/courseinfo.php?id=$courseID&updated=true");
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

    <div class="innerMain">
        <div>
            <h2>Info about <?php echo "$coursetitle - $courseID " ?></h2>
        </div>
        <?php if ($noSuchCourse) { ?>
            <h3>No such course in database.</h3>
        <?php } else { ?>

            <div>
                <form action="courseinfo.php?id=<?php echo "$courseID"; ?>" method="post">
                    Title: <input type="text" name="courseTitle" value="<?php echo $coursetitle; ?>"><br>
                    Semester:
                    <div>
                        <input type="radio" name="semester"
                               value="S" <?php echo (!empty($semester) && $semester == "S") ? "checked" : ''; ?>>Spring
                        <br>
                        <input type="radio" name="semester"
                               value="F" <?php echo (!empty($semester) && $semester == "F") ? "checked" : ''; ?>>Fall
                        <input hidden type="radio" name="semester"
                               value="" <?php echo (empty($semester)) ? "checked" : ''; ?>>
                    </div>
                    <p><b>
                            <?php
                            if (isset($_GET["updated"]))
                                if (strcmp($_GET["updated"], "true") == 0)
                                    echo "Succesfully updated!";
                            ?>

                        </b>
                    </p>
                    <input type="submit" name="update" Value="Update">
                </form>
            </div>

            <div>
                <h3>Start & Exam Dates</h3>
                <form action="../insert/course_instance.php" method="post">
                    <input type="hidden" name="courseCode" value="<?php echo $_GET["id"] ?>">
                    <input type="submit" value="Add new class"><br>
                </form>
            </div>

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
                                        <input type="hidden" name="courseCode" value="<?php echo $courseID ?>">
                                        <input type="hidden" name="startDate" value="<?php echo $row['startDate'] ?>">
                                        <input type="submit" name="Change" value="Edit exam date"><br>

                                    </form>

                                    <form action="delete.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['startDate'] ?>">
                                        <input type="hidden" name="course" value="<?php echo $courseID ?>">
                                        <input type="hidden" name="type" value="courseinfo">
                                        <input type="submit" name="Delete" value="Delete"><br>

                                    </form>

                                </td>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</main>


</body>
</html>


