<?php
require_once '../Connection.php';

if (!empty($_GET) && isset($_GET["id"])) {
    $conn = (new Connection())->connect();
    $studentID = filter_input(INPUT_GET, 'id');

    $stat = $conn->prepare("select * from Student where studentID=?");
    $stat->bind_param("s", $studentID);
    $stat->execute();
    $studentInfo = $stat->get_result();

    $noSuchCourse = false;
    $coursetitle = "";
    if ($studentInfo->num_rows > 0) {
        $row = $studentInfo->fetch_assoc();
    } else {
        $noSuchCourse = true;
    }

    $stat = $conn->prepare("select SP.sPID, SP.sPName, SP.durationSemester, SP.startYear, SS.completed, SS.terminated From StudyProgram as  SP, Student_has_StudyProgram as SS where SS.studentID=? and SS.sPID=SP.sPID");
    $stat->bind_param("s", $studentID);
    $stat->execute();
    $studyProgram = $stat->get_result();

    $stat = $conn->prepare("select SC.courseCode, C.courseTitle, SC.startDate, CI.ExamDate, SC.grade from StudentCourse as SC, Course_Instance as CI, Course as C where SC.startDate=CI.startDate and SC.courseCode=CI.courseCode and CI.courseCode=C.courseCode and SC.studentID=?");
    $stat->bind_param("s", $studentID);
    $stat->execute();
    $courses = $stat->get_result();
    $conn->close();
} else {
    //If no valid ID is given
    header("location:student.php");
}

if (!empty($_POST["update"])) {
    $conn = (new Connection())->connect();
    $stat = $conn->prepare("UPDATE Student SET email=?, startYear=? WHERE studentId=?");

    $email = filter_input(INPUT_POST, "email");
    $startyear = filter_input(INPUT_POST, "startYear");

    $stat->bind_param("sss", $email, $startyear, $studentID);
    $stat->execute();
    $conn->close();
    header("Location: ../show/studentinfo.php?id=$studentID&updated=true");
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
            <h2>Info about <?php echo "$studentID"; ?></h2>
        </div>
        <?php if ($noSuchCourse) { ?>
            <h3>No such student in database.</h3>
        <?php } else { ?>

            <div>
                <?php if (!empty($studentInfo)) {
                    while ($row = $studentInfo->fetch_assoc()) { ?>
                        <p><b>ID:</b> <?php echo $studentID ?></p>
                        <p><b>Name:</b> <?php echo $row['firstName'];
                            echo ' ';
                            echo $row['lastName']; ?></p>
                        <form action="studentinfo.php?id=<?php echo "$studentID"; ?>" method="post">
                            <p><b>E-mail:</b>
                                <input type="text" name="email" value="<?php echo $row['email']; ?>">
                            </p>
                            <p><b>Start date:</b>
                                <input name="startYear" type="date" value="<?php echo $row['startYear']; ?>">
                            </p>
                            <p><b>
                                    <?php
                                    if (isset($_GET["updated"]))
                                        if (strcmp($_GET["updated"], "true") == 0)
                                            echo "Succesfully updated!";
                                    ?>

                                </b>
                            </p>
                            <input type="submit" name="update" value="Update">
                        </form>
                    <?php }
                } ?>

            </div>
            <h3>Study program(s)</h3>
            <div>
                <form action="../insert/student_has_StudyProgram.php" method="post">
                    <input type="hidden" name="id" value="<?php echo "$studentID" ?>">
                    <input type="submit" value="Add new program"><br>
                </form>
                <table>
                    <thead>
                    <tr>
                        <th>Program ID</th>
                        <th>Name</th>
                        <th>Duration</th>
                        <th>Start year</th>
                        <th>Completed</th>
                        <th>Terminated</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($studyProgram)) { ?>
                        <tr>
                            <td><?php echo $row['sPID'] ?></td>
                            <td><?php echo $row['sPName'] ?></td>
                            <td><?php echo $row['durationSemester'] ?></td>
                            <td><?php echo $row['startYear'] ?></td>
                            <td><?php echo $row['completed'] ?></td>
                            <td><?php echo $row['terminated'] ?></td>
                            <td>
                                <form action="../update/studentstudyprogram.php" method="post">
                                    <input type="hidden" name="studentID" value="<?php echo $studentID ?>">
                                    <input type="hidden" name="sPID" value="<?php echo $row['sPID'] ?>">
                                    <input type="submit" name="Change" value="Edit"><br>

                                </form>

                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <h3>Courses</h3>
            <div>
                <form action="../insert/studentcourse.php" method="post">
                    <input type="hidden" name="id" value="<?php echo "$studentID"; ?>">
                    <input type="submit" value="Add new course"><br>
                </form>
                <table>
                    <thead>
                    <tr>
                        <th>Course code</th>
                        <th>Course title</th>
                        <th>Start date</th>
                        <th>Exam date</th>
                        <th>Grade</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($courses)) {
                        while ($row = $courses->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['courseCode'] ?></td>
                                <td><?php echo $row['courseTitle'] ?></td>
                                <td><?php echo $row['startDate'] ?></td>
                                <td><?php echo $row['ExamDate'] ?></td>
                                <td><?php echo $row['grade'] ?></td>
                                <td>
                                    <form action="../update/studentcourse.php" method="post">
                                        <input type="hidden" name="studentID" value="<?php echo $studentID ?>">
                                        <input type="hidden" name="courseCode" value="<?php echo $row['courseCode'] ?>">
                                        <input type="hidden" name="startDate" value="<?php echo $row['startDate'] ?>">
                                        <input type="hidden" name="grade" value="<?php echo $row['grade'] ?>">
                                        <input type="submit" name="Change" value="Edit"><br>

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


