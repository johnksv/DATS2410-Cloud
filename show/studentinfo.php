<?php
require_once '../Connection.php';
if (!empty($_GET)) {
    $conn = (new Connection())->connect();
    $studentID = $_GET['id'];
    $sql = "select * from Student where studentID='$studentID'";
    $studentInfo = $conn->query($sql);

    $sql = "select SP.sPID, SP.sPName, SP.durationSemester, SP.startYear, SS.completed, SS.terminated 
    From StudyProgram as  SP, Student_has_StudyProgram as SS 
    where SS.studentID='$studentID' and SS.sPID=SP.sPID";
    $studyProgram = $conn->query($sql);

    $sql = "select SC.courseCode, C.courseTitle, SC.startDate, CI.ExamDate 
    from StudentCourse as SC, Course_Instance as CI, Course as C where SC.startDate=CI.startDate and SC.courseCode=CI.courseCode and CI.courseCode=C.courseCode and SC.studentID='$studentID'";
    $courses = $conn->query($sql);
    $conn->close();
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
        <h3>Info about <?php echo $studentID ?></h3>
    </div>

    <div>
        <?php if (!empty($studentInfo)) {
            while ($row = $studentInfo->fetch_assoc()) { ?>
                <p><b>ID:</b> <?php echo $row['studentID'] ?></p>
                <p><b>Name:</b> <?php echo $row['firstName']; echo ' '; echo $row['lastName']; ?></p>
                <p><b>E-mail:</b> <?php echo $row['email'] ?></p>
                <p><b>Start year:</b> <?php echo $row['startYear'] ?></p>
            <?php }
        } ?>

    </div>
    <h3>Study program(s)</h3>
    <div>
        <table>
            <thead>
            <tr>
                <th>Program ID</th>
                <th>Name</th>
                <th>Duration</th>
                <th>Start year</th>
                <th>Completed</th>
                <th>Terminated</th>
                <th> </th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($studyProgram)) {
                while ($row = $studyProgram->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['sPID'] ?></td>
                        <td><?php echo $row['sPName'] ?></td>
                        <td><?php echo $row['durationSemester'] ?></td>
                        <td><?php echo $row['startYear'] ?></td>
                        <td><?php echo $row['completed'] ?></td>
                        <td><?php echo $row['terminated'] ?></td>
                        <td>
                            <form action="../update/studentstudyprogram.php" method="post">
                            <input type="hidden" name="studentID" value="<?php echo $row['studentID'] ?>">
                            <input type="hidden" name="sPID" value="<?php echo $row['sPID'] ?>">
                            <input type="submit" name="Change" value="Edit"><br>

                        </form>
                            
                        </td>
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div>
    <h3>Courses</h3>
    <div>
        <table>
            <thead>
            <tr>
                <th>Course code</th>
                <th>Course title</th>
                <th>Start date</th>
                <th>Exam date</th>
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
                    </tr>
                <?php }
            } ?>
            </tbody>
        </table>
    </div>

</main>


</body>
</html>


